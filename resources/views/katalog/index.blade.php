<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Katalog Layanan - Orbit Digital Printing</title>
    <link rel="icon" type="image/png" href="{{ asset('images/orbit.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />
</head>
<body class="bg-gray-50 font-sans text-gray-900">
    
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 h-20 flex justify-between items-center">
            <a href="/" class="flex items-center space-x-3">
                <img src="{{ asset('images/orbit.png') }}" class="h-10 w-auto">
                <span class="text-xl font-black text-gray-900 uppercase tracking-tighter">Orbit <span class="text-indigo-600">Digital</span></span>
            </a>
            <a href="/" class="text-xs font-black uppercase text-gray-400 hover:text-indigo-600 tracking-widest transition">Kembali ke Beranda</a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-16">
        <div class="mb-16 text-center">
            <h1 class="text-5xl font-black text-gray-950 uppercase tracking-tighter italic">Katalog Lengkap</h1>
            <p class="text-gray-500 mt-2 font-medium">Solusi cetak profesional untuk segala media dan ukuran.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($produk as $item)
                <div class="bg-white rounded-3xl border border-gray-100 p-2 shadow-sm hover:shadow-xl transition-all group">
                    <div class="h-56 rounded-2xl bg-gray-100 overflow-hidden mb-4 border border-gray-50 relative">
                        @if($item->gambar)
                            <img src="{{ asset('storage/'.$item->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300 uppercase font-black text-[10px] italic">No Preview</div>
                        @endif
                    </div>
                    <div class="px-4 pb-4 text-center">
                        <h3 class="font-black text-gray-950 uppercase text-lg group-hover:text-indigo-600 transition-colors tracking-tight">{{ $item->nama_produk }}</h3>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1 italic">{{ $item->bahanBaku->pluck('nama_bahan')->implode(', ') ?: 'Material Custom' }}</p>
                        
                        <div class="mt-6 pt-6 border-t border-gray-50">
                            <span class="text-[10px] font-bold text-gray-400 block uppercase tracking-widest mb-1 italic">Mulai Dari</span>
                            <span class="text-2xl font-black text-gray-950 tracking-tighter">Rp {{ number_format($item->harga_dasar, 0, ',', '.') }}</span>
                        </div>
                        
                    <a href="{{ route('pesan.show', $item->id) }}" 
   class="mt-6 block w-full py-4 bg-indigo-600 text-white text-xs font-black uppercase rounded-2xl hover:bg-indigo-700 transition shadow-lg">
    Pesan Sekarang
</a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 text-gray-400 font-bold uppercase italic tracking-widest">
                    Belum ada layanan yang tersedia saat ini.
                </div>
            @endforelse
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest italic">Orbit Digital Printing - Layanan Cetak Masa Kini</p>
        </div>
    </footer>
</body>
</html>