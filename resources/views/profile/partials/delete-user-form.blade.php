<section class="bg-red-50 p-8 rounded-3xl border border-red-100 space-y-6">
    <header class="mb-6 border-b border-red-100 pb-4">
        <h2 class="text-xl font-black text-red-600 uppercase tracking-tighter">
            Hapus Akun Permanen
        </h2>
        <p class="mt-1 text-sm text-red-500 font-medium">
            Setelah akun Anda dihapus, semua sumber daya, riwayat pesanan, dan datanya akan hilang secara permanen.
        </p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="px-8 py-3 bg-red-600 text-white font-black uppercase tracking-widest text-xs rounded-xl shadow-lg shadow-red-200 hover:bg-red-700 transition transform active:scale-95">
        Hapus Akun Saya
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-xl font-black text-gray-900 uppercase tracking-tighter">
                Apakah Anda yakin ingin menghapus akun?
            </h2>

            <p class="mt-2 text-sm text-gray-500 font-medium">
                Tindakan ini tidak bisa dibatalkan. Silakan masukkan kata sandi Anda untuk mengonfirmasi penghapusan.
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">Password</label>
                <input id="password" name="password" type="password" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:ring-4 focus:ring-red-50 font-bold text-gray-900" placeholder="Masukkan Kata Sandi" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-6 py-3 bg-gray-100 text-gray-600 font-black uppercase tracking-widest text-xs rounded-xl hover:bg-gray-200 transition">
                    Batal
                </button>

                <button type="submit" class="px-6 py-3 bg-red-600 text-white font-black uppercase tracking-widest text-xs rounded-xl hover:bg-red-700 transition">
                    Ya, Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>