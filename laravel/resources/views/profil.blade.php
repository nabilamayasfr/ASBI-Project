@extends('layout.app')

@section('title', 'SignLearn - Profil')

@section('content')

@include('layout.navbar')

<div class="w-full" style="background-color: #FEE6F2;">
    <div class="px-6 py-5 max-w-5xl mx-auto">

        {{-- Notifikasi Session --}}
        @if(session('success'))
        <div id="successMessage" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div id="errorMessage" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- ===== INFORMASI AKUN ===== --}}
        <div class="bg-white rounded-2xl shadow-sm border border-pink-100 p-6 mb-6">
            <h2 class="text-lg font-extrabold text-gray-800 mb-4">Informasi Akun</h2>

            {{-- PERHATIAN: action menggunakan route('profile.update') --}}
            <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                {{-- Nama Lengkap --}}
                <div>
                    <label class="block text-xs text-gray-500 mb-1 ml-1">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap"
                        value="{{ old('nama_lengkap', $user->name) }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-300 transition @error('nama_lengkap') border-red-500 @enderror" />
                    @error('nama_lengkap')
                        <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Username --}}
                <div>
                    <label class="block text-xs text-gray-500 mb-1 ml-1">Username</label>
                    <input type="text" name="username"
                        value="{{ old('username', $user->username) }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-300 transition @error('username') border-red-500 @enderror" />
                    @error('username')
                        <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-xs text-gray-500 mb-1 ml-1">Email</label>
                    <input type="email" name="email"
                        value="{{ old('email', $user->email) }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-300 transition @error('email') border-red-500 @enderror" />
                    @error('email')
                        <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- No. Telepon --}}
                <div>
                    <label class="block text-xs text-gray-500 mb-1 ml-1">No. Telepon</label>
                    <input type="tel" name="nomor_telepon"
                        value="{{ old('nomor_telepon', $user->phone) }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-300 transition @error('nomor_telepon') border-red-500 @enderror" />
                    @error('nomor_telepon')
                        <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="my-4 border-gray-200">

                {{-- Ganti Password --}}
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-xs text-gray-500 ml-1">Password Baru (Opsional)</label>
                        <button type="button" onclick="togglePassword()"
                            class="text-xs text-pink-500 hover:text-pink-600 font-semibold">
                            Ganti Password
                        </button>
                    </div>

                    <div id="passwordSection" style="display: none;">
                        <input type="password" name="password" id="password"
                            placeholder="Masukkan password baru (minimal 8 karakter)"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-300 transition mb-2" />
                        @error('password')
                            <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror

                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Konfirmasi password baru"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-300 transition" />
                    </div>
                </div>

                {{-- Tombol Simpan --}}
                <div class="pt-3">
                    <button type="submit"
                        class="px-6 py-2 rounded-xl text-white text-sm font-semibold transition hover:opacity-90"
                        style="background-color: #D96FAD;">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>

        {{-- ===== STATISTIK ===== --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <div class="bg-white rounded-2xl shadow-sm border border-pink-100 p-5 text-center hover:shadow-md transition">
                <p class="text-sm text-gray-500 font-medium">Total Latihan</p>
                <p class="text-4xl font-extrabold text-gray-800 mt-1">{{ $totalLatihan ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-pink-100 p-5 text-center hover:shadow-md transition">
                <p class="text-sm text-gray-500 font-medium">Huruf Terakhir</p>
                <p class="text-4xl font-extrabold text-gray-800 mt-1">{{ $hurufTerakhir ?? '-' }}</p>
            </div>
        </div>

        {{-- ===== KEMAJUAN BELAJAR ===== --}}
        <div class="bg-white rounded-2xl shadow-sm border border-pink-100 p-5 mb-8">
            <div class="flex items-center gap-2 mb-1">
                <h3 class="font-extrabold text-gray-800">Kemajuan Belajar</h3>
            </div>
            <p class="text-gray-500 text-sm mb-3">Kamu sudah menguasai <span class="font-semibold text-gray-700">{{ $progressCount ?? 0 }}</span>/26 huruf (<span>{{ $progressPercent ?? 0 }}</span>%)</p>
            <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                <div class="h-3 rounded-full transition-all duration-500"
                     style="width: {{ $progressPercent ?? 0 }}%; background: linear-gradient(90deg, #F472B6, #DB2777);"></div>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle password section
    function togglePassword() {
        const section = document.getElementById('passwordSection');
        if (section.style.display === 'none' || section.style.display === '') {
            section.style.display = 'block';
        } else {
            section.style.display = 'none';
            document.getElementById('password').value = '';
            document.getElementById('password_confirmation').value = '';
        }
    }

    // Auto hide messages after 3 seconds
    setTimeout(function() {
        const successMsg = document.getElementById('successMessage');
        const errorMsg = document.getElementById('errorMessage');
        if (successMsg) successMsg.style.display = 'none';
        if (errorMsg) errorMsg.style.display = 'none';
    }, 3000);
</script>

@include('layout.footer')
@endsection
