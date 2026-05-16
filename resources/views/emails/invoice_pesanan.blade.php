<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f5; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 10px; }
        .header { text-align: center; border-bottom: 2px solid #4f46e5; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { color: #312e81; margin: 0; }
        .content p { color: #374151; line-height: 1.6; }
        .invoice-box { background: #f8fafc; border: 1px solid #e2e8f0; padding: 15px; border-radius: 8px; margin: 20px 0; }
        .total { font-size: 20px; font-weight: bold; color: #4f46e5; }
        .footer { text-align: center; font-size: 12px; color: #9ca3af; margin-top: 30px; border-top: 1px solid #e5e7eb; padding-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>ORBIT DIGITAL PRINT</h1>
        </div>
        <div class="content">
            <p>Halo, <strong>{{ $pesanan->user->name }}</strong>!</p>
            <p>Terima kasih telah melakukan pemesanan di Orbit Digital Printing. Berikut adalah rincian pesanan Anda:</p>
            
            <div class="invoice-box">
                <p><strong>Nomor Invoice:</strong> {{ $pesanan->nomor_invoice }}</p>
                <p><strong>Status:</strong> Menunggu Verifikasi Kasir</p>
                <p><strong>Metode:</strong> {{ $pesanan->metode_pengiriman }}</p>
                <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 15px 0;">
                <p class="total">Total Tagihan: Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</p>
            </div>

            <p>Kami sedang memproses verifikasi pembayaran Anda. Anda dapat mengecek status pesanan secara berkala melalui Dashboard akun Anda.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Orbit Digital Printing. All rights reserved.</p>
        </div>
    </div>
</body>
</html>