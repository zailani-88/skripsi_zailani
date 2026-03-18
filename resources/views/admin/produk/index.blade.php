<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-3xl text-gray-950 tracking-tight">Katalog Produk</h2>
                <p class="text-gray-500 mt-1">Kelola daftar layanan cetak dan harga dasar produksi.</p>
            </div>
            <a href="{{ route('admin.produk.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-200 transition-all transform active:scale-95">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Tambah Produk
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100 text-gray-400 text-[11px] uppercase tracking-widest font-bold">
                            <th class="px-8 py-5">Produk</th>
                            <th class="px-8 py-5">Kategori Bahan</th>
                            <th class="px-8 py-5">Harga Dasar</th>
                            <th class="px-8 py-5">Status</th>
                            <th class="px-8 py-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($produk as $item)
                        <tr class="hover:bg-indigo-50/30 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 rounded-2xl bg-gray-50 border border-gray-100 flex-shrink-0 overflow-hidden shadow-sm">
                                        @if($item->gambar)
                                            <img src="{{ asset('storage/'.$item->gambar) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="block text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">{{ $item->nama_produk }}</span>
                                        <span class="text-[11px] text-gray-400 font-medium">ID: #ORD-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="inline-flex items-center px-3 py-1 bg-indigo-50 text-indigo-600 text-[11px] font-bold rounded-lg border border-indigo-100">
                                    {{ $item->bahanBaku->nama_bahan }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="block text-sm font-extrabold text-gray-900">Rp {{ number_format($item->harga_dasar, 0, ',', '.') }}</span>
                                <span class="text-[10px] text-gray-400 font-medium uppercase italic">Per {{ $item->bahanBaku->satuan }}</span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                    Published
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex justify-end items-center gap-2">
                                    <a href="{{ route('admin.produk.edit', $item->id) }}" class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.produk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>