<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 uppercase tracking-tight">Detail Pesanan: {{ $pesanan->nomor_invoice }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <a href="{{ route('admin.pesanan.index') }}" class="text-xs font-black text-gray-400 uppercase hover:text-indigo-600 transition tracking-widest">&larr; Kembali ke Daftar</a>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <h3 class="font-black text-gray-950 uppercase mb-6 tracking-tighter">Item Dipesan</h3>
                        <div class="space-y-4">
                            @foreach($pesanan->detailPesanan as $detail)
                            <div class="flex items-center gap-6 p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                <img src="{{ asset('storage/'.$detail->produk->gambar) }}" class="w-16 h-16 object-cover rounded-xl shadow-sm">
                                <div class="flex-1">
                                    <h5 class="font-black text-gray-950 uppercase">{{ $detail->produk->nama_produk }}</h5>
                                    <p class="text-xs font-bold text-gray-500 mt-1">Ukuran: {{ $detail->panjang }}m x {{ $detail->lebar }}m | Jumlah: {{ $detail->jumlah }}</p>
                                    @if($detail->finishing)
                                        <p class="text-[10px] font-bold text-indigo-600 mt-2 uppercase tracking-widest">Catatan: {{ $detail->finishing }}</p>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <p class="font-black text-gray-950">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    @php $ulasan = \App\Models\Ulasan::where('pesanan_id', $pesanan->id)->first(); @endphp
                    @if($ulasan)
                    <div class="bg-emerald-50 p-8 rounded-3xl border border-emerald-100">
                        <h3 class="font-black text-emerald-900 uppercase mb-4 tracking-tighter text-xs">Ulasan Pelanggan ⭐</h3>
                        <div class="flex gap-1 mb-3">
                            @foreach(range(1, $ulasan->rating) as $star)
                                <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            @endforeach
                        </div>
                        <p class="font-bold text-emerald-800 italic text-lg">"{{ $ulasan->komentar }}"</p>
                    </div>
                    @endif

                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <h3 class="font-black text-gray-950 uppercase mb-6 tracking-tighter">Bukti Pembayaran</h3>
                        @if($pesanan->bukti_bayar)
                            <img src="{{ asset('storage/'.$pesanan->bukti_bayar) }}" class="max-w-md w-full rounded-2xl border border-gray-200 shadow-sm">
                        @else
                            <p class="text-red-500 font-bold italic">Bukti bayar tidak ditemukan.</p>
                        @endif
                    </div>
                </div>

                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <h3 class="font-black text-gray-950 uppercase mb-6 tracking-tighter">Informasi Pelanggan</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama Lengkap</p>
                                <p class="font-bold text-gray-900">{{ $pesanan->user->name }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Email</p>
                                <p class="font-bold text-gray-900">{{ $pesanan->user->email }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Telepon</p>
                                <p class="font-bold text-gray-900">{{ $pesanan->user->telepon ?? 'Tidak ada' }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Alamat</p>
                                <p class="font-bold text-gray-900">{{ $pesanan->user->alamat ?? 'Ambil di Toko' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-indigo-950 p-8 rounded-3xl shadow-xl">
                        <h3 class="font-black text-white uppercase mb-6 tracking-tighter">Update Status</h3>
                        <form action="{{ route('admin.pesanan.updateStatus', $pesanan->id) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="w-full px-4 py-3 rounded-xl border-0 focus:ring-4 focus:ring-indigo-500 font-bold bg-white text-gray-900">
                                <option value="Verifikasi" {{ $pesanan->status == 'Verifikasi' ? 'selected' : '' }}>Verifikasi Pembayaran</option>
                                <option value="Antrean Cetak" {{ $pesanan->status == 'Antrean Cetak' ? 'selected' : '' }}>Masuk Antrean Cetak</option>
                                <option value="Produksi" {{ $pesanan->status == 'Produksi' ? 'selected' : '' }}>Sedang Produksi (Dicetak)</option>
                                <option value="Siap Ambil / Dikirim" {{ $pesanan->status == 'Siap Ambil / Dikirim' ? 'selected' : '' }}>Siap Ambil / Dikirim</option>
                                <option value="Selesai" {{ $pesanan->status == 'Selesai' ? 'selected' : '' }}>Transaksi Selesai</option>
                                <option value="Dibatalkan" {{ $pesanan->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                            <button type="submit" class="w-full py-3 bg-indigo-600 text-white font-black uppercase rounded-xl hover:bg-indigo-500 transition shadow-lg mt-4">
                                Simpan Status
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>