<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan Orbit Digital</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background: #4f46e5; color: white; padding: 8px; border: 1px solid #ddd; text-transform: uppercase; }
        td { padding: 8px; border: 1px solid #ddd; }
        .total-box { text-align: right; font-size: 14px; font-weight: bold; background: #f3f4f6; padding: 10px; }
        .footer { margin-top: 50px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin:0;">ORBIT DIGITAL PRINTING</h1>
        <p style="margin:5px 0;">Laporan Penjualan Bulanan (Selesai)</p>
        <p style="margin:0; font-size: 10px;">Periode: {{ date('F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl</th>
                <th>Invoice</th>
                <th>Pelanggan</th>
                <th>Metode</th>
                <th style="text-align: right;">Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanan as $index => $p)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $p->created_at->format('d/m/Y') }}</td>
                <td style="font-weight: bold;">{{ $p->nomor_invoice }}</td>
                <td>{{ $p->user->name }}</td>
                <td>{{ explode(' | ', $p->metode_pengiriman)[0] }}</td>
                <td style="text-align: right;">Rp {{ number_format($p->total_bayar, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-box">
        TOTAL OMZET BULAN INI: Rp {{ number_format($totalOmzet, 0, ',', '.') }}
    </div>

    <div class="footer">
        <p>Banjarmasin, {{ date('d F Y') }}</p>
        <br><br><br>
        <p><strong>( Admin Utama )</strong></p>
    </div>
</body>
</html>