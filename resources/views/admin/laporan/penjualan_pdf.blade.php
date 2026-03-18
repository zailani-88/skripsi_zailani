<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan Orbit Print</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        .kop-table { width: 100%; background: #312e81; color: #fff; border-radius: 10px; margin-bottom: 20px; border-collapse: collapse; }
        .kop-table td { padding: 15px; border: none; }
        table.data { width: 100%; border-collapse: collapse; }
        table.data th { background: #f3f4f6; padding: 10px; border: 1px solid #ddd; text-align: left; text-transform: uppercase; }
        table.data td { padding: 10px; border: 1px solid #ddd; }
        .total-row { background: #312e81; color: #fff; font-weight: bold; }
    </style>
</head>
<body>
    <table class="kop-table">
        <tr>
            <td>
                <h2 style="margin:0;">ORBIT DIGITAL PRINTING</h2>
                <p style="margin:0;">Laporan Penjualan & Omzet Bulanan</p>
            </td>
            <td style="text-align: right;">
                Periode: {{ date('F Y') }}<br>
                Dicetak: {{ date('d/m/Y') }}
            </td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th>No. Invoice</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Subtotal</th>
                <th>Pot. Diskon</th>
                <th>Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanan as $p)
            <tr>
                <td>{{ $p->nomor_invoice }}</td>
                <td>{{ $p->created_at->format('d/m/Y') }}</td>
                <td>{{ $p->user->name }}</td>
                <td>Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                <td style="color: red;">- Rp {{ number_format($p->potongan_diskon, 0, ',', '.') }}</td>
                <td style="font-weight: bold;">Rp {{ number_format($p->total_bayar, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="5" style="text-align: right;">TOTAL OMZET BERSIH:</td>
                <td>Rp {{ number_format($totalOmzet, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>