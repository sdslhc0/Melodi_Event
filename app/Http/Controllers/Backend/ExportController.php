<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'format' => 'required|in:pdf,excel'
        ]);

        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();

        $bookings = Booking::with(['user', 'acara', 'detailBooking'])
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal', 'asc')
            ->get();

        if ($request->format === 'pdf') {
            $pdf = Pdf::loadView('backend.export.booking_pdf', compact('bookings', 'startDate', 'endDate'));
            $pdf->setPaper('A4', 'landscape');
            return $pdf->download('Data_Booking_' . $startDate->format('Ymd') . '-' . $endDate->format('Ymd') . '.pdf');
        } else {
            // EXCEL Export using CSV
            $fileName = 'Data_Booking_' . $startDate->format('Ymd') . '-' . $endDate->format('Ymd') . '.csv';
            
            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            $columns = array('ID', 'Nama Klien', 'No WhatsApp', 'Email', 'Jenis Acara', 'Tanggal', 'Jam', 'Metode Pembayaran', 'Total Harga', 'Status');

            $callback = function() use($bookings, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($bookings as $booking) {
                    $status = $booking->detailBooking->status ?? 'pending';
                    
                    fputcsv($file, array(
                        '#' . $booking->id,
                        $booking->nama_lengkap ?? $booking->user->nama ?? '',
                        $booking->no_whatsapp ?? $booking->user->telepon ?? '',
                        $booking->user->email ?? '',
                        $booking->jenis_acara ?: '-',
                        $booking->tanggal->format('d/m/Y'),
                        $booking->acara_mulai . ' - ' . $booking->acara_selesai,
                        strtoupper(str_replace('_', ' ', $booking->metode_pembayaran ?? '-')),
                        $booking->subtotal,
                        strtoupper($status)
                    ));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }
    }
}
