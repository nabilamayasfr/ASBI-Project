@extends('layout.app')

@section('title', 'SignLearn - Detail Huruf ' . strtoupper($huruf))

@section('content')
<div class="min-h-screen" style="background: linear-gradient(135deg, #FEE6F2 0%, #FCE7F3 100%);">
    <div class="max-w-4xl mx-auto px-4 py-8">

        <!-- Tombol Back -->
        <div class="mb-4">
            <a href="{{ route('pembelajaran.index') }}" class="inline-flex items-center gap-2 text-pink-600 hover:text-pink-700 font-medium transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span>Kembali</span>
            </a>
        </div>

        <!-- Header Card -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6 border border-pink-100">
            <div class="flex items-center gap-4">
                <div class="w-20 h-20 bg-gradient-to-br from-pink-400 to-pink-500 rounded-2xl flex items-center justify-center shadow-md">
                    <span class="text-4xl font-bold text-white">{{ strtoupper($huruf) }}</span>
                </div>

                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Huruf {{ strtoupper($huruf) }}</h1>
                    <p class="text-pink-500 text-sm font-semibold">Modul {{ strtoupper($modul) }}</p>
                </div>
            </div>
        </div>

        {{-- Gambar Isyarat --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6 border border-pink-100">
            <div class="bg-gradient-to-r from-pink-500 to-purple-500 px-6 py-4">
                <h2 class="text-white font-bold text-lg flex items-center gap-2">
                    Belajar Bahasa Isyarat
                </h2>
            </div>

            <div class="p-6">
                <div class="bg-pink-50 rounded-2xl p-8 flex justify-center items-center border-2 border-pink-200">
                    @if($dataModul->thumbnail)
                        <img src="{{ asset('storage/' . $dataModul->thumbnail) }}"
                             alt="Huruf {{ strtoupper($huruf) }}"
                             class="max-w-full h-auto object-contain"
                             style="max-height: 300px;">
                    @else
                        <p class="text-gray-400 text-sm">Thumbnail belum tersedia.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Penjelasan --}}
        <div class="bg-white rounded-xl shadow border p-6 mb-6">
            <h2 class="text-black font-bold text-lg mb-4">
                Penjelasan
            </h2>

            <p class="text-sm text-gray-600 whitespace-pre-line">
                {{ $dataModul->penjelasan ?? 'Penjelasan belum tersedia.' }}
            </p>
        </div>

        <!-- Progress Check -->
        <div class="bg-gradient-to-r from-pink-100 to-purple-100 rounded-2xl p-5 text-center border border-pink-200 shadow-md">
            <p class="text-gray-700 text-sm font-semibold">
                Sudah bisa mempraktikkan huruf {{ strtoupper($huruf) }}?
            </p>

            <a href="{{ route('pembelajaran.index') }}"
               class="inline-block mt-3 bg-gradient-to-r from-green-400 to-green-500 text-white px-6 py-2 rounded-full text-sm font-bold hover:from-green-500 hover:to-green-600 transition shadow-md">
                Tandai Sudah Dikuasai
            </a>
        </div>

    </div>
</div>

@push('scripts')
<script>
    document.querySelectorAll('.bg-pink-100, .bg-purple-100').forEach(el => {
        el.addEventListener('mouseenter', () => {
            el.style.transform = 'scale(1.02)';
            el.style.transition = 'transform 0.2s';
        });

        el.addEventListener('mouseleave', () => {
            el.style.transform = 'scale(1)';
        });
    });
</script>
@endpush

@endsection
