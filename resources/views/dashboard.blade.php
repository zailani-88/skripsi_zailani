<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 uppercase tracking-tight italic">Dashboard Saya</h2>
    </x-slot>

    @php
        // Mengambil data statistik khusus untuk user yang sedang login
        $pesananAktif = \App\Models\Pesanan::where('user_id', Auth::id())
                            ->whereNotIn('status', ['Selesai', 'Dibatalkan'])
                            ->count();
        $totalSelesai = \App\Models\Pesanan::where('user_id', Auth::id())
                            ->where('status', 'Selesai')
                            ->count();
        $pesananTerbaru = \App\Models\Pesanan::with('detailPesanan.produk')
                            ->where('user_id', Auth::id())
                            ->latest()
                            ->take(3)
                            ->get();
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-indigo-950 rounded-3xl p-8 md:p-12 shadow-xl border border-indigo-900 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="text-white space-y-2">
                    <p class="text-indigo-300 font-black uppercase tracking-widest text-xs">Selamat Datang Kembali,</p>
                    <h3 class="text-3xl md:text-4xl font-black tracking-tighter">{{ Auth::user()->name }}! 🚀</h3>
                    <p class="text-sm font-medium text-indigo-200 max-w-xl">
                        Siap mencetak kebutuhan digital Anda hari ini? Pantau terus status pesanan Anda atau jelajahi katalog produk terbaru kami.
                    </p>
                </div>
                <div class="w-full md:w-auto flex flex-col gap-3">
                    <a href="{{ route('katalog.index') }}" class="px-8 py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-black uppercase tracking-widest text-xs rounded-xl shadow-lg transition text-center transform active:scale-95">
                        Pesan Produk Baru
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 flex items-center gap-6">
                    <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Pesanan Aktif (Diproses)</p>
                        <h4 class="text-4xl font-black text-gray-950">{{ $pesananAktif }} <span class="text-sm text-gray-400 uppercase">Transaksi</span></h4>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 flex items-center gap-6">
                    <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Pesanan Selesai</p>
                        <h4 class="text-4xl font-black text-gray-950">{{ $totalSelesai }} <span class="text-sm text-gray-400 uppercase">Transaksi</span></h4>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                    <h3 class="font-bold text-gray-950 uppercase tracking-tight">3 Aktivitas Terakhir</h3>
                    <a href="{{ route('pesanan.riwayat') }}" class="text-xs font-black text-indigo-600 uppercase hover:text-indigo-800 transition tracking-widest">Lihat Semua &rarr;</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <tbody class="divide-y divide-gray-50">
                            @forelse($pesananTerbaru as $item)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-6 py-4">
                                    <span class="block font-black text-gray-950">{{ $item->nomor_invoice }}</span>
                                    <span class="text-xs font-bold text-gray-400">{{ $item->created_at->format('d M Y') }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-lg text-[10px] font-black uppercase tracking-widest">{{ $item->status }}</span>
                                </td>
                                <td class="px-6 py-4 text-right font-black text-indigo-600">
                                    Rp {{ number_format($item->total_bayar, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-gray-400 font-bold uppercase tracking-widest italic">Anda belum memiliki riwayat pesanan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>