@extends('layout.app')

@section('title', 'SignLearn - FAQ')

@section('content')

@include('layout.navbar')

<div class="bg-pink-50 min-h-screen">

    {{-- FAQ SECTION --}}
    <section class="px-6 pt-10 pb-12">
        <div class="max-w-7xl mx-auto">

            <div class="flex items-start gap-2 mb-1">
                <span class="text-3xl font-black text-gray-800 leading-tight">?</span>
                <h1 class="text-3xl font-black text-gray-800 leading-tight">
                    Pertanyaan yang sering di ajukan <span class="text-pink-500">(FAQ)</span>
                </h1>
            </div>
            <p class="text-gray-500 text-sm mb-8 ml-[42px]">Temukan jawaban untuk pertanyaan yang sering ditanyakan.</p>

            @php
                $faqs = [
                    ['q' => 'Apa itu SIGNLEARN?', 'a' => 'SIGNLEARN adalah aplikasi pembelajaran bahasa isyarat berbasis Artificial Intelligence (AI) yang membantu pengguna belajar dan melatih gesture bahasa isyarat secara mandiri melalui video dan latihan berbasis kamera.'],
                    ['q' => 'Apakah SIGNLEARN gratis?', 'a' => 'Ya, SIGNLEARN dapat digunakan secara gratis untuk belajar bahasa isyarat. Beberapa fitur tambahan dapat dikembangkan di masa depan.'],
                    ['q' => 'Apa perbedaan SIBI dan BISINDO?', 'a' => 'SIBI (Sistem Isyarat Bahasa Indonesia) adalah bahasa isyarat yang dikembangkan oleh pemerintah dan mengikuti tata bahasa Indonesia. BISINDO (Bahasa Isyarat Indonesia) adalah bahasa isyarat alami yang digunakan oleh komunitas tuli di Indonesia dengan tata bahasanya sendiri.'],
                    ['q' => 'Bagaimana cara menggunakan fitur latihan?', 'a' => 'Masuk ke halaman Latihan, pilih materi yang ingin dilatih, lalu izinkan akses kamera. Aplikasi akan mendeteksi gerakan tangan kamu secara real-time dan memberikan feedback langsung.'],
                    ['q' => 'Apakah data dan video latihan saya aman?', 'a' => 'Ya, data dan video kamu aman. Kamera hanya digunakan secara lokal untuk mendeteksi gerakan dan tidak ada rekaman yang disimpan atau dikirim ke server.'],
                    ['q' => 'Apakah aplikasi ini cocok untuk anak-anak?', 'a' => 'Ya, SIGNLEARN dirancang dengan tampilan yang ramah dan mudah digunakan oleh semua usia, termasuk anak-anak. Konten disajikan secara visual dan interaktif.'],
                    ['q' => 'Apakah SIGNLEARN gratis?', 'a' => 'Ya, SIGNLEARN sepenuhnya gratis untuk diakses. Daftar sekarang dan mulai perjalanan belajar bahasa isyarat kamu!'],
                ];
            @endphp

            @foreach($faqs as $i => $faq)
            <div class="bg-white rounded-2xl shadow-md mb-3 overflow-hidden hover:shadow-lg" id="faq-{{ $i }}">
                <button class="w-full flex items-center gap-3 p-4 text-left cursor-pointer focus:outline-none" onclick="toggleFaq({{ $i }})">
                    <span class="w-7 h-7 rounded-full bg-pink-500 flex items-center justify-center text-white font-bold text-xs shrink-0">?</span>
                    <span class="flex-1 font-bold text-gray-800 text-sm text-left">{{ $faq['q'] }}</span>
                    <svg class="w-5 h-5 text-gray-400 transition-transform duration-300 shrink-0 faq-chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <!-- faq-body dengan Tailwind transition -->
                <div class="faq-body transition-all duration-350 ease-in-out overflow-hidden" style="max-height: 0px;" id="faq-body-{{ $i }}">
                    <div class="pl-10 pr-6 pb-4 pt-3 border-t border-pink-100">
                        <p class="text-sm text-gray-600 leading-relaxed text-left">{{ $faq['a'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- CARA PENGGUNAAN --}}
    <section class="px-6 py-10 bg-pink-50">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-2xl px-8 py-5 mb-5 shadow-sm text-center">
                <h2 class="text-2xl font-black text-gray-800 mb-0.5">Cara Penggunaan</h2>
                <p class="text-gray-500 text-sm">Ikuti langkah mudah berikut untuk mulai belajar di SIGNLEARN.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                <!-- Card 1 -->
                <div class="bg-white rounded-xl border border-pink-100 shadow-md p-4 flex flex-col items-center text-center transition-all duration-200 hover:-translate-y-1 hover:shadow-xl hover:border-pink-200 h-full">
                    <div class="w-full aspect-square rounded-xl bg-gradient-to-br from-pink-200 to-purple-300 flex items-center justify-center mb-3 overflow-hidden shadow-inner">
                        <img src="{{ asset('assets/logo.png') }}" alt="Step 1" class="w-3/4 h-3/4 object-contain" />
                    </div>
                    <p class="text-xs text-gray-700 leading-relaxed mb-3 flex-1">1. Masuk atau Daftar ke halaman Aplikasi SIGNLEARN</p>
                    <a href="/register" class="inline-block w-full max-w-[120px] px-3 py-1.5 rounded-full bg-pink-500 text-white text-xs font-bold shadow-md hover:bg-pink-600 transition duration-200 text-center">Daftar</a>
                </div>
                <!-- Card 2 -->
                <div class="bg-white rounded-xl border border-pink-100 shadow-md p-4 flex flex-col items-center text-center transition-all duration-200 hover:-translate-y-1 hover:shadow-xl hover:border-pink-200 h-full">
                    <div class="w-full aspect-square rounded-xl bg-gradient-to-br from-pink-200 to-purple-300 flex items-center justify-center mb-3 overflow-hidden shadow-inner">
                        <img src="{{ asset('assets/logo.png') }}" alt="Step 2" class="w-3/4 h-3/4 object-contain" />
                    </div>
                    <p class="text-xs text-gray-700 leading-relaxed mb-3 flex-1">2. Pilih huruf yang ingin kamu pelajari di halaman pembelajaran.</p>
                    <a href="/pembelajaran" class="inline-block w-full max-w-[120px] px-3 py-1.5 rounded-full bg-pink-500 text-white text-xs font-bold shadow-md hover:bg-pink-600 transition duration-200 text-center">Buka Materi</a>
                </div>
                <!-- Card 3 -->
                <div class="bg-white rounded-xl border border-pink-100 shadow-md p-4 flex flex-col items-center text-center transition-all duration-200 hover:-translate-y-1 hover:shadow-xl hover:border-pink-200 h-full">
                    <div class="w-full aspect-square rounded-xl bg-gradient-to-br from-pink-200 to-purple-300 flex items-center justify-center mb-3 overflow-hidden shadow-inner">
                        <img src="{{ asset('assets/logo.png') }}" alt="Step 3" class="w-3/4 h-3/4 object-contain" />
                    </div>
                    <p class="text-xs text-gray-700 leading-relaxed mb-3 flex-1">3. Tiru gerakan yang ditampilkan dan gunakan kamera untuk deteksi real-time.</p>
                    <a href="/latihan" class="inline-block w-full max-w-[120px] px-3 py-1.5 rounded-full bg-pink-500 text-white text-xs font-bold shadow-md hover:bg-pink-600 transition duration-200 text-center">Mulai Latihan</a>
                </div>
                <!-- Card 4 -->
                <div class="bg-white rounded-xl border border-pink-100 shadow-md p-4 flex flex-col items-center text-center transition-all duration-200 hover:-translate-y-1 hover:shadow-xl hover:border-pink-200 h-full">
                    <div class="w-full aspect-square rounded-xl bg-gradient-to-br from-pink-200 to-purple-300 flex items-center justify-center mb-3 overflow-hidden shadow-inner">
                        <img src="{{ asset('assets/logo.png') }}" alt="Step 4" class="w-3/4 h-3/4 object-contain" />
                    </div>
                    <p class="text-xs text-gray-700 leading-relaxed mb-3 flex-1">4. Lihat feedback dan tingkatkan latihanmu.</p>
                    <a href="/histori" class="inline-block w-full max-w-[120px] px-3 py-1.5 rounded-full bg-pink-500 text-white text-xs font-bold shadow-md hover:bg-pink-600 transition duration-200 text-center">Lihat Progress</a>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    var openIndex = null;
    function toggleFaq(index) {
        var card = document.getElementById('faq-' + index);
        var body = document.getElementById('faq-body-' + index);
        var chevron = card.querySelector('.faq-chevron');
        if (openIndex === index) {
            body.style.maxHeight = '0px';
            card.classList.remove('border-pink-300', 'shadow-lg');
            chevron.classList.remove('rotate-180', 'text-pink-500');
            openIndex = null;
        } else {
            if (openIndex !== null) {
                var prevBody = document.getElementById('faq-body-' + openIndex);
                var prevCard = document.getElementById('faq-' + openIndex);
                var prevChevron = prevCard.querySelector('.faq-chevron');
                prevBody.style.maxHeight = '0px';
                prevCard.classList.remove('border-pink-300', 'shadow-lg');
                prevChevron.classList.remove('rotate-180', 'text-pink-500');
            }
            body.style.maxHeight = body.scrollHeight + 'px';
            card.classList.add('border-pink-300', 'shadow-lg');
            chevron.classList.add('rotate-180', 'text-pink-500');
            openIndex = index;
        }
    }
</script>
@endpush
@include('layout.footer')
@endsection
