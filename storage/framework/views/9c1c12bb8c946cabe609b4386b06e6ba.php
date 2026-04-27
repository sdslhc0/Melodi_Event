<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        h2 {
            text-align: center;
            color: #4a4239;
            margin-bottom: 5px;
        }
        p.period {
            text-align: center;
            color: #666;
            margin-top: 0;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4eedd;
            color: #4a4239;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #fcfbf8;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .status {
            text-transform: uppercase;
            font-size: 10px;
            font-weight: bold;
        }
        .status-pending { color: #d97706; }
        .status-dibooking { color: #2563eb; }
        .status-selesai { color: #16a34a; }
        .status-batal { color: #dc2626; }
    </style>
</head>
<body>
    <h2>Laporan Data Booking Melodi Event Organizer</h2>
    <p class="period">Periode: <?php echo e($startDate->format('d/m/Y')); ?> - <?php echo e($endDate->format('d/m/Y')); ?></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Klien</th>
                <th>Kontak (WA/Email)</th>
                <th>Jenis Acara</th>
                <th>Tanggal & Jam</th>
                <th>Metode Bayar</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $grandTotal = 0; ?>
            <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php 
                    $grandTotal += $booking->subtotal; 
                    $status = $booking->detailBooking->status ?? 'pending';
                    $statusClass = 'status-' . str_replace(' ', '', $status);
                ?>
                <tr>
                    <td class="text-center">#<?php echo e($booking->id); ?></td>
                    <td><?php echo e($booking->nama_lengkap ?? $booking->user->nama ?? '-'); ?></td>
                    <td>
                        <?php echo e($booking->no_whatsapp ?? $booking->user->telepon ?? '-'); ?><br>
                        <small><?php echo e($booking->user->email ?? ''); ?></small>
                    </td>
                    <td><?php echo e($booking->jenis_acara ?: '-'); ?></td>
                    <td>
                        <?php echo e($booking->tanggal->format('d/m/Y')); ?><br>
                        <small><?php echo e($booking->acara_mulai); ?> - <?php echo e($booking->acara_selesai); ?></small>
                    </td>
                    <td class="text-center"><?php echo e(strtoupper(str_replace('_', ' ', $booking->metode_pembayaran ?? '-'))); ?></td>
                    <td class="text-right">Rp <?php echo e(number_format($booking->subtotal, 0, ',', '.')); ?></td>
                    <td class="text-center">
                        <span class="status <?php echo e($statusClass); ?>"><?php echo e($status); ?></span>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data booking pada periode ini.</td>
                </tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" class="text-right">TOTAL PENDAPATAN</th>
                <th class="text-right">Rp <?php echo e(number_format($grandTotal, 0, ',', '.')); ?></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
<?php /**PATH C:\0704\2505\wedding-organizer\resources\views/backend/export/booking_pdf.blade.php ENDPATH**/ ?>