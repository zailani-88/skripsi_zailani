<x-guest-layout>
    <div class="flex min-h-screen animate-fade-in">
        <div class="hidden lg:flex lg:w-1/2 justify-center items-center relative overflow-hidden bg-gray-950">
            <img src="https://images.unsplash.com/photo-1562654501-a0ccc0fc3fb1?q=80&w=1932&auto=format&fit=crop" 
                 alt="Register Background" 
                 class="absolute inset-0 w-full h-full object-cover scale-105 animate-subtle-zoom opacity-50">
            
            <div class="absolute inset-0 bg-gradient-to-tr from-indigo-900/90 via-indigo-950/80 to-black/90"></div>
            
            <div class="z-10 text-center px-12 space-y-6">
                <div class="mb-10 flex justify-center animate-bounce-subtle">
                    <div class="w-32 h-32 bg-white rounded-3xl shadow-2xl flex items-center justify-center p-5 transform -rotate-3 hover:rotate-0 transition-transform duration-300">
                        <img src="https://ui-avatars.com/api/?name=Orbit+Print&background=fff&color=4f46e5&font-size=0.35" alt="Logo" class="max-h-full">
                    </div>
                </div>
                
                <h2 class="text-5xl font-extrabold text-white tracking-tight">Mulai <span class="text-indigo-400">Bisnis</span> Anda</h2>
                <p class="text-indigo-100 text-xl font-light max-w-md mx-auto">
                    Bergabunglah dengan ribuan mitra Orbit Print dan rasakan kemudahan cetak digital skala Enterprise.
                </p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center bg-white px-6 md:px-12 py-12">
            <div class="max-w-md w-full">
                <div class="mb-8 animate-fade-in-down">
                    <h3 class="text-3xl font-extrabold text-gray-900 tracking-tight">Buat Akun Baru</h3>
                    <p class="text-gray-600 mt-2">Daftar sekarang untuk mulai melakukan pemesanan cetak.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5 animate-fade-in delay-100">
                    @csrf

                    <div class="space-y-1">
                        <label for="name" class="text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                            <input id="name" type="text" name="name" :value="old('name')" required autofocus placeholder="Zailani"
                                class="block w-full pl-11 pr-4 py-3 border border-gray-300 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 rounded-xl transition">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="space-y-1">
                        <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            </div>
                            <input id="email" type="email" name="email" :value="old('email')" required placeholder="email@contoh.com"
                                class="block w-full pl-11 pr-4 py-3 border border-gray-300 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 rounded-xl transition">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="space-y-1">
                        <label for="password" class="text-sm font-medium text-gray-700">Kata Sandi</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <input id="password" type="password" name="password" required placeholder="••••••••"
                                class="block w-full pl-11 pr-4 py-3 border border-gray-300 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 rounded-xl transition">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="space-y-1">
                        <label for="password_confirmation" class="text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-indigo-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                            </div>
                            <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="••••••••"
                                class="block w-full pl-11 pr-4 py-3 border border-gray-300 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 rounded-xl transition">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center items-center py-4 px-6 border border-transparent rounded-xl shadow-lg text-base font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-100 transition duration-150 transform active:scale-[0.98]">
                            Daftar Akun
                            <svg class="ml-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center text-sm text-gray-600 animate-fade-in delay-200">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-500 transition">
                        Masuk di sini &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>