@extends('layout.app')

@section('title', 'SignLearn - Daftar Akun')

@section('content')

<style>
    /* Sembunyikan ikon mata bawaan browser pada input password */
    input[type="password"]::-ms-reveal,
    input[type="password"]::-ms-clear,
    input[type="password"]::-webkit-contacts-auto-fill-button,
    input[type="password"]::-webkit-credentials-auto-fill-button {
        display: none !important;
        visibility: hidden;
        pointer-events: none;
    }
</style>

<div class="min-h-screen flex items-center justify-center p-4" style="background-color: #FEE6F2;">
    <div class="w-full max-w-4xl rounded-3xl overflow-hidden shadow-xl flex" style="min-height: 500px;">

        {{-- KIRI: Ilustrasi --}}
        <div class="w-1/2 flex items-center justify-center"
            style="background: linear-gradient(180deg, #F9C5E2 0%, #C07EB5 100%);">
            <img src="{{ asset('assets/logo.png') }}"
                alt="Mascot SignLearn"
                class="max-w-[80%] max-h-[80%] object-contain" />
        </div>

        {{-- KANAN: Form PUTIH --}}
        <div class="w-1/2 flex flex-col justify-center px-10 py-8 bg-white">

            <div class="flex justify-center mb-3">
                <img src="{{ asset('assets/logo.png') }}"
                    alt="Logo SignLearn"
                    class="h-16 object-contain" />
            </div>

            <h1 class="text-2xl font-bold text-center text-gray-800 mb-1">
                Daftar Ke <span style="color: #C07EB5;">SIGNLEARN</span>
            </h1>
            <p class="text-center text-gray-500 text-xs mb-5">
                Belajar Bahasa Isyarat dengan AI Secara Mandiri
            </p>

            {{-- Tampilkan error global --}}
            @if (session('error'))
                <div class="bg-red-50 border border-red-200 rounded-xl px-4 py-2 mb-4">
                    <p class="text-red-500 text-xs text-center">{{ session('error') }}</p>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST" class="space-y-3">
                @csrf

                {{-- Nama Lengkap --}}
                <div>
                    <label class="block text-xs text-gray-600 mb-1 ml-1">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-300 transition @error('nama_lengkap') border-red-400 @enderror" />
                    @error('nama_lengkap')
                        <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nama Pengguna --}}
                <div>
                    <label class="block text-xs text-gray-600 mb-1 ml-1">Nama Pengguna</label>
                    <input type="text" name="username" value="{{ old('username') }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-300 transition @error('username') border-red-400 @enderror" />
                    @error('username')
                        <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-xs text-gray-600 mb-1 ml-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-300 transition @error('email') border-red-400 @enderror" />
                    @error('email')
                        <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kata Sandi & Konfirmasi --}}
                <div class="flex gap-3">
                    <div class="w-1/2">
                        <label class="block text-xs text-gray-600 mb-1 ml-1">Kata Sandi</label>
                        <div class="relative">
                            <input type="password" name="password" id="password"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-300 transition pr-10 @error('password') border-red-400 @enderror" />
                            <button type="button" id="togglePassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg id="eyeOffIcon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-1/2">
                        <label class="block text-xs text-gray-600 mb-1 ml-1">Konfirmasi Kata Sandi</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-300 transition pr-10" />
                            <button type="button" id="toggleConfirmPassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                                <svg id="eyeIconConfirm" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg id="eyeOffIconConfirm" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Nomor Telepon --}}
                <div>
                    <label class="block text-xs text-gray-600 mb-1 ml-1">Nomor Telepon</label>
                    <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon') }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-300 transition @error('nomor_telepon') border-red-400 @enderror" />
                    @error('nomor_telepon')
                        <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full py-2.5 rounded-xl text-white font-semibold text-sm tracking-wide transition duration-200 hover:opacity-90 active:scale-95 shadow-md"
                    style="background-color: #D96FAD;">
                    Daftar
                </button>

                <p class="text-center text-xs text-gray-500 pt-1">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-bold text-gray-700 hover:underline">Masuk</a>
                </p>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Toggle Password
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    const eyeOffIcon = document.getElementById('eyeOffIcon');

    if (togglePassword) {
        togglePassword.addEventListener('click', function () {
            const isHidden = passwordInput.type === 'password';
            passwordInput.type = isHidden ? 'text' : 'password';
            eyeIcon.classList.toggle('hidden', isHidden);
            eyeOffIcon.classList.toggle('hidden', !isHidden);
        });
    }

    // Toggle Confirm Password
    const toggleConfirm = document.getElementById('toggleConfirmPassword');
    const confirmInput = document.getElementById('password_confirmation');
    const eyeIconConfirm = document.getElementById('eyeIconConfirm');
    const eyeOffIconConfirm = document.getElementById('eyeOffIconConfirm');

    if (toggleConfirm) {
        toggleConfirm.addEventListener('click', function () {
            const isHidden = confirmInput.type === 'password';
            confirmInput.type = isHidden ? 'text' : 'password';
            eyeIconConfirm.classList.toggle('hidden', isHidden);
            eyeOffIconConfirm.classList.toggle('hidden', !isHidden);
        });
    }
</script>
@endpush

@endsection
