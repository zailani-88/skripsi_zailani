<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 uppercase tracking-tight">
            Dashboard {{ str_replace('_', ' ', Auth::user()->role) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('error'))
                <div class="p-5 bg-red-50 border-2 border-red-200 text-red-700 rounded-3xl font-black uppercase tracking-wider text-sm flex items-center gap-3">
                    <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if(session('success'))
                <div class="p-5 bg-emerald-50 border-2 border-emerald-200 text-emerald-700 rounded-3xl font-black uppercase tracking-wider text-sm flex items-center gap-3">
                    <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            
            <div class="bg-indigo-950 rounded-3xl p-8 text-white shadow-xl relative overflow-hidden border border-indigo-900">
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-indigo-600 rounded-full blur-3xl opacity-20"></div>
                <div class="relative z-10">
                    <h3 class="text-2xl font-black uppercase tracking-tighter mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-indigo-300 font-medium text-sm">
                        Anda login sebagai <span class="text-white font-black uppercase bg-indigo-800 px-3 py-1 rounded-lg ml-1">{{ str_replace('_', ' ', Auth::user()->role) }}</span>. 
                        Berikut adalah ringkasan operasional toko hari ini.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                @if(in_array($role, ['super_admin', 'admin_kantor']))
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-5 transform hover:-translate-y-1 transition-transform">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Omzet Bulan Ini</p>
                        <h4 class="text-xl font-black text-gray-950">Rp {{ number_format($stats['omzet_bulan_ini'], 0, ',', '.') }}</h4>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-5 transform hover:-translate-y-1 transition-transform relative overflow-hidden">
                    @if($stats['stok_kritis'] > 0)
                        <div class="absolute top-0 right-0 w-2 h-full bg-red-500 animate-pulse"></div>
                    @endif
                    <div class="w-14 h-14 rounded-2xl {{ $stats['stok_kritis'] > 0 ? 'bg-red-50 text-red-600' : 'bg-indigo-50 text-indigo-600' }} flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Stok Kritis</p>
                        <h4 class="text-xl font-black {{ $stats['stok_kritis'] > 0 ? 'text-red-600' : 'text-gray-950' }}">{{ $stats['stok_kritis'] }} Item</h4>
                    </div>
                </div>
                @endif

                @if(in_array($role, ['super_admin', 'kasir']))
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-5 transform hover:-translate-y-1 transition-transform relative overflow-hidden">
                    @if($stats['pesanan_baru'] > 0)
                        <div class="absolute top-0 right-0 w-2 h-full bg-orange-400 animate-pulse"></div>
                    @endif
                    <div class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Perlu Verifikasi</p>
                        <h4 class="text-xl font-black text-gray-950">{{ $stats['pesanan_baru'] }} Pesanan</h4>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-5 transform hover:-translate-y-1 transition-transform">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Transaksi Hari Ini</p>
                        <h4 class="text-xl font-black text-gray-950">{{ $stats['transaksi_hari_ini'] }} Transaksi</h4>
                    </div>
                </div>
                @endif

                @if($role === 'super_admin')
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-5 transform hover:-translate-y-1 transition-transform">
                    <div class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Pelanggan</p>
                        <h4 class="text-xl font-black text-gray-950">{{ $stats['total_pelanggan'] }} Akun</h4>
                    </div>
                </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>