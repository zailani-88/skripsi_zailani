<!DOCTYPE html>
<html>
<head>
    <title>Laporan Retur & Pembatalan</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; }
        .kop-table { width: 100%; background: #b91c1c; color: #fff; border-radius: 12px; margin-bottom: 25px; border-collapse: collapse; }
        .kop-table td { padding: 15px 20px; vertical-align: middle; }
        .kop-logo { height: 45px; background: #fff; padding: 5px; border-radius: 8px; }
        table.data { width: 100%; border-collapse: collapse; }
        table.data th { background: #fee2e2; color: #b91c1c; padding: 12px; border: 1px solid #ddd; text-align: left; text-transform: uppercase; }
        table.data td { padding: 12px; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <table class="kop-table">
        <tr>
            <td style="width: 60px;"><img src="{{ public_path('images/orbit.png') }}" class="kop-logo"></td>
            <td>
                <h2 style="margin:0; text-transform: uppercase;">ORBIT DIGITAL PRINTING</h2>
                <p style="margin:5px 0 0;">Laporan Log Pembatalan & Retur Pesanan</p>
            </td>
            <td style="text-align: right; font-size: 10px;">Periode: {{ date('Y') }}</td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th>Invoice</th>
                <th>Pelanggan</th>
                <th>Total Nominal</th>
                <th>Keterangan Sistem</th>
            </tr>
        </thead>
        <tbody>
            @foreach($retur as $r)
            <tr>
                <td style="font-weight: bold;">{{ $r->nomor_invoice }}</td>
                <td>{{ $r->user->name }}</td>
                <td>Rp {{ number_format($r->total_bayar, 0, ',', '.') }}</td>
                <td style="color: #b91c1c; font-style: italic;">Transaksi Dibatalkan / Gagal Verifikasi</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>