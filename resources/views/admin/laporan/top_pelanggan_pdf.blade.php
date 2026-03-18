<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pelanggan Terbaik</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #111; }
        .kop-table { width: 100%; background: #312e81; color: #fff; border-radius: 12px; margin-bottom: 25px; border-collapse: collapse; }
        .kop-table td { padding: 15px 20px; border: none; vertical-align: middle; }
        .kop-logo { height: 45px; width: auto; background: #fff; padding: 5px; border-radius: 8px; }
        
        table.data { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table.data th { background: #f3f4f6; padding: 12px; border: 1px solid #ddd; text-align: left; text-transform: uppercase; font-size: 10px; }
        table.data td { padding: 12px; border: 1px solid #ddd; }
        .total-amount { font-weight: bold; color: #312e81; text-align: right; }
    </style>
</head>
<body>
    <table class="kop-table">
        <tr>
            <td style="width: 60px;">
                <img src="{{ public_path('images/orbit.png') }}" alt="Logo" class="kop-logo">
            </td>
            <td>
                <h2 style="margin:0; text-transform: uppercase; letter-spacing: 1px;">ORBIT DIGITAL PRINTING</h2>
                <p style="margin:5px 0 0; font-weight: bold;">Analisis Loyalitas Pelanggan (Top Spenders)</p>
            </td>
            <td style="text-align: right; font-size: 10px;">
                Periode: Tahun {{ date('Y') }}<br>
                Dicetak: {{ date('d/m/Y H:i') }} WITA
            </td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th style="width: 30px; text-align: center;">No</th>
                <th>Nama Pelanggan</th>
                <th>Email / Kontak</th>
                <th style="text-align: center;">Total Transaksi</th>
                <th style="text-align: right;">Total Akumulasi Belanja</th>
            </tr>
        </thead>
        <tbody>
            @forelse($topUsers as $index => $user)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td style="font-weight: bold; text-transform: uppercase;">{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td style="text-align: center;">{{ $user->pesanan_count }} Pesanan Selesai</td>
                <td class="total-amount">
                    Rp {{ number_format($user->pesanan_sum_total_bayar ?? 0, 0, ',', '.') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 20px; font-style: italic; color: #999;">Belum ada data pelanggan yang menyelesaikan transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 30px; font-size: 10px; color: #666; font-style: italic; text-align: center;">
       
    </div>
</body>
</html>