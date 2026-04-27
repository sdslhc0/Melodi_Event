<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Booking;
use App\Models\BookingLayanan;
use App\Models\DetailBooking;
use App\Models\PaketBundling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderNotificationMail;

class BookingController extends Controller
{
    /**
     * API Endpoint to check if a date is already booked
     */
    public function checkDate(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date'
        ]);

        $exists = Booking::where('tanggal', $request->tanggal)->exists();
        
        return response()->json([
            'booked' => $exists
        ]);
    }

    /**
     * Store booking from the new multi-step home form
     */
    public function storeOrder(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_whatsapp' => 'required|string|max:20',
            'jenis_acara' => 'required|string',
            'tanggal' => 'required|date|after_or_equal:today|unique:bookings,tanggal',
            'jumlah_tamu' => 'required|integer|min:1|max:1500',
            'acara_mulai' => 'required|string',
            'acara_selesai' => 'required|string',
            'metode_pembayaran' => 'required|in:full_payment,dp_30',
            'bank' => 'required|string',
            'catatan' => 'nullable|string|max:1000',
            'layanan' => 'nullable|array',
            'layanan.*' => 'exists:acaras,id',
            'id_paket_bundling' => 'nullable|exists:paket_bundlings,id',
        ], [
            'tanggal.unique' => 'Maaf, tanggal ini sudah di-booking oleh pelanggan lain. Silakan pilih tanggal yang berbeda untuk acara Anda.',
            'jumlah_tamu.max' => 'Jumlah tamu maksimal adalah 1500 orang.',
        ]);

        return DB::transaction(function () use ($request) {
            // Calculate totals
            $biayaVenue = 0;
            $totalLayanan = 0;


            if ($request->id_paket_bundling) {
                $bundling = PaketBundling::find($request->id_paket_bundling);
                if ($bundling) {
                    $biayaVenue = $bundling->harga;
                }
            } else {
                // Calculate Venue Fee based on duration (15jt for first 6 hours, 1jt/extra hour)
                try {
                    $start = \Carbon\Carbon::parse($request->acara_mulai);
                    $end = \Carbon\Carbon::parse($request->acara_selesai);
                    $diffInMinutes = $start->diffInMinutes($end);
                    
                    if ($diffInMinutes > 0) {
                        $hours = $diffInMinutes / 60;
                        $biayaVenue = 15000000;
                        if ($hours > 6) {
                            $extraHours = ceil($hours - 6);
                            $biayaVenue += ($extraHours * 1000000);
                        }
                    }
                } catch (\Exception $e) {
                    $biayaVenue = 0;
                }
            }

            // Get selected services and calculate total
            $selectedLayanans = [];
            $layananQties = $request->layanan_qty ?? [];
            
            if (!$request->id_paket_bundling && $request->layanan) {
                $acaras = Acara::whereIn('id', $request->layanan)->get();
                foreach ($acaras as $acara) {
                    $qty = isset($layananQties[$acara->id]) ? max(1, (int)$layananQties[$acara->id]) : 1;
                    $subTotalHarga = $acara->harga * $qty;
                    
                    $selectedLayanans[] = [
                        'id_acara' => $acara->id,
                        'harga' => $subTotalHarga,
                        'qty' => $qty,
                    ];
                    $totalLayanan += $subTotalHarga;
                }
            }

            $subtotal = $biayaVenue + $totalLayanan;

            $booking = Booking::create([
                'id_users' => Auth::id(),
                'nama_lengkap' => $request->nama_lengkap,
                'no_whatsapp' => $request->no_whatsapp,
                'jenis_acara' => $request->jenis_acara,
                'biaya_venue' => $biayaVenue,
                'tanggal' => $request->tanggal,
                'jumlah_tamu' => $request->jumlah_tamu,
                'acara_mulai' => $request->acara_mulai,
                'acara_selesai' => $request->acara_selesai,
                'id_paket_bundling' => $request->id_paket_bundling,
                'subtotal' => $subtotal,
                'metode_pembayaran' => $request->metode_pembayaran,
                'bank' => $request->bank,
                'catatan' => $request->catatan,
            ]);

            // Save selected services
            foreach ($selectedLayanans as $layanan) {
                BookingLayanan::create([
                    'id_booking' => $booking->id,
                    'id_acara' => $layanan['id_acara'],
                    'harga' => $layanan['harga'],
                    'qty' => $layanan['qty'],
                ]);
            }

            DetailBooking::create([
                'id_booking' => $booking->id,
                'status' => 'pending',
            ]);

            // Kirim email notifikasi (ganti dengan email tujuan kamu)
            try {
                Mail::to('mr.riuuus@gmail.com')->send(new OrderNotificationMail($booking));
            } catch (\Exception $e) {
                // Jangan batalkan booking jika email gagal, cukup log saja
                \Log::error('Gagal mengirim email notifikasi: ' . $e->getMessage());
            }

            return redirect()->route('home')
                ->with('success', 'Pesanan berhasil dikirim! Tim kami akan menghubungi Anda dalam 24 jam.')
                ->with('order_success', true);
        });
    }

    public function riwayat()
    {
        $bookings = Booking::with(['detailBooking', 'layanans.acara', 'paketBundling'])
            ->where('id_users', Auth::id())
            ->latest()
            ->get();

        return view('frontend.riwayat', compact('bookings'));
    }
}
