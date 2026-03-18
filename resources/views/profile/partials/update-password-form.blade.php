<section class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
    <header class="mb-6 border-b border-gray-50 pb-4">
        <h2 class="text-xl font-black text-gray-950 uppercase tracking-tighter">
            Ubah Kata Sandi
        </h2>
        <p class="mt-1 text-sm text-gray-500 font-medium">
            Pastikan akun Anda menggunakan kata sandi acak yang panjang agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Sandi Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:ring-4 focus:ring-indigo-50 font-bold text-gray-900" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Sandi Baru</label>
            <input id="update_password_password" name="password" type="password" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:ring-4 focus:ring-indigo-50 font-bold text-gray-900" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Konfirmasi Sandi Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:ring-4 focus:ring-indigo-50 font-bold text-gray-900" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-50">
            <button type="submit" class="px-8 py-3 bg-gray-900 text-white font-black uppercase tracking-widest text-xs rounded-xl shadow-lg hover:bg-gray-800 transition transform active:scale-95">
                Perbarui Sandi
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-xs font-black uppercase tracking-widest text-emerald-500">
                    Sandi Diperbarui!
                </p>
            @endif
        </div>
    </form>
</section>