@extends('layout.app')

@section('title', 'SignLearn - Belajar Huruf ' . strtoupper($huruf))

@section('content')

@include('layout.navbar')

<div class="min-h-screen flex flex-col" style="background-color: #FEE6F2;">

    {{-- ===== KONTEN UTAMA ===== --}}
    <div class="flex-1 flex flex-col items-center px-6 py-6 max-w-lg mx-auto w-full">

        {{-- Back Button --}}
        <div class="w-full flex items-center gap-2 mb-6">
            <a href="{{ route('pembelajaran.index') }}"
               class="flex items-center gap-2 text-gray-700 font-bold text-sm hover:text-pink-500 transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2.5">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M15 19l-7-7 7-7"/>
                </svg>

                {{ strtoupper($modul) }}
            </a>
        </div>

        {{-- Progress Bar --}}
        @php
            $alphabet = range('A', 'Z');

            $currentIndex = array_search(strtoupper($huruf), $alphabet);

            $progressPercent = (($currentIndex + 1) / 26) * 100;

            $nextHuruf = $currentIndex < 25
                ? $alphabet[$currentIndex + 1]
                : null;
        @endphp

        <div class="w-full bg-pink-200 rounded-full h-2 mb-8">
            <div class="h-2 rounded-full transition-all duration-300"
                 style="width: {{ $progressPercent }}%;
                        background: linear-gradient(90deg, #F472B6, #DB2777);">
            </div>
        </div>

        {{-- Instruksi --}}
        <p class="text-gray-500 text-sm mb-3">
            Praktikkan gesture huruf berikut
        </p>

        {{-- Huruf --}}
        <div class="w-16 h-16 bg-white rounded-2xl shadow-md flex items-center justify-center mb-6 border border-pink-100">

            <span class="text-3xl font-extrabold text-gray-800">
                {{ strtoupper($huruf) }}
            </span>

        </div>

        {{-- Timer --}}
        <div class="flex flex-col items-center mb-5">

            <div class="w-16 h-16 rounded-full border-4 flex items-center justify-center mb-2"
                 style="border-color: #C07EB5;">

                <span id="timerText"
                      class="text-2xl font-extrabold"
                      style="color: #C07EB5;">

                    5
                </span>
            </div>

            <p class="text-gray-500 text-xs font-medium">
                Detik tersisa
            </p>
        </div>

        {{-- Kamera --}}
        <div class="w-full bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100">

            <div class="relative w-full bg-black"
                 style="height: 220px;">

                {{-- Camera --}}
                <video id="cameraFeed"
                       autoplay
                       playsinline
                       class="w-full h-full object-cover transition duration-300">
                </video>

                {{-- Corner Detection --}}
                <div class="absolute top-3 left-3 w-8 h-8 border-t-2 border-l-2 border-green-400 rounded-tl"></div>
                <div class="absolute top-3 right-3 w-8 h-8 border-t-2 border-r-2 border-green-400 rounded-tr"></div>
                <div class="absolute bottom-3 left-3 w-8 h-8 border-b-2 border-l-2 border-green-400 rounded-bl"></div>
                <div class="absolute bottom-3 right-3 w-8 h-8 border-b-2 border-r-2 border-green-400 rounded-br"></div>

                {{-- Center Line --}}
                <div class="absolute top-0 bottom-0 left-1/2 w-px bg-pink-400 opacity-40"></div>

                {{-- Camera Placeholder --}}
                <div id="cameraPlaceholder"
                     class="absolute inset-0 hidden items-center justify-center bg-gray-800 bg-opacity-50">

                    <p class="text-white text-xs">
                        Kamera tidak tersedia
                    </p>
                </div>

                {{-- Timer Overlay --}}
                <div id="timerOverlay"
                     class="absolute inset-0 hidden flex-col items-center justify-center bg-black/70 z-20">

                    <div class="text-center">


                        <p class="text-pink-200 text-sm mb-5">
                            Klik tombol ulangi untuk mencoba lagi
                        </p>

                        <button onclick="resetPractice()"
                                class="px-5 py-2 rounded-xl bg-pink-500 text-white font-bold hover:bg-pink-600 transition">

                            Ulangi Praktik
                        </button>

                    </div>
                </div>
            </div>

            {{-- Status --}}
            <div class="px-4 py-3 bg-gray-100 text-center">

                <p id="detectionStatus"
                   class="text-gray-500 text-sm font-medium">

                    Mendeteksi Tangan...
                </p>

            </div>
        </div>

        {{-- Tombol Next --}}
        <div class="w-full mt-6">

            @if($nextHuruf)

                <a href="{{ route('pembelajaran.huruf', ['modul' => $modul, 'huruf' => strtolower($nextHuruf)]) }}"
                   class="w-full py-4 rounded-2xl text-sm font-bold text-white transition hover:opacity-90 text-center block shadow-md"
                   style="background: linear-gradient(135deg, #F472B6, #DB2777);">

                    Huruf Berikutnya →
                </a>

            @else

                <a href="{{ route('pembelajaran.index') }}"
                   class="w-full py-4 rounded-2xl text-sm font-bold text-white transition hover:opacity-90 text-center block shadow-md"
                   style="background: linear-gradient(135deg, #F472B6, #DB2777);">

                    Selesai
                </a>

            @endif

        </div>

    </div>

</div>

@push('scripts')
<script>

    let timeLeft = 5;
    let timerInterval = null;

    const timerText = document.getElementById('timerText');
    const detectionStatus = document.getElementById('detectionStatus');

    // TIMER
    function startTimer() {

        if (timerInterval) {
            clearInterval(timerInterval);
        }

        timeLeft = 5;

        timerText.innerText = timeLeft;
        timerText.style.color = '#C07EB5';

        timerInterval = setInterval(() => {

            timeLeft--;

            timerText.innerText = timeLeft >= 0 ? timeLeft : 0;

            if (timeLeft <= 0) {

                clearInterval(timerInterval);

                timerText.innerText = '0';

                detectionStatus.innerText = 'Waktu habis!';
                detectionStatus.style.color = '#EF4444';

                // Blur kamera
                document.getElementById('cameraFeed').style.filter = 'blur(4px)';

                // Tampilkan overlay
                document.getElementById('timerOverlay').classList.remove('hidden');

                return;
            }

        }, 1000);
    }

    // CAMERA
    async function startCamera() {

        try {

            const stream = await navigator.mediaDevices.getUserMedia({
                video: true
            });

            const video = document.getElementById('cameraFeed');

            video.srcObject = stream;

            video.style.display = 'block';

            document.getElementById('cameraPlaceholder').style.display = 'none';

            detectionStatus.innerText = 'Mendeteksi Tangan...';

        } catch (err) {

            console.warn('Kamera tidak bisa diakses:', err);

            document.getElementById('cameraPlaceholder').style.display = 'flex';

            detectionStatus.innerText = 'Izinkan akses kamera untuk mendeteksi isyarat.';
        }
    }

    // RESET PRACTICE
    function resetPractice() {

        // Hapus blur kamera
        document.getElementById('cameraFeed').style.filter = 'blur(0px)';

        // Hilangkan overlay
        document.getElementById('timerOverlay').classList.add('hidden');

        detectionStatus.innerText = 'Mendeteksi Tangan...';
        detectionStatus.style.color = '';

        startTimer();
    }

    // INIT
    startCamera();
    startTimer();

</script>
@endpush

@include('layout.footer')

@endsection
