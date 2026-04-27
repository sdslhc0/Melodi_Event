<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pesan Contact Us Baru - MELODI</title>
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
            max-width: 600px;
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
        .section-title {
            font-family: Georgia, serif;
            color: #c9a84c;
            font-size: 18px;
            margin-bottom: 20px;
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
            padding: 12px 0;
            color: #a89880;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            width: 35%;
            font-weight: normal;
            border-bottom: 1px solid #3a3028;
        }
        .info-table td {
            padding: 12px 0;
            color: #f5f0e8;
            font-size: 15px;
            font-weight: bold;
            border-bottom: 1px solid #3a3028;
        }
        .info-table tr:last-child th, .info-table tr:last-child td {
            border-bottom: none;
        }
        .message-box {
            background-color: #231d18;
            padding: 20px;
            border-radius: 6px;
            color: #d4c8b0;
            font-size: 14px;
            line-height: 1.6;
            border: 1px solid #3a3028;
            border-left: 4px solid #c9a84c;
            white-space: pre-wrap;
            margin-top: 10px;
        }
        .footer {
            background-color: #110e0c;
            padding: 20px 40px;
            text-align: center;
            color: #6b5e4f;
            font-size: 12px;
            border-top: 1px solid #3a3028;
        }
        a {
            color: #c9a84c;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-content">
            <!-- Header -->
            <div class="header">
                <h1>MELODI</h1>
                <p>PESAN DARI WEBSITE</p>
            </div>

            <!-- Body -->
            <div class="body-section">
                <h3 class="section-title">Detail Pengirim</h3>
                <table class="info-table">
                    <tr>
                        <th>Nama Pengirim</th>
                        <td><?php echo e($data['name']); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><a href="mailto:<?php echo e($data['email']); ?>"><?php echo e($data['email']); ?></a></td>
                    </tr>
                    <tr>
                        <th>Subjek</th>
                        <td><?php echo e($data['subject']); ?></td>
                    </tr>
                </table>

                <h3 class="section-title" style="margin-top: 35px;">Isi Pesan</h3>
                <div class="message-box"><?php echo e($data['message']); ?></div>
                
                <p style="margin-top: 30px; font-size: 13px; color: #a89880;">
                    <i>Anda dapat langsung membalas email ini untuk terhubung dengan <?php echo e($data['name']); ?>.</i>
                </p>
            </div>

            <!-- Footer -->
            <div class="footer">
                &copy; <?php echo e(date('Y')); ?> Melodi Event Organizer. All rights reserved.
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\laravel10\Melodi_event\resources\views/emails/contact_notification.blade.php ENDPATH**/ ?>