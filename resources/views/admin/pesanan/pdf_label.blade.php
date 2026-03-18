<!DOCTYPE html>
<html>
<head>
    <title>Label {{ $pesanan->nomor_invoice }}</title>
    <style>
        @page { 
            size: 105mm 148mm; /* Ukuran A6 TUNGGAL */
            margin: 0; /* Margin nol agar memenuhi stiker thermal */
        }
        body { 
            font-family: 'Helvetica', sans-serif; 
            margin: 10px; 
            padding: 15px; 
            color: #111; 
            border: 4px solid #000; /* Border Rounded Tebal */
            border-radius: 20px;
            height: 130mm; /* Tinggi konten di dalam A6 */
            box-sizing: border-box;
        }
        .header { 
            text-align: center; 
            border-bottom: 2px solid #000; 
            padding-bottom: 12px; 
            margin-bottom: 15px; 
        }
        .header img { 
            height: 40px; /* Logo Orbit */
            margin-bottom: 5px; 
        }
        .header-title {
            font-size: 14px;
            font-weight: black;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 5px;
        }
        .resi-box {
            text-align: center;
            margin: 15px 0;
        }
        .resi { 
            font-size: 24px; 
            font-weight: black; 
            background: #000; /* Kotak Hitam Masif */
            color: #fff; 
            display: inline-block; 
            padding: 12px 25px; 
            border-radius: 12px; 
            letter-spacing: 2px;
        }
        .section { 
            margin-bottom: 18px; 
        }
        .label { 
            font-size: 11px; 
            font-weight: bold; 
            text-transform: uppercase; 
            color: #666; 
            margin-bottom: 5px; 
            display: block;
        }
        .address-box { 
            background: #f4f4f4; /* Background Abu-abu Muda */
            padding: 15px; 
            border-radius: 12px; 
            border: 1px solid #ddd;
        }
        .to-name { 
            font-size: 18px; 
            font-weight: black; 
            text-transform: uppercase;
            margin-bottom: 3px;
        }
        .to-phone {
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }
        .to-address {
            font-size: 12px;
            margin-top: 8px;
            leading-relaxed: 1.4;
        }
        .from-box { 
            font-size: 11px; 
            border-top: 1px dashed #ccc; 
            padding-top: 15px; 
            margin-top: 15px;
        }
        .footer { 
            position: absolute;
            bottom: 15px;
            left: 15px;
            right: 15px;
            font-size: 9px; 
            text-align: center; 
            color: #999; 
            border-top: 1px solid #eee; 
            padding-top: 8px; 
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/orbit.png') }}" alt="Logo Orbit Print">
        <div class="header-title">Orbit Digital Printing</div>
    </div>
    
    <div class="resi-box">
        <div class="resi">{{ $resi }}</div>
    </div>
    
    <div class="section">
        <span class="label">Penerima (To):</span>
        <div class="address-box">
            <div class="to-name">{{ $pesanan->user->name }}</div>
            <div class="to-phone">{{ $pesanan->user->telepon }}</div>
            <div class="to-address">{{ $pesanan->user->alamat }}</div>
        </div>
    </div>

    <div class="section from-box">
        <span class="label">Pengirim (From):</span>
        <div style="font-weight: bold; font-size: 12px; text-transform: uppercase;">Orbit Print Banjarmasin</div>
        <div style="font-size: 11px;">0812-xxxx-xxxx | orbidprint.com</div>
    </div>

    <div class="footer">
        {{ $pesanan->nomor_invoice }} | Dicetak: {{ date('d F Y, H:i') }} WITA | Metode: <strong>{{ $pesanan->metode_pengiriman }}</strong>
    </div>
</body>
</html>