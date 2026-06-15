<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Orbit Digital Printing - Berkualitas & Cepat</title>
        <link rel="icon" type="image/png" href="{{ asset('images/orbit.png') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />
    </head>
    <body class="antialiased bg-white font-sans text-gray-900">
        
        <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center">
                            <img src="{{ asset('images/orbit.png') }}" class="h-12 w-auto" alt="Logo Orbit">
                        </div>
                        <span class="text-2xl font-extrabold tracking-tighter text-gray-900 uppercase">Orbit <span class="text-indigo-600">Digital</span></span>
                    </div>

                    <div class="hidden md:flex items-center space-x-8 text-sm font-bold">
                        <a href="#" class="hover:text-indigo-600 transition">Beranda</a>
                        <a href="{{ route('katalog.index') }}" class="hover:text-indigo-600 transition">Katalog</a>
                        <a href="#" class="hover:text-indigo-600 transition">Tentang Kami</a>
                        
                        @if (Route::has('login'))
                            <div class="flex items-center space-x-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-100 transition shadow-sm">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Masuk</a>
                                    <a href="{{ route('register') }}" class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition transform active:scale-95">Daftar Akun</a>
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <section class="pt-40 pb-24 bg-gradient-to-b from-sky-50 via-cyan-50/30 to-white overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="space-y-8 animate-fade-in">
                    <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 text-xs font-extrabold rounded-full tracking-widest uppercase italic">Pusat Cetak Digital Terpercaya di Banjarmasin</span>
                    <h1 class="text-6xl lg:text-8xl font-extrabold text-gray-950 leading-none tracking-tighter">
                        Cetak Ide Anda <br> <span class="orbit-text-gradient">Jadi Nyata.</span>
                    </h1>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed font-medium">
                        Kualitas tajam, warna akurat, dan pengerjaan tepat waktu. Orbit Digital Printing siap melayani segala kebutuhan cetak Anda.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('katalog.index') }}" class="px-10 py-5 bg-indigo-600 text-white font-bold rounded-2xl shadow-2xl shadow-indigo-200 hover:bg-indigo-700 transition transform hover:-translate-y-1">Lihat Semua Katalog</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="produk" class="py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-4">
                    <div class="space-y-2">
                        <h2 class="text-4xl font-extrabold text-gray-950 tracking-tight italic uppercase">Produk Unggulan</h2>
                        <p class="text-gray-500 font-medium">Layanan cetak paling populer pilihan pelanggan kami.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @forelse($produk as $item)
                        <div class="group bg-white rounded-3xl border border-gray-100 p-2 shadow-sm hover:shadow-xl transition-all duration-500 transform hover:-translate-y-2">
                            <div class="h-56 rounded-2xl bg-gray-50 overflow-hidden mb-4 relative border border-gray-50">
                                @if($item->gambar)
                                    <img src="{{ asset('storage/'.$item->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-300">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="px-4 pb-4">
                                <h3 class="font-bold text-gray-900 group-hover:text-indigo-600 transition-colors uppercase tracking-tight text-lg">{{ $item->nama_produk }}</h3>
                              <p class="text-xs text-gray-400 mt-1 font-bold tracking-widest uppercase italic">{{ $item->bahanBaku->pluck('nama_bahan')->implode(', ') ?: 'Material Custom' }}</p>
                                <div class="mt-8 flex justify-between items-center border-t border-gray-50 pt-4">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Mulai Dari</span>
                                        <span class="text-xl font-extrabold text-gray-900">Rp {{ number_format($item->harga_dasar, 0, ',', '.') }}</span>
                                    </div>
                                    <a href="{{ route('pesan.show', $item->id) }}" class="p-3 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-24 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200 text-gray-400 font-bold uppercase italic tracking-widest">
                            Data produk segera hadir.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
        @php $ulasanPublik = \App\Models\Ulasan::with('user')->latest()->take(3)->get(); @endphp

<section class="py-24 bg-gray-50 border-y border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 space-y-4">
            <h2 class="text-4xl font-extrabold text-gray-950 tracking-tight italic uppercase">Testimoni Pelanggan</h2>
            <p class="text-gray-500 font-medium">Apa kata mereka yang telah mencetak di Orbit Digital?</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($ulasanPublik as $ul)
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between">
                <div>
                    <div class="flex gap-1 mb-6 text-yellow-400">
                        @foreach(range(1, $ul->rating) as $star)
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        @endforeach
                    </div>
                    <p class="text-gray-700 font-bold italic text-lg leading-relaxed">"{{ $ul->komentar }}"</p>
                </div>
                <div class="mt-8 pt-6 border-t border-gray-50 flex items-center gap-4">
                    <div class="w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center text-white font-black uppercase">
                        {{ substr($ul->user->name, 0, 1) }}
                    </div>
                    <div>
                        <h4 class="font-black text-gray-950 uppercase text-sm tracking-tight">{{ $ul->user->name }}</h4>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Pelanggan Terverifikasi</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center text-gray-400 font-bold uppercase italic tracking-widest">Belum ada ulasan saat ini.</div>
            @endforelse
        </div>
    </div>
</section>

        <footer class="bg-gray-950 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-8 text-center md:text-left">
                <div class="flex flex-col items-center md:items-start space-y-4">
                    <img src="{{ asset('images/orbit.png') }}" class="h-10 w-auto" alt="Logo Footer">
                    <p class="text-gray-500 text-sm font-medium tracking-wide">© 2026 Orbit Digital Printing. High Quality Output.</p>
                </div>
                <div class="flex space-x-8 text-sm font-bold text-gray-400 uppercase">
                    <a href="#" class="hover:text-white transition">Instagram</a>
                    <a href="#" class="hover:text-white transition">WhatsApp</a>
                </div>
            </div>
        </footer>
    </body>
</html>