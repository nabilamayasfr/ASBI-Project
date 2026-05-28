@extends('layout.app')

@section('title', 'SignLearn - Admin Login')

@section('content')

<div class="min-h-screen flex items-center justify-center p-4" style="background-color: #FEE6F2;">
    <div class="w-full max-w-4xl rounded-3xl overflow-hidden shadow-xl flex" style="min-height: 500px;">

        {{-- KIRI: Ilustrasi --}}
        <div class="w-1/2 flex items-center justify-center"
            style="background: linear-gradient(180deg, #F9C5E2 0%, #C07EB5 100%);">
            <img src="{{ asset('assets/logo.png') }}"
                alt="Mascot SignLearn"
                class="max-w-[80%] max-h-[80%] object-contain" />
        </div>

        {{-- KANAN: Form Admin --}}
        <div class="w-1/2 flex flex-col justify-center px-10 py-8 bg-white">

            <div class="flex justify-center mb-3">
                <img src="{{ asset('assets/logo.png') }}"
                    alt="Logo SignLearn"
                    class="h-16 object-contain" />
            </div>

            <h1 class="text-2xl font-bold text-center text-gray-800 mb-1">
                Admin <span style="color: #C07EB5;">SignLearn</span>
            </h1>
            <p class="text-center text-gray-500 text-xs mb-5">
                Masuk sebagai administrator
            </p>

            @if (session('error'))
                <div class="bg-red-50 border border-red-200 rounded-xl px-4 py-2 mb-4">
                    <p class="text-red-500 text-xs text-center">{{ session('error') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-xl px-4 py-2 mb-4">
                    <p class="text-red-500 text-xs text-center">Username atau password salah.</p>
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-3">
                @csrf

                <div>
                    <label class="block text-xs text-gray-600 mb-1 ml-1">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-300 transition" />
                </div>

                <div>
                    <label class="block text-xs text-gray-600 mb-1 ml-1">Kata Sandi</label>
                    <div class="relative">
                        <input type="password" name="password" id="password"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-300 transition pr-10" />
                        <button type="button" id="togglePassword"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
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
                </div>

                <button type="submit"
                    class="w-full py-2.5 rounded-xl text-white font-semibold text-sm tracking-wide transition duration-200 hover:opacity-90 active:scale-95 shadow-md"
                    style="background-color: #D96FAD;">
                    Masuk sebagai Admin
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
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
</script>
@endpush

@endsection
