<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SPK - {{ $pesanan->nomor_invoice }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .header {
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header table {
            width: 100%;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
        }
        .subtitle {
            font-size: 10px;
            letter-spacing: 2px;
            color: #666;
            text-transform: uppercase;
        }
        .info-table {
            width: 100%;
            margin-bottom: 20px;
            border: 1px solid #000;
            padding: 10px;
            border-radius: 5px;
        }
        .info-table td {
            vertical-align: top;
        }
        .label {
            font-size: 9px;
            text-transform: uppercase;
            color: #777;
            font-weight: bold;
        }
        .value {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
        }
        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table.items th {
            background: #f0f0f0;
            border: 1px solid #000;
            padding: 8px;
            text-transform: uppercase;
            font-size: 10px;
        }
        table.items td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }
        .product-name {
            text-align: left;
            font-weight: bold;
            font-size: 13px;
        }
        .finishing-box {
            background-color: #fff9f9;
            color: #c00;
            font-style: italic;
            font-weight: bold;
            text-align: left !important;
        }
        .footer-table {
            width: 100%;
            margin-top: 50px;
            text-align: center;
        }
        .signature-line {
            margin-top: 60px;
            border-top: 1px solid #000;
            width: 150px;
            display: inline-block;
        }
        .watermark {
            position: absolute;
            top: 45%;
            left: 15%;
            font-size: 80px;
            color: rgba(200, 200, 200, 0.2);
            transform: rotate(-45deg);
            z-index: -1;
            font-weight: bold;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

    <div class="watermark">PRODUKSI</div>

    <div class="header">
        <table>
            <tr>
                <td>
                    <p class="subtitle">Orbit Digital Printing</p>
                    <h1 class="title">Surat Perintah Kerja</h1>
                </td>
                <td style="text-align: right;">
                    <div style="font-size: 18px; font-weight: bold;">{{ $pesanan->nomor_invoice }}</div>
                    <div class="label">Tgl Masuk: {{ $pesanan->created_at->format('d/m/Y H:i') }}</div>
                </td>
            </tr>
        </table>
    </div>

    <table class="info-table">
        <tr>
            <td width="50%">
                <div class="label">Nama Pelanggan:</div>
                <div class="value">{{ $pesanan->user->name }}</div>
                <div style="margin-top: 5px;">Telp: {{ $pesanan->user->telepon ?? '-' }}</div>
            </td>
            <td width="50%" style="text-align: right;">
                <div class="label">Metode Pengambilan:</div>
                <div class="value">{{ explode(' | ', $pesanan->metode_pengiriman)[0] }}</div>
                <div style="margin-top: 5px; color: red; font-weight: bold;">STATUS: {{ strtoupper($pesanan->status) }}</div>
            </td>
        </tr>
    </table>

    <table class="items">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="35%">Item Cetakan</th>
                <th width="20%">Ukuran (PxL)</th>
                <th width="10%">Qty</th>
                <th width="30%">Instruksi Finishing</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanan->detailPesanan as $index => $detail)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td class="product-name uppercase">{{ $detail->produk->nama_produk }}</td>
                <td style="font-size: 16px; font-weight: bold;">{{ $detail->panjang }}{{ $detail->produk->satuan ?? 'm' }} x {{ $detail->lebar }}{{ $detail->produk->satuan ?? 'm' }}</td>
                <td style="font-size: 16px; font-weight: bold;">{{ $detail->jumlah }}</td>
                <td class="finishing-box">
                    {{ $detail->finishing ?: 'CETAK STANDAR (TANPA FINISHING)' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="background: #eee; padding: 10px; border-left: 5px solid #333;">
        <strong style="font-size: 10px; text-transform: uppercase;">Catatan Kasir:</strong><br>
        Harap cek kembali kualitas cetakan sebelum diserahkan ke pelanggan. Kerusakan bahan baku saat produksi wajib lapor admin.
    </div>

    <table class="footer-table">
        <tr>
            <td>
                <p>Admin/Kasir</p>
                <div class="signature-line"></div>
                <p>({{ Auth::user()->name }})</p>
            </td>
            <td>
                <p>Operator Produksi</p>
                <div class="signature-line"></div>
                <p>( ............................ )</p>
            </td>
            <td>
                <p>Quality Control</p>
                <div class="signature-line"></div>
                <p>( ............................ )</p>
            </td>
        </tr>
    </table>

    <div style="position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 9px; color: #aaa;">
        Dokumen ini dihasilkan secara otomatis oleh Sistem Orbit Digital Printing - {{ date('Y') }}
    </div>

</body>
</html>