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
    <table>
        <thead>
            <tr>
                <th>Nama Bahan Baku</th>
                <th>Total Terpakai (m²)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rekapBahan as $b)
            <tr>
                <td>{{ $b->nama_bahan }}</td>
                <td>{{ number_format($b->total_luas, 2) }} m²</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>