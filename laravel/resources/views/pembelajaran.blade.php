@extends('layout.app')

@section('title', 'SignLearn - Pembelajaran')

@section('content')

@include('layout.navbar')

{{-- ===== KONTEN UTAMA ===== --}}
<div class="w-full" style="background-color: #FEE6F2;">
    <div class="px-6 py-5 max-w-6xl mx-auto">

        {{-- JUDUL --}}
        <div class="flex justify-between items-start mb-5">
            <div>
                <h1 class="text-3xl font-extrabold" style="color: #D96FAD;">MODE PEMBELAJARAN</h1>
                <p class="text-gray-500 text-sm mt-1">Pilih modul dan pelajari bahasa isyarat A-Z</p>
            </div>
        </div>

        {{-- PROGRESS BELAJAR --}}
        <div class="bg-white rounded-2xl shadow-sm p-5 mb-6 border border-pink-100">
            <h3 class="font-bold text-gray-700 mb-1">Kemajuan Belajar</h3>
            <p class="text-gray-500 text-sm mb-3">Kamu sudah menguasai <span id="progressCountText" class="font-semibold text-gray-700">12/26 huruf (46%)</span></p>
            <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                <div id="progressFillBar" class="h-3 rounded-full transition-all duration-500"
                    style="width: 46%; background: linear-gradient(90deg, #F472B6, #DB2777);"></div>
            </div>
            <p class="text-xs text-gray-400 mt-1" id="progressLabel">(46% filled)</p>
        </div>

        {{-- PILIH MODUL --}}
        <h2 class="text-lg font-bold text-gray-700 mb-3">Pilih Modul</h2>
        <div class="grid grid-cols-2 gap-4 mb-6">

            {{-- BISINDO --}}
            <div id="moduleBisindo" onclick="setActiveModule('BISINDO')"
                class="bg-white rounded-2xl shadow-sm border-2 border-pink-400 p-4 cursor-pointer transition-all duration-300">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">🤟</span>
                        <div>
                            <h3 class="text-base font-extrabold text-gray-800">BISINDO</h3>
                            <p class="text-gray-400 text-xs">Bahasa isyarat Indonesia</p>
                        </div>
                    </div>
                    <button id="btnBisindo"
                        onclick="event.stopPropagation(); setActiveModule('BISINDO')"
                        class="text-xs font-bold px-4 py-2 rounded-xl transition"
                        style="background-color: #D96FAD; color: white;">
                        Aktif
                    </button>
                </div>
            </div>

            {{-- SIBI --}}
            <div id="moduleSibi" onclick="setActiveModule('SIBI')"
                class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-4 cursor-pointer transition-all duration-300">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">✋</span>
                        <div>
                            <h3 class="text-base font-extrabold text-gray-800">SIBI</h3>
                            <p class="text-gray-400 text-xs">Sistem isyarat Bahasa Indonesia</p>
                        </div>
                    </div>
                    <button id="btnSibi"
                        onclick="event.stopPropagation(); setActiveModule('SIBI')"
                        class="text-xs font-bold px-4 py-2 rounded-xl transition bg-gray-100 text-gray-400">
                        Mulai
                    </button>
                </div>
            </div>
        </div>

        {{-- HURUF A-Z --}}
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-pink-100 mb-8">
            <div class="flex items-center gap-2 mb-4">
                <h3 class="text-lg font-extrabold text-gray-800">Huruf A-Z</h3>
                <span id="activeModuleBadge"
                    class="text-xs font-bold px-3 py-1 rounded-full text-white"
                    style="background-color: #D96FAD;">BISINDO</span>
            </div>

            <div class="grid grid-cols-8 gap-2" id="alphabetGrid"></div>
        </div>
    </div>
</div>

<div id="letterModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-[9999] transition-all duration-300" style="display: none;">
    <div class="bg-white rounded-3xl max-w-md w-full mx-6 p-6 shadow-2xl transform transition-all relative my-8">
        <button id="closeModalBtn" class="absolute top-4 right-5 text-gray-400 hover:text-gray-600 text-3xl leading-none z-10">&times;</button>
        <div class="text-center mb-2">
            <h3 class="text-2xl font-extrabold text-gray-800">
                Belajar Huruf <span id="modalLetter" class="text-pink-500">A</span>
            </h3>
        </div>
        <div class="flex justify-center my-5">
            <div class="bg-[#FEF2F8] rounded-2xl p-6 border border-pink-100 w-full flex flex-col items-center">
                <div class="text-7xl font-black text-pink-400 mb-2" id="modalLetterBig">A</div>
                <p class="text-gray-500 text-sm mt-4 text-center" id="modalDescription">
                    Pelajari bahasa isyarat untuk huruf <span id="modalLetterDesc">A</span> dalam modul <span id="modalModuleDesc">BISINDO</span>
                </p>
            </div>
        </div>
        <div class="flex flex-col gap-3 mt-2">
            <button id="viewModuleBtn" class="w-full py-3 rounded-xl font-bold text-pink-600 bg-pink-50 border border-pink-200 hover:bg-pink-100 transition flex items-center justify-center gap-2">
                <span></span> Lihat Modul
            </button>
            <button id="practiceNowBtn" class="w-full py-3 rounded-xl font-bold text-white bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 transition shadow-md flex items-center justify-center gap-2">
                <span></span> Praktik Langsung
            </button>
            <button id="markMasteredModalBtn" class="w-full py-3 rounded-xl font-bold border-2 transition flex items-center justify-center gap-2 border-green-400 text-green-700 bg-green-50 hover:bg-green-100">
                <span></span> Sudah Dikuasai
            </button>
        </div>
    </div>
