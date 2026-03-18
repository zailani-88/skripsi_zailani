<section class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
    <header class="mb-6 border-b border-gray-50 pb-4">
        <h2 class="text-xl font-black text-gray-950 uppercase tracking-tighter">
            Informasi Profil
        </h2>
        <p class="mt-1 text-sm text-gray-500 font-medium">
            Perbarui informasi dasar profil akun Anda, email, serta detail pengiriman.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Nama Lengkap</label>
                <input id="name" name="name" type="text" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:ring-4 focus:ring-indigo-50 font-bold text-gray-900" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <label for="telepon" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Nomor Telepon / WA</label>
                <input id="telepon" name="telepon" type="text" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:ring-4 focus:ring-indigo-50 font-bold text-gray-900" value="{{ old('telepon', $user->telepon) }}" required autocomplete="telepon" placeholder="Contoh: 081234567890" />
                <x-input-error class="mt-2" :messages="$errors->get('telepon')" />
            </div>
        </div>

        <div>
            <label for="email" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Alamat Email</label>
            <input id="email" name="email" type="email" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:ring-4 focus:ring-indigo-50 font-bold text-gray-900" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-yellow-50 rounded-xl border border-yellow-100">
                    <p class="text-sm font-bold text-yellow-800">
                        Email Anda belum diverifikasi.
                        <button form="send-verification" class="underline hover:text-yellow-900 focus:outline-none ml-1">
                            Klik di sini untuk mengirim ulang email verifikasi.
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-black text-xs uppercase tracking-widest text-emerald-600">
                            Tautan baru telah dikirim!
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <label for="alamat" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Alamat Lengkap Pengiriman</label>
            <textarea id="alamat" name="alamat" rows="3" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:ring-4 focus:ring-indigo-50 font-bold text-gray-900" required placeholder="Contoh: Jl. Kayu Tangi No. 123, Banjarmasin Utara">{{ old('alamat', $user->alamat) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-50">
            <button type="submit" class="px-8 py-3 bg-indigo-600 text-white font-black uppercase tracking-widest text-xs rounded-xl shadow-lg hover:bg-indigo-700 transition transform active:scale-95">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-xs font-black uppercase tracking-widest text-emerald-500">
                    Berhasil Disimpan!
                </p>
            @endif
        </div>
    </form>
</section>