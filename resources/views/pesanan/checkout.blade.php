<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 uppercase tracking-tight italic">Finalisasi Pembayaran</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="space-y-6">
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <h3 class="font-black text-gray-950 uppercase mb-6 tracking-tighter">Rincian & Diskon</h3>
                        <div class="space-y-4">
                            
                            <div class="flex justify-between items-center pb-4 border-b border-gray-50">
                                <span class="text-sm font-bold text-gray-500">Total Item</span>
                                <span class="font-black text-gray-900">{{ $total_item }} Pcs</span>
                            </div>

                            <div class="flex justify-between items-center pb-4 border-b border-gray-50">
                                <span class="text-sm font-bold text-gray-500">Subtotal</span>
                                <span class="font-black text-gray-900">Rp {{ number_format($total_harga, 0, ',', '.') }}</span>
                            </div>

                            @if($potongan_diskon > 0)
                            <div class="flex justify-between items-center pb-4 border-b border-gray-50">
                                <span class="text-sm font-black text-emerald-500 uppercase">Diskon Grosir (10%)</span>
                                <span class="font-black text-emerald-600">- Rp {{ number_format($potongan_diskon, 0, ',', '.') }}</span>
                            </div>
                            @endif

                            <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 mt-4">
                                <p class="text-[10px] font-black text-gray-400 uppercase mb-1">Total yang harus dibayar</p>
                                <p class="font-black text-3xl text-gray-950 tracking-tighter">
                                    Rp {{ number_format($total_bayar, 0, ',', '.') }}
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="bg-indigo-950 p-8 rounded-3xl shadow-sm text-white border border-indigo-900">
                        <h3 class="font-black uppercase mb-4 tracking-tighter text-indigo-200">Instruksi Transfer</h3>
                        <p class="text-[10px] font-black uppercase mb-1 opacity-70">Bank Mandiri</p>
                        <p class="font-black text-2xl tracking-wider">123-000-456-789</p>
                        <p class="text-xs font-bold mt-1 uppercase opacity-90">A.N ORBIT DIGITAL PRINTING</p>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="font-black text-gray-950 uppercase mb-6 tracking-tighter italic">Pengiriman & Pembayaran</h3>
                    
                    <form action="{{ route('pesan.storeCheckout') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <div class="space-y-2">
                            <label class="block text-sm font-black text-gray-400 uppercase tracking-widest">Metode Pengiriman</label>
                            <select name="metode_pengiriman" required class="w-full px-4 py-3 rounded-xl border-gray-200 focus:ring-4 focus:ring-indigo-50 font-bold text-gray-700">
                                <option value="Ambil di Toko">Ambil di Toko (Gratis)</option>
                                <option value="Kurir Lokal">Kurir Lokal (Banjarmasin)</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-black text-gray-400 uppercase tracking-widest">Foto Struk / Screenshot</label>
                            <div class="border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center hover:border-indigo-600 transition bg-gray-50/50">
                                <input type="file" name="bukti_bayar" required class="block w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-indigo-600 file:text-white cursor-pointer">
                            </div>
                        </div>

                        <button type="submit" class="w-full py-4 bg-emerald-500 text-white font-black uppercase rounded-2xl shadow-xl shadow-emerald-200 hover:bg-emerald-600 transition-all transform active:scale-95">
                            Konfirmasi Transaksi
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>