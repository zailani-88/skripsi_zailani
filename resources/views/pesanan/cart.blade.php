<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 uppercase tracking-tight italic">Keranjang Belanja</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl font-bold uppercase tracking-widest text-xs">
                    ⚠️ {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl font-bold uppercase tracking-widest text-xs">
                    ✅ {{ session('success') }}
                </div>
            @endif
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-50 flex justify-between items-center">
                    <h3 class="font-bold text-gray-950 uppercase tracking-tight">Daftar Item Cetak</h3>
                    <span class="text-xs font-black uppercase text-indigo-600 bg-indigo-50 px-4 py-1 rounded-full">
                        {{ $keranjang ? $keranjang->detailKeranjang->count() : 0 }} Item
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/50 text-[10px] font-black uppercase text-gray-400 tracking-widest">
                            <tr>
                                <th class="px-8 py-4">Produk & Ukuran</th>
                                <th class="px-8 py-4">Jumlah</th>
                                <th class="px-8 py-4 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @if($keranjang && $keranjang->detailKeranjang->count() > 0)
                                @foreach($keranjang->detailKeranjang as $detail)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <img src="{{ asset('storage/'.$detail->produk->gambar) }}" class="w-16 h-16 rounded-xl object-cover">
                                            <div>
                                                <span class="block font-black text-gray-950 uppercase italic leading-tight">{{ $detail->produk->nama_produk }}</span>
                                                <span class="text-xs font-bold text-gray-400 italic">Ukuran: {{ $detail->panjang }}{{ $detail->produk->satuan ?? 'm' }} x {{ $detail->lebar }}{{ $detail->produk->satuan ?? 'm' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 font-bold text-gray-700">{{ $detail->jumlah }} Pcs</td>
                                    <td class="px-8 py-6 text-right font-black text-gray-950 tracking-tight">
                                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="px-8 py-20 text-center text-gray-400 italic font-bold uppercase tracking-widest">Keranjang kosong</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                @if($keranjang && $keranjang->detailKeranjang->count() > 0)
                <div class="p-8 bg-gray-50 flex flex-col md:flex-row justify-between items-center gap-6">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Belanja</p>
                        <h4 class="text-3xl font-black text-gray-950 tracking-tighter">
                            Rp {{ number_format($keranjang->detailKeranjang->sum('subtotal'), 0, ',', '.') }}
                        </h4>
                    </div>
                    <div class="flex gap-4">
                        <a href="{{ route('katalog.index') }}" class="px-8 py-4 text-sm font-black uppercase text-gray-500 hover:text-gray-950 transition">Tambah Produk</a>
                        <a href="{{ route('pesan.checkout') }}" class="px-12 py-4 bg-indigo-600 text-white font-black uppercase rounded-2xl shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition transform active:scale-95 inline-block text-center">
                            Lanjut Checkout &rarr;
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>