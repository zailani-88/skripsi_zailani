<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-extrabold text-2xl text-gray-950 tracking-tight">Inventaris Bahan Baku</h2>
                <p class="text-gray-500 text-sm mt-1">Pantau ketersediaan material produksi Orbit Print.</p>
            </div>
            <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-lg transition-all">
                Tambah Material
            </button>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100 text-gray-400 text-[11px] uppercase tracking-widest font-bold">
                        <th class="px-8 py-5">Nama Material</th>
                        <th class="px-8 py-5">Sisa Stok</th>
                        <th class="px-8 py-5">Satuan</th>
                        <th class="px-8 py-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($bahan as $item)
                    <tr class="hover:bg-indigo-50/30 transition-colors">
                        <td class="px-8 py-6 font-bold text-gray-900">{{ $item->nama_bahan }}</td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 {{ $item->stok < 10 ? 'bg-red-50 text-red-600' : 'bg-emerald-50 text-emerald-600' }} rounded-lg font-extrabold text-sm">
                                {{ number_format($item->stok, 2) }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-sm text-gray-500 font-medium uppercase">{{ $item->satuan }}</td>
                        <td class="px-8 py-6">
                            <div class="flex justify-end gap-2">
                                <form action="{{ route('admin.bahan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus material ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition-all">
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

    <div id="modalTambah" class="fixed inset-0 bg-black/50 hidden z-[60] flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl p-8 max-w-md w-full shadow-2xl">
            <h3 class="text-xl font-extrabold text-gray-950 mb-6">Tambah Material Baru</h3>
            <form action="{{ route('admin.bahan.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Bahan</label>
                    <input type="text" name="nama_bahan" required class="w-full px-4 py-3 rounded-xl border-gray-200 focus:ring-4 focus:ring-indigo-50">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Jumlah Stok</label>
                        <input type="number" name="stok" step="0.01" required class="w-full px-4 py-3 rounded-xl border-gray-200 focus:ring-4 focus:ring-indigo-50">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Satuan</label>
                        <select name="satuan" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:ring-4 focus:ring-indigo-50">
                            <option value="m2">m2 (Meter Persegi)</option>
                            <option value="lembar">Lembar</option>
                            <option value="pcs">Pcs</option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="flex-1 py-3 text-sm font-bold text-gray-400">Batal</button>
                    <button type="submit" class="flex-1 py-3 bg-indigo-600 text-white rounded-xl font-bold shadow-lg shadow-indigo-100">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>