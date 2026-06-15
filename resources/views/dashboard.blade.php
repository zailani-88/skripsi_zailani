<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 uppercase tracking-tight italic">
            {{ $isStaff ? 'Dashboard Operasional' : 'Dashboard Saya' }}
        </h2>
    </x-slot>

    <div class="py-12" @if($isStaff) x-data="dashboardNotif()" x-init="init()" @endif>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if($isStaff)
            <div x-show="toast.show" x-transition
                 class="fixed top-6 right-6 z-50 max-w-sm bg-white border-l-4 border-orange-500 rounded-xl shadow-2xl p-4 flex items-start gap-3"
                 style="display: none;">
                <div class="w-10 h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </div>
                <div class="flex-1">
                    <p class="font-black text-gray-900 text-sm uppercase tracking-tight" x-text="toast.title"></p>
                    <p class="text-xs text-gray-500 mt-1" x-text="toast.message"></p>
                </div>
                <button @click="toast.show = false" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            @endif

            <div class="orbit-hero rounded-3xl p-8 md:p-12 border border-cyan-800/30 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="text-white space-y-2">
                    <p class="text-cyan-200 font-black uppercase tracking-widest text-xs">Selamat Datang Kembali,</p>
                    <h3 class="text-3xl md:text-4xl font-black tracking-tighter">{{ Auth::user()->name }}! 🚀</h3>
                    <p class="text-sm font-medium text-sky-100/90 max-w-xl">
                        @if($isStaff)
                            Pantau pesanan masuk dan status produksi toko secara real-time. Notifikasi akan muncul otomatis saat ada pesanan baru atau selesai.
                        @else
                            Siap mencetak kebutuhan digital Anda hari ini? Pantau terus status pesanan Anda atau jelajahi katalog produk terbaru kami.
                        @endif
                    </p>
                </div>
                <div class="w-full md:w-auto flex flex-col gap-3">
                    @if($isStaff)
                        @if(in_array(Auth::user()->role, ['super_admin', 'kasir']))
                        <a href="{{ route('admin.pesanan.index') }}" class="px-8 py-4 bg-orange-500 hover:bg-orange-600 text-white font-black uppercase tracking-widest text-xs rounded-xl shadow-lg transition text-center transform active:scale-95">
                            Kelola Antrean Pesanan
                        </a>
                        @endif
                        <a href="{{ route('admin.pesanan.selesai') }}" class="px-8 py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-black uppercase tracking-widest text-xs rounded-xl shadow-lg transition text-center transform active:scale-95">
                            Lihat Riwayat Selesai
                        </a>
                    @else
                        <a href="{{ route('katalog.index') }}" class="px-8 py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-black uppercase tracking-widest text-xs rounded-xl shadow-lg transition text-center transform active:scale-95">
                            Pesan Produk Baru
                        </a>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-sky-100/80 flex items-center gap-6 relative overflow-hidden hover:shadow-orbit transition-shadow">
                    @if($isStaff && $pesananAktif > 0)
                        <div class="absolute top-0 right-0 w-2 h-full bg-blue-500 animate-pulse"></div>
                    @endif
                    <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center relative">
                        @if($isStaff && $pesananBaru > 0)
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-orange-500 text-white text-[10px] font-black rounded-full flex items-center justify-center animate-bounce" x-text="pesananBaru">{{ $pesananBaru }}</span>
                        @endif
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Pesanan Aktif (Diproses)</p>
                        <h4 class="text-4xl font-black text-gray-950">
                            <span x-text="pesananAktif">{{ $pesananAktif }}</span>
                            <span class="text-sm text-gray-400 uppercase">Transaksi</span>
                        </h4>
                        @if($isStaff && $pesananBaru > 0)
                            <p class="text-[10px] font-bold text-orange-600 uppercase tracking-widest mt-1">{{ $pesananBaru }} menunggu verifikasi</p>
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-8 shadow-sm border border-sky-100/80 flex items-center gap-6 relative overflow-hidden hover:shadow-orbit transition-shadow">
                    @if($isStaff && $totalSelesai > 0)
                        <div class="absolute top-0 right-0 w-2 h-full bg-emerald-500"></div>
                    @endif
                    <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Pesanan Selesai</p>
                        <h4 class="text-4xl font-black text-gray-950">
                            <span x-text="pesananSelesai">{{ $totalSelesai }}</span>
                            <span class="text-sm text-gray-400 uppercase">Transaksi</span>
                        </h4>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-sky-100/80 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                    <h3 class="font-bold text-gray-950 uppercase tracking-tight">3 Aktivitas Terakhir</h3>
                    @if($isStaff)
                        <a href="{{ route('admin.pesanan.selesai') }}" class="text-xs font-black text-indigo-600 uppercase hover:text-indigo-800 transition tracking-widest">Lihat Semua &rarr;</a>
                    @else
                        <a href="{{ route('pesanan.riwayat') }}" class="text-xs font-black text-indigo-600 uppercase hover:text-indigo-800 transition tracking-widest">Lihat Semua &rarr;</a>
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <tbody class="divide-y divide-gray-50">
                            @forelse($pesananTerbaru as $item)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-6 py-4">
                                    <span class="block font-black text-gray-950">{{ $item->nomor_invoice }}</span>
                                    <span class="text-xs font-bold text-gray-400">{{ $item->created_at->format('d M Y') }}</span>
                                    @if($isStaff && $item->user)
                                        <span class="block text-[10px] font-bold text-indigo-500 uppercase mt-0.5">{{ $item->user->name }}</span>
                                    @endif
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
                                <td colspan="3" class="px-6 py-12 text-center text-gray-400 font-bold uppercase tracking-widest italic">
                                    {{ $isStaff ? 'Belum ada pesanan masuk.' : 'Anda belum memiliki riwayat pesanan.' }}
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    @if($isStaff)
    <script>
        function dashboardNotif() {
            return {
                pesananAktif: {{ $pesananAktif }},
                pesananSelesai: {{ $totalSelesai }},
                pesananBaru: {{ $pesananBaru }},
                toast: { show: false, title: '', message: '' },
                pollInterval: null,

                init() {
                    this.pollInterval = setInterval(() => this.fetchStats(), 15000);
                },

                async fetchStats() {
                    try {
                        const res = await fetch('{{ route('dashboard.stats') }}', {
                            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                        });
                        if (!res.ok) return;

                        const data = await res.json();

                        if (data.pesanan_aktif > this.pesananAktif) {
                            this.showToast('Pesanan Baru Masuk!', 'Ada pesanan baru yang perlu diproses.');
                        }
                        if (data.pesanan_selesai > this.pesananSelesai) {
                            this.showToast('Pesanan Selesai!', 'Satu atau lebih pesanan telah diselesaikan.');
                        }
                        if (data.pesanan_baru > this.pesananBaru) {
                            this.showToast('Perlu Verifikasi!', 'Ada pembayaran baru menunggu verifikasi.');
                        }

                        this.pesananAktif = data.pesanan_aktif;
                        this.pesananSelesai = data.pesanan_selesai;
                        this.pesananBaru = data.pesanan_baru;
                    } catch (e) {}
                },

                showToast(title, message) {
                    this.toast = { show: true, title, message };
                    setTimeout(() => { this.toast.show = false; }, 8000);
                }
            };
        }
    </script>
    @endif
</x-app-layout>
