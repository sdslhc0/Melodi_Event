<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pesanan Baru Melodi Event Organizer</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333333;
        }
        .email-wrapper {
            width: 100%;
            background-color: #f4f4f4;
            padding: 40px 0;
        }
        .email-content {
            max-width: 650px;
            margin: 0 auto;
            background-color: #1a1715;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #110e0c;
            padding: 30px 40px;
            text-align: center;
            border-bottom: 2px solid #c9a84c;
        }
        .header h1 {
            margin: 0;
            color: #c9a84c;
            font-family: Georgia, serif;
            font-size: 28px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .header p {
            margin: 10px 0 0;
            color: #a89880;
            font-size: 14px;
            letter-spacing: 1px;
        }
        .body-section {
            padding: 40px;
            background-color: #1a1715;
            color: #f5f0e8;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 25px;
            color: #f5f0e8;
        }
        .section-title {
            font-family: Georgia, serif;
            color: #c9a84c;
            font-size: 18px;
            margin-bottom: 15px;
            border-bottom: 1px solid #4a4239;
            padding-bottom: 8px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .info-table th {
            text-align: left;
            padding: 10px 0;
            color: #a89880;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            width: 40%;
            font-weight: normal;
        }
        .info-table td {
            padding: 10px 0;
            color: #f5f0e8;
            font-size: 15px;
            font-weight: bold;
        }
        .price-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background-color: #231d18;
            border-radius: 6px;
            overflow: hidden;
        }
        .price-table th, .price-table td {
            padding: 12px 20px;
            border-bottom: 1px solid #3a3028;
        }
        .price-table th {
            text-align: left;
            color: #a89880;
            font-weight: normal;
            font-size: 14px;
        }
        .price-table td {
            text-align: right;
            color: #f5f0e8;
            font-weight: bold;
            font-size: 15px;
        }
        .price-table tr:last-child th, .price-table tr:last-child td {
            border-bottom: none;
        }
        .total-row {
            background-color: #c9a84c;
        }
        .total-row th {
            color: #1a1715 !important;
            font-weight: bold !important;
            font-size: 16px !important;
        }
        .total-row td {
            color: #1a1715 !important;
            font-size: 18px !important;
        }
        .footer {
            background-color: #110e0c;
            padding: 20px 40px;
            text-align: center;
            color: #6b5e4f;
            font-size: 12px;
            border-top: 1px solid #3a3028;
        }
        .service-list {
            margin: 0;
            padding: 0;
            list-style: none;
            text-align: left;
        }
        .service-list li {
            margin-bottom: 4px;
            font-size: 13px;
            color: #d4c8b0;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-content">
            <!-- Header -->
            <div class="header">
                <h1>MELODI</h1>
                <p>EVENT ORGANIZER</p>
            </div>

            <!-- Body -->
            <div class="body-section">
                <div class="greeting">
                    Halo Tim Admin,<br>
                    Terdapat pesanan baru dengan <strong>ID #{{ $booking->id }}</strong>. Berikut adalah rincian lengkapnya:
                </div>

                <!-- Info Klien & Acara -->
                <h3 class="section-title">Informasi Pesanan</h3>
                <table class="info-table">
                    <tr>
                        <th>Nama Klien</th>
                        <td>{{ $booking->nama_lengkap ?? $booking->user->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>WhatsApp</th>
                        <td>{{ $booking->no_whatsapp ?? $booking->user->telepon ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Acara</th>
                        <td>{{ $booking->jenis_acara ?? optional($booking->acara)->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Acara</th>
                        <td>{{ $booking->tanggal->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Waktu Pelaksanaan</th>
                        <td>{{ $booking->waktu ?? ($booking->acara_mulai . ' - ' . $booking->acara_selesai) }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Tamu</th>
                        <td>{{ $booking->jumlah_tamu ?? $booking->jumlah_porsi ?? '-' }} Orang</td>
                    </tr>
                    <tr>
                        <th>Metode Pembayaran</th>
                        <td>
                            @if(($booking->metode_pembayaran ?? '') == 'full_payment')
                                Pembayaran Penuh
                            @elseif(($booking->metode_pembayaran ?? '') == 'dp_30')
                                DP 30%
                            @else
                                {{ str_replace('_', ' ', strtoupper($booking->metode_pembayaran ?? 'Belum Diatur')) }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Bank Tujuan</th>
                        <td>
                            @if($booking->bank)
                                {{ strtoupper($booking->bank) }} - 
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @if($booking->catatan)
                    <tr>
                        <th>Catatan Tambahan</th>
                        <td>{{ $booking->catatan }}</td>
                    </tr>
                    @endif
                </table>

                <!-- Rincian Biaya -->
                <h3 class="section-title">Rincian Layanan & Biaya</h3>
                <table class="price-table">
                    <!-- Biaya Venue / Bundling Paling Atas -->
                    <tr>
                        <th>
                            @if($booking->id_paket_bundling)
                                Paket Bundling ({{ optional($booking->paketBundling)->nama ?? 'Paket' }})
                            @else
                                Biaya Venue / Dasar
                            @endif
                        </th>
                        <td>Rp {{ number_format($booking->biaya_venue, 0, ',', '.') }}</td>
                    </tr>

                    <!-- Layanan Tambahan -->
                    @if(isset($booking->layanans) && $booking->layanans->count() > 0)
                    <tr>
                        <th style="vertical-align: top; padding-top: 15px;">Layanan Tambahan:</th>
                        <td style="padding-top: 15px;">
                            <ul class="service-list">
                                @foreach($booking->layanans as $layanan)
                                    @php
                                        $namaLayanan = $layanan->acara->nama ?? 'Layanan Terarsip';
                                    @endphp
                                    <li>{{ $namaLayanan }} ({{ $layanan->qty }}x) - Rp {{ number_format($layanan->harga, 0, ',', '.') }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    @endif

                    <!-- Total -->
                    @php
                        $total = collect([$booking->subtotal, $booking->total_biaya, $booking->total_harga])->filter()->first();
                    @endphp
                    <tr class="total-row">
                        <th>TOTAL KESELURUHAN</th>
                        <td>Rp {{ number_format($total ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    @if(($booking->metode_pembayaran ?? '') == 'dp_30')
                    <tr style="background-color: #2a231d;">
                        <th style="color: #c9a84c; font-weight: bold; border-bottom: none;">Wajib Dibayar (DP 30%)</th>
                        <td style="color: #c9a84c; border-bottom: none;">Rp {{ number_format(($total ?? 0) * 0.3, 0, ',', '.') }}</td>
                    </tr>
                    <tr style="background-color: #2a231d;">
                        <th style="color: #e23636; font-style: italic; border-bottom: none;">Kekurangan (H-7)</th>
                        <td style="color: #e23636; border-bottom: none;">Rp {{ number_format(($total ?? 0) * 0.7, 0, ',', '.') }}</td>
                    </tr>
                    @endif
                </table>
            </div>

            <!-- Footer -->
            <div class="footer">
                &copy; {{ date('Y') }} Melodi Event Organizer. All rights reserved.<br>
                Email ini dikirim otomatis oleh sistem.
            </div>
        </div>
    </div>
</body>
</html>
