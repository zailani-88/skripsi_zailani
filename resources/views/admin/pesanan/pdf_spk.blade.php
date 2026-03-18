<!DOCTYPE html>
<html>
<head>
    <title>SPK Produksi: {{ $pesanan->nomor_invoice }}</title>
    <style>
        body { 
            font-family: 'Helvetica', sans-serif; 
            font-size: 11px; /* Sedikit dikecilkan agar muat banyak */
            color: #111; 
            margin: 0; 
            padding: 0; 
        }
        @page { 
            size: a4 portrait;
            margin: 1cm; /* Margin diperkecil sedikit */
        }
        
        /* Kop Surat Berbasis Tabel - Sangat Stabil di Dompdf */
        .kop-table { 
            width: 100%; 
            background: #312e81; /* Indigo 900 */
            color: #fff; 
            border-radius: 12px; 
            margin-bottom: 25px; 
            border: none;
            border-collapse: collapse;
        }
        .kop-table td {
            border: none;
            padding: 15px 20px;
            vertical-align: middle;
        }
        .logo-cell {
            width: 60px; /* Lebar sel logo pas */
            text-align: left;
        }
        .kop-logo { 
            height: 45px; /* Tinggi logo pas */
            width: auto;
            background: #fff; 
            padding: 5px; 
            border-radius: 8px; 
            display: block;
        }
        .text-cell {
            text-align: left;
        }
        .info-cell { 
            text-align: right; 
            width: 25%; 
            font-size: 10px; 
        }
        
        /* Judul Dokumen */
        .title { 
            text-align: center; 
            font-size: 20px; 
            font-weight: bold; 
            color: #1e1b4b; /* Indigo 950 */
            text-transform: uppercase; 
            letter-spacing: 2px; 
            border-bottom: 2px solid #312e81; 
            padding-bottom: 5px; 
            margin-bottom: 25px; 
        }
        
        /* Tabel Rincian Produksi */
        table.produksi { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 15px; 
            border: 1px solid #e2e8f0; 
        }
        table.produksi th { 
            background: #f3f4f6; /* Gray 100 */
            color: #111; 
            padding: 10px 8px; 
            font-size: 10px; 
            text-transform: uppercase; 
            text-align: left; 
            border-bottom: 2px solid #e2e8f0; 
            font-weight: bold;
        }
        table.produksi td { 
            padding: 12px 8px; 
            border-bottom: 1px solid #edf2f7; 
            vertical-align: top; 
        }
        .item-name {
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            color: #111;
            margin-bottom: 2px;
        }
        .item-meta {
            font-size: 10px;
            color: #666;
            font-style: italic;
        }
        .tech-detail {
            font-weight: bold;
            font-size: 12px;
            color: #111;
        }
        .finishing-box {
            background: #fafafa;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #f0f0f0;
        }
        .catatan-label {
            font-weight: bold;
            color: #312e81;
            text-transform: uppercase;
            font-size: 10px;
            margin-bottom: 3px;
            display: block;
        }
        
        /* Kotak Instruksi Penting */
        .instruksi { 
            margin-top: 30px; 
            padding: 20px; 
            border: 2px dashed #312e81; 
            border-radius: 12px; 
            background: #fdfdfd; 
        }
        .instruksi-title {
            font-size: 13px;
            font-weight: bold;
            color: #312e81;
            text-transform: uppercase;
            display: block;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }
        
        /* Tanda Tangan */
        .signature { 
            margin-top: 70px; 
            width: 100%; 
            border: none;
            border-collapse: collapse;
        }
        .signature td {
            border: none;
            text-align: center; 
            font-weight: bold;
            width: 33.33%;
            padding-bottom: 10px;
        }
        
        /* Footer */
        .footer { 
            position: fixed; 
            bottom: 0; 
            width: 100%; 
            font-size: 9px; 
            text-align: center; 
            color: #999; 
            border-top: 1px solid #eee; 
            padding-top: 5px; 
        }
    </style>
</head>
<body>
    <table class="kop-table">
        <tr>
            <td class="logo-cell">
                <img src="{{ public_path('images/orbit.png') }}" alt="Logo" class="kop-logo">
            </td>
            <td class="text-cell">
                <h2 style="margin: 0; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; font-weight: bold;">Orbit Digital Printing</h2>
                <p style="margin: 3px 0 0; font-size: 11px; font-weight: bold;">Solusi Cetak Cepat & Berkualitas | orbidprint.com</p>
            </td>
            <td class="info-cell">
                <p style="margin: 0;">NO. SPK:<br><strong style="font-size: 11px; letter-spacing: 1px;">{{ $pesanan->nomor_invoice }}</strong></p>
                <p style="margin: 5px 0 0;">Tgl: {{ $pesanan->created_at->format('d M Y') }}</p>
            </td>
        </tr>
    </table>

    <div class="title">Surat Perintah Kerja</div>

    <table class="produksi">
        <thead>
            <tr>
                <th style="width: 45%;">Item Produk</th>
                <th style="text-align: center;">Ukuran (m)</th>
                <th style="text-align: center;">Qty (Pcs)</th>
                <th style="width: 30%;">Instruksi Finishing</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanan->detailPesanan as $detail)
            <tr>
                <td>
                    <div class="item-name">{{ $detail->produk->nama_produk }}</div>
                    <div class="item-meta">Bahan: {{ $detail->produk->bahanBaku->nama_bahan ?? '-' }}</div>
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <div class="tech-detail">{{ $detail->panjang }} x {{ $detail->lebar }}</div>
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <div class="tech-detail">{{ $detail->jumlah }}</div>
                </td>
                <td class="finishing-box">
                    <span class="catatan-label">CATATAN KHUSUS:</span>
                    <p style="margin: 0; font-style: italic; color: #555; leading-relaxed: 1.3;">{{ $detail->finishing ?? 'Standar / Tanpa Finishing' }}</p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="instruksi">
        <span class="instruksi-title">WAJIB DIPERHATIKAN OPERATOR:</span>
        <p style="margin: 0; font-size: 11px; color: #444; leading-relaxed: 1.5;">
            1. Cek resolusi dan kualitas file desain sebelum proses cetak.<br>
            2. Pastikan warna akurat dan sesuai dengan profil mesin.<br>
            3. Metode Pengiriman: <strong>{{ $pesanan->metode_pengiriman }}</strong>.<br>
            4. QC ketat hasil cetakan dan finishing sebelum diserahkan ke kurir/pelanggan.
        </p>
    </div>

    <table class="signature">
        <tr>
            <td>Operator Mesin</td>
            <td>Team QC / Finishing</td>
            <td>Penanggung Jawab</td>
        </tr>
        <tr>
            <td colspan="3" style="height: 60px;">&nbsp;</td> </tr>
        <tr>
            <td>( ................................. )</td>
            <td>( ................................. )</td>
            <td>( ................................. )</td>
        </tr>
    </table>

    <div class="footer">
        Dicetak: {{ date('d F Y, H:i') }} WITA | Dokumen Internal Orbit Digital Printing | Banjarmasin
    </div>
</body>
</html>