<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 uppercase tracking-tight">Executive Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-indigo-600 rounded-3xl p-6 text-white shadow-xl shadow-indigo-200">
                    <p class="text-xs font-black uppercase tracking-widest text-indigo-200 mb-2">Pendapatan Bulan Ini</p>
                    <h3 class="text-4xl font-black tracking-tighter">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h3>
                </div>
                <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm">
                    <p class="text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Menunggu Verifikasi</p>
                    <h3 class="text-4xl font-black tracking-tighter text-yellow-500">{{ $pesananBaru }} <span class="text-sm text-gray-400">Pesanan</span></h3>
                </div>
                <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm">
                    <p class="text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Sedang Diproses</p>
                    <h3 class="text-4xl font-black tracking-tighter text-blue-500">{{ $pesananDiproses }} <span class="text-sm text-gray-400">Pesanan</span></h3>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                        <h3 class="font-bold text-gray-950 uppercase tracking-tight">5 Transaksi Terbaru</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <tbody class="divide-y divide-gray-50">
                                @forelse($pesananTerbaru as $item)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="p-4 pl-6">
                                        <p class="font-black text-gray-950">{{ $item->nomor_invoice }}</p>
                                        <p class="text-xs font-bold text-gray-400">{{ $item->user->name }}</p>
                                    </td>
                                    <td class="p-4 text-center">
                                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-lg text-[10px] font-black uppercase tracking-widest">{{ $item->status }}</span>
                                    </td>
                                    <td class="p-4 pr-6 text-right font-black text-indigo-600">
                                        Rp {{ number_format($item->total_bayar, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="p-8 text-center text-gray-400 italic font-bold">Belum ada transaksi.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="lg:col-span-1 bg-white rounded-3xl shadow-sm border border-red-100 overflow-hidden">
                    <div class="p-6 border-b border-red-50 bg-red-50/50">
                        <h3 class="font-bold text-red-900 uppercase tracking-tight">⚠️ Peringatan Stok</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        @forelse($stokMenipis as $bahan)
                        <div class="flex justify-between items-center pb-4 border-b border-gray-50">
                            <div>
                                <p class="font-black text-gray-900">{{ $bahan->nama_bahan }}</p>
                                <p class="text-xs font-bold text-gray-400">Satuan: {{ $bahan->satuan }}</p>
                            </div>
                            <span class="px-3 py-1 bg-red-100 text-red-700 font-black rounded-lg text-sm">{{ $bahan->stok }}</span>
                        </div>
                        @empty
                        <p class="text-emerald-500 font-bold text-sm text-center">Semua stok bahan baku dalam kondisi aman.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>