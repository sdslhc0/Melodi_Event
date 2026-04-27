<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\DetailBooking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'acara', 'detailBooking']);

        if ($request->has('status') && $request->status != 'all') {
            $query->whereHas('detailBooking', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }

        // Date Range Filtering
        if ($request->has('start_date') && !empty($request->start_date)) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }
        
        if ($request->has('end_date') && !empty($request->end_date)) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

        // Sorting by Tanggal Acara
        if ($request->has('sort_date')) {
            $direction = strtolower($request->sort_date) === 'asc' ? 'asc' : 'desc';
            $query->orderBy('tanggal', $direction);
        } else {
            // Default sort by latest created booking
            $query->latest();
        }

        $bookings = $query->get();

        return view('backend.booking.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'acara.kategori', 'detailBooking']);
        return view('backend.booking.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,di booking,selesai,batal',
        ]);

        $booking->detailBooking->update([
            'status' => $request->status,
        ]);

        return redirect()->back()
            ->with('success', 'Status booking berhasil diupdate!');
    }

    public function edit(Booking $booking)
    {
        return view('backend.booking.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_whatsapp' => 'required|string|max:20',
            'jenis_acara' => 'required|string',
            'tanggal' => 'required|date',
            'acara_mulai' => 'required|string',
            'acara_selesai' => 'required|string',
            'jumlah_tamu' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
        ]);

        $booking->update([
            'nama_lengkap' => $request->nama_lengkap,
            'no_whatsapp' => $request->no_whatsapp,
            'jenis_acara' => $request->jenis_acara,
            'tanggal' => $request->tanggal,
            'acara_mulai' => $request->acara_mulai,
            'acara_selesai' => $request->acara_selesai,
            'jumlah_tamu' => $request->jumlah_tamu,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('backend.booking.show', $booking)
            ->with('success', 'Data booking berhasil diupdate!');
    }
}