</div>
@push('scripts')
<script>
    const allLetters = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
    let currentModule = 'BISINDO';
    let masteredLetters = [];
    let selectedLetter = null;

    function loadProgress() {
        const stored = localStorage.getItem('signlearn_mastered');
        masteredLetters = stored ? JSON.parse(stored) : allLetters.slice(0, 12);
        updateProgressUI();
    }

    function updateProgressUI() {
        const count = masteredLetters.length;
        const percent = Math.floor((count / 26) * 100);
        document.getElementById('progressCountText').innerHTML = `${count}/26 huruf (${percent}%)`;
        document.getElementById('progressFillBar').style.width = `${percent}%`;
        document.getElementById('progressLabel').innerHTML = `(${percent}% filled)`;
        renderAlphabetGrid();
    }

    function saveMastered() {
        localStorage.setItem('signlearn_mastered', JSON.stringify(masteredLetters));
        updateProgressUI();
    }

    function renderAlphabetGrid() {
        const grid = document.getElementById('alphabetGrid');
        if (!grid) return;
        grid.innerHTML = '';

        allLetters.forEach(letter => {
            const mastered = masteredLetters.includes(letter);
            const div = document.createElement('div');
            div.className = `relative flex flex-col items-center justify-center py-3 rounded-xl cursor-pointer border-2 transition-all duration-200 select-none
                ${mastered
                    ? 'border-pink-300 shadow-sm'
                    : 'border-gray-200 hover:border-pink-300 bg-white'}`;
            div.style.background = mastered
                ? 'linear-gradient(135deg, #F9A8D4, #EC4899)'
                : '';
            div.innerHTML = `
                <span class="text-base font-extrabold ${mastered ? 'text-white' : 'text-gray-700'}">${letter}</span>
                ${mastered ? '<span class="absolute top-1 right-1.5 text-white text-xs font-bold">✓</span>' : ''}
            `;
            // Klik huruf -> tampilkan modal popup
            div.onclick = () => showModal(letter);
            grid.appendChild(div);
        });
    }

    // Tampilkan modal popup
    function showModal(letter) {
        selectedLetter = letter;
        const isMastered = masteredLetters.includes(letter);

        // Update modal content
        document.getElementById('modalLetter').innerText = letter;
        document.getElementById('modalLetterBig').innerText = letter;
        document.getElementById('modalDescription').innerHTML = `Pelajari bahasa isyarat untuk huruf ${letter} dalam modul ${currentModule}`;

        // Update tombol "Sudah Dikuasai" di modal
        const markBtn = document.getElementById('markMasteredModalBtn');
        if (isMastered) {
            markBtn.innerHTML = ' Sudah Dikuasai';
            markBtn.classList.add('bg-green-100', 'text-green-600', 'border-green-400');
            markBtn.disabled = true;
            markBtn.style.opacity = '0.6';
            markBtn.style.cursor = 'not-allowed';
        } else {
            markBtn.innerHTML = ' Sudah Dikuasai';
            markBtn.classList.remove('bg-green-100', 'text-green-600', 'border-green-400');
            markBtn.disabled = false;
            markBtn.style.opacity = '1';
            markBtn.style.cursor = 'pointer';
        }

        // Tampilkan modal
        document.getElementById('letterModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('letterModal').style.display = 'none';
        selectedLetter = null;
    }
    document.getElementById('viewModuleBtn').onclick = function() {
    if (selectedLetter) {
        window.location.href = `/pembelajaran/${currentModule.toLowerCase()}/${selectedLetter.toLowerCase()}/detail`;
    }
};

    // Tandai huruf sebagai dikuasai (dari modal)
    function markMasteredFromModal() {
        if (!selectedLetter) return;

        if (!masteredLetters.includes(selectedLetter)) {
            masteredLetters.push(selectedLetter);
            saveMastered();
            showToast(`🎉 Huruf ${selectedLetter} berhasil dikuasai! `);
            closeModal();
        } else {
            showToast(`Huruf ${selectedLetter} sudah kamu kuasai sebelumnya! `, 'info');
            closeModal();
        }
    }

    // Praktik: redirect ke halaman detail dengan kamera
    function goToPractice() {
        if (!selectedLetter) return;
        window.location.href = `/pembelajaran/${currentModule.toLowerCase()}/${selectedLetter.toLowerCase()}`;
    }

    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.innerText = message;
        toast.className = `fixed bottom-5 left-1/2 transform -translate-x-1/2 px-5 py-2 rounded-full shadow-lg text-sm z-50 ${type === 'success' ? 'bg-green-500' : 'bg-blue-500'} text-white`;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 2000);
    }

    function setActiveModule(module) {
        currentModule = module;

        const bisindoCard = document.getElementById('moduleBisindo');
        const sibiCard = document.getElementById('moduleSibi');
        const btnBisindo = document.getElementById('btnBisindo');
        const btnSibi = document.getElementById('btnSibi');
        const badge = document.getElementById('activeModuleBadge');

        if (module === 'BISINDO') {
            bisindoCard.classList.add('border-pink-400');
            bisindoCard.classList.remove('border-gray-200');
            sibiCard.classList.add('border-gray-200');
            sibiCard.classList.remove('border-pink-400');

            btnBisindo.innerText = 'Aktif';
            btnBisindo.style.backgroundColor = '#D96FAD';
            btnBisindo.style.color = 'white';
            btnSibi.innerText = 'Mulai';
            btnSibi.style.backgroundColor = '';
            btnSibi.style.color = '#9CA3AF';
            btnSibi.className = 'text-xs font-bold px-4 py-2 rounded-xl transition bg-gray-100 text-gray-400';
        } else {
            sibiCard.classList.add('border-pink-400');
            sibiCard.classList.remove('border-gray-200');
            bisindoCard.classList.add('border-gray-200');
            bisindoCard.classList.remove('border-pink-400');

            btnSibi.innerText = 'Aktif';
            btnSibi.style.backgroundColor = '#D96FAD';
            btnSibi.style.color = 'white';
            btnBisindo.innerText = 'Mulai';
            btnBisindo.style.backgroundColor = '';
            btnBisindo.style.color = '#9CA3AF';
            btnBisindo.className = 'text-xs font-bold px-4 py-2 rounded-xl transition bg-gray-100 text-gray-400';
        }

        badge.innerText = module;
        renderAlphabetGrid();
    }

    // Event binding modal
    document.getElementById('closeModalBtn').onclick = closeModal;
    document.getElementById('markMasteredModalBtn').onclick = markMasteredFromModal;
    document.getElementById('practiceNowBtn').onclick = goToPractice;

    // Tutup modal klik di luar
    document.getElementById('letterModal').onclick = (e) => {
        if (e.target === document.getElementById('letterModal')) {
            closeModal();
        }
    };

    // Inisialisasi
    loadProgress();
    setActiveModule('BISINDO');
</script>
@endpush
@include('layout.footer')
@endsection
