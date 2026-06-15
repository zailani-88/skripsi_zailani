<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pemakaian Bahan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .kop { background: #312e81; color: #fff; padding: 20px; border-radius: 10px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background: #f3f4f6; }
    </style>
</head>
<body>
    <div class="kop">
        <h2 style="margin:0;">ORBIT DIGITAL PRINTING</h2>
        <p style="margin:0;">Laporan Rekapitulasi Pemakaian Bahan Baku</p>
    </div>
    <p style="font-size: 10px; color: #666; margin-bottom: 15px; font-style: italic;">
        *Laporan ini menampilkan total pemakaian bahan baku dari semua pesanan yang sedang/telah diproduksi.
    </p>

    <table>
        <thead>
            <tr>
                <th>Nama Bahan Baku</th>
                <th>Total Terpakai</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rekapBahan as $b)
            <tr>
                <td>{{ $b->nama_bahan }}</td>
                <td>{{ number_format($b->total_pemakaian, 2) }}</td>
                <td>{{ $b->satuan ?? 'm²' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" style="text-align: center; padding: 20px; color: #999;">
                    Belum ada data pemakaian bahan. Pastikan ada pesanan yang sudah diproduksi/selesai.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>