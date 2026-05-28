@extends('layout.app')
@section('title', 'SignLearn - Latihan')
@section('content')

@push('styles')
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap');
  * { font-family: 'Poppins', sans-serif; }

  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  @keyframes fadeIn {
    from { opacity: 0; } to { opacity: 1; }
  }
  @keyframes popIn {
    0%   { transform: scale(0.85); opacity: 0; }
    70%  { transform: scale(1.04); }
    100% { transform: scale(1);    opacity: 1; }
  }
  @keyframes shake {
    0%,100% { transform: translateX(0); }
    20%     { transform: translateX(-8px); }
    40%     { transform: translateX(8px); }
    60%     { transform: translateX(-5px); }
    80%     { transform: translateX(5px); }
  }

  .animate-fadeUp   { animation: fadeUp  0.5s ease; }
  .animate-fadeIn   { animation: fadeIn  0.4s ease; }
  .animate-popIn    { animation: popIn   0.4s ease; }
  .animate-popIn-lg { animation: popIn   0.5s ease; }
  .animate-shake    { animation: shake   0.4s ease; }

  /* Radio dot inner circle via pseudo-element */
  .level-radio-dot::after {
    content: '';
    display: block;
    width: 9px; height: 9px;
    border-radius: 50%;
    background: #fff;
    opacity: 0;
    transition: opacity 0.2s;
    margin: auto;
  }
  .level-item.selected .level-radio-dot::after { opacity: 1; }

  .pilihan-radio-circle::after {
    content: '';
    display: block;
    width: 8px; height: 8px;
    border-radius: 50%;
    background: #C82D85;
    opacity: 0;
    transition: opacity 0.2s;
    margin: auto;
  }
  .pilihan-item.selected .pilihan-radio-circle::after { opacity: 1; }
  .pilihan-item.correct  .pilihan-radio-circle::after { opacity: 1; background: #fff; }
  .pilihan-item.wrong    .pilihan-radio-circle::after { opacity: 1; background: #fff; }

  /* State classes applied via JS */
  .pilihan-item.correct {
    border-color: #5CB87A !important;
    background: #E8F8EE  !important;
  }
  .pilihan-item.correct .pilihan-radio-circle {
    border-color: #5CB87A !important;
    background: #5CB87A  !important;
  }
  .pilihan-item.correct .pilihan-text { color: #2D6A3F !important; }
  .pilihan-item.correct .check-icon   { display: block !important; }

  .pilihan-item.wrong {
    border-color: #E57373 !important;
    background: #FDECEC  !important;
    opacity: 0.80        !important;
  }
  .pilihan-item.wrong .pilihan-radio-circle {
    border-color: #E57373 !important;
    background: #E57373  !important;
  }
  .pilihan-item.wrong .pilihan-text { color: #8B2020 !important; }

  .pilihan-item.locked  { cursor: default !important; }
  /* Selected state untuk bahasa items */
  .bahasa-item.selected {
    border-color: #C82D85 !important;
    background: #FEF0F8  !important;
    box-shadow: 0 8px 28px rgba(200,45,133,0.22) !important;
  }
  .bahasa-item.selected .bahasa-radio-dot {
    border-color: #C82D85 !important;
    background: #C82D85  !important;
  }
  .bahasa-radio-dot::after {
    content: '';
    display: block;
    width: 9px; height: 9px;
    border-radius: 50%;
    background: #fff;
    opacity: 0;
    transition: opacity 0.2s;
    margin: auto;
  }
  .bahasa-item.selected .bahasa-radio-dot::after { opacity: 1; }
  /* Selected state for level items */
  .level-item.selected {
    border-color: #C82D85 !important;
    background: #FEF0F8  !important;
    box-shadow: 0 8px 28px rgba(200,45,133,0.22) !important;
  }
  .level-item.selected .level-radio-dot {
    border-color: #C82D85 !important;
    background: #C82D85  !important;
  }

  /* Selected state for pilihan items */
  .pilihan-item.selected .pilihan-radio-circle {
    border-color: #C82D85 !important;
  }

  /* Feedback display toggle */
  .soal-feedback        { display: none; }
  .soal-feedback.benar  { display: block; animation: popIn 0.3s ease; }
  .soal-feedback.salah  { display: block; animation: shake 0.4s ease; }

  /* btn-next-soal visible toggle */
  .btn-next-soal         { display: none; }
  .btn-next-soal.visible { display: block; animation: fadeUp 0.3s ease; }

  /* check-icon toggle */
  .check-icon { display: none; }
</style>
@endpush

{{-- ══════════════════════════════════════════════
     WRAPPER
══════════════════════════════════════════════ --}}
<div class="min-h-screen pb-[60px]"
     style="background: linear-gradient(160deg, #FFE8F4 0%, #FFF0F8 40%, #FDE6F2 100%);">

  {{-- NAVBAR --}}
  @include('layout.navbar')

  {{-- CONTENT --}}
  <div class="max-w-[720px] mx-auto px-6 pt-9 pb-12">


    {{-- ══════════════════════════════
         SCREEN 1 — PILIH LEVEL
    ══════════════════════════════ --}}
    <div id="screen-level" class="animate-fadeUp">

      {{-- Header card --}}
      <div class="bg-white rounded-[22px] px-8 py-9 text-center
                  shadow-[0_6px_28px_rgba(200,45,133,0.10)]
                  border border-[#F7DAED] mb-8">
        <h1 class="text-[1.75rem] font-extrabold text-[#492F48] mb-2">
          Kuis Praktik Isyarat
        </h1>
        <p class="text-[0.97rem] text-[#7A4B78] font-medium">
          Uji kemampuan mengenali huruf BISINDO dan SIBI
        </p>
      </div>

      {{-- ── Pilih Bahasa ── --}}
      <p class="text-[1.2rem] font-extrabold text-[#492F48] mb-4">Pilih Bahasa</p>

      <div class="flex gap-3 mb-7">

        {{-- BISINDO --}}
        <label class="bahasa-item flex-1 flex items-center justify-between bg-white
                      border-2 border-[#F2B8D8] rounded-[18px] px-[22px] py-4
                      cursor-pointer transition-all duration-200
                      shadow-[0_3px_14px_rgba(200,45,133,0.07)]
                      hover:border-[#C82D85] hover:shadow-[0_8px_24px_rgba(200,45,133,0.18)]
                      hover:-translate-y-0.5"
              id="lbl-bisindo" onclick="selectBahasa('bisindo', this)">
          <div>
            <h3 class="text-[1.05rem] font-bold text-[#492F48] mb-0.5">BISINDO</h3>
            <span class="text-[0.78rem] text-[#9B6898] font-medium">Bahasa Isyarat Indonesia</span>
          </div>
          <div class="bahasa-radio-dot w-[22px] h-[22px] rounded-full border-2 border-[#D8A8CE]
                      bg-white flex items-center justify-center transition-all duration-200
                      flex-shrink-0"></div>
        </label>

        {{-- SIBI --}}
        <label class="bahasa-item flex-1 flex items-center justify-between bg-white
                      border-2 border-[#F2B8D8] rounded-[18px] px-[22px] py-4
                      cursor-pointer transition-all duration-200
                      shadow-[0_3px_14px_rgba(200,45,133,0.07)]
                      hover:border-[#C82D85] hover:shadow-[0_8px_24px_rgba(200,45,133,0.18)]
                      hover:-translate-y-0.5"
              id="lbl-sibi" onclick="selectBahasa('sibi', this)">
          <div>
            <h3 class="text-[1.05rem] font-bold text-[#492F48] mb-0.5">SIBI</h3>
            <span class="text-[0.78rem] text-[#9B6898] font-medium">Sistem Isyarat Bahasa Indonesia</span>
          </div>
          <div class="bahasa-radio-dot w-[22px] h-[22px] rounded-full border-2 border-[#D8A8CE]
                      bg-white flex items-center justify-center transition-all duration-200
                      flex-shrink-0"></div>
        </label>

      </div>
      <p class="text-[1.2rem] font-extrabold text-[#492F48] mb-4">Pilih Level</p>

      {{-- Level list --}}
      <div class="flex flex-col gap-[14px] mb-7">

        {{-- Pemula --}}
        <label class="level-item flex items-center justify-between bg-white
                       border-2 border-[#F2B8D8] rounded-[18px] px-[22px] py-4
                       cursor-pointer transition-all duration-200
                       shadow-[0_3px_14px_rgba(200,45,133,0.07)]
                       hover:border-[#C82D85] hover:shadow-[0_8px_24px_rgba(200,45,133,0.18)]
                       hover:-translate-y-0.5"
               id="lbl-pemula" onclick="selectLevel('pemula', this)">
          <div class="flex items-center gap-4">
            <img src="{{ asset('assets/icon-level.png') }}" alt="Pemula"
                 class="w-[52px] h-[52px] object-contain rounded-xl flex-shrink-0
                        drop-shadow-[0_3px_6px_rgba(200,45,133,0.18)]">
            <div>
              <h3 class="text-[1.05rem] font-bold text-[#492F48] mb-0.5">Pemula</h3>
              <span class="text-[0.82rem] text-[#9B6898] font-medium">Soal Mudah</span>
            </div>
          </div>
          <input type="radio" name="level" value="pemula" class="hidden">
          <div class="level-radio-dot w-[22px] h-[22px] rounded-full border-2 border-[#D8A8CE]
                      bg-white flex items-center justify-center transition-all duration-200
                      flex-shrink-0"></div>
        </label>

        {{-- Menengah --}}
        <label class="level-item flex items-center justify-between bg-white
                       border-2 border-[#F2B8D8] rounded-[18px] px-[22px] py-4
                       cursor-pointer transition-all duration-200
                       shadow-[0_3px_14px_rgba(200,45,133,0.07)]
                       hover:border-[#C82D85] hover:shadow-[0_8px_24px_rgba(200,45,133,0.18)]
                       hover:-translate-y-0.5"
               id="lbl-menengah" onclick="selectLevel('menengah', this)">
          <div class="flex items-center gap-4">
            <img src="{{ asset('assets/icon-level.png') }}" alt="Menengah"
                 class="w-[52px] h-[52px] object-contain rounded-xl flex-shrink-0
                        drop-shadow-[0_3px_6px_rgba(200,45,133,0.18)]">
            <div>
              <h3 class="text-[1.05rem] font-bold text-[#492F48] mb-0.5">Menengah</h3>
              <span class="text-[0.82rem] text-[#9B6898] font-medium">Soal Sedang</span>
            </div>
          </div>
          <input type="radio" name="level" value="menengah" class="hidden">
          <div class="level-radio-dot w-[22px] h-[22px] rounded-full border-2 border-[#D8A8CE]
                      bg-white flex items-center justify-center transition-all duration-200
                      flex-shrink-0"></div>
        </label>

        {{-- Mahir --}}
        <label class="level-item flex items-center justify-between bg-white
                       border-2 border-[#F2B8D8] rounded-[18px] px-[22px] py-4
                       cursor-pointer transition-all duration-200
                       shadow-[0_3px_14px_rgba(200,45,133,0.07)]
                       hover:border-[#C82D85] hover:shadow-[0_8px_24px_rgba(200,45,133,0.18)]
                       hover:-translate-y-0.5"
               id="lbl-mahir" onclick="selectLevel('mahir', this)">
          <div class="flex items-center gap-4">
            <img src="{{ asset('assets/icon-level.png') }}" alt="Mahir"
                 class="w-[52px] h-[52px] object-contain rounded-xl flex-shrink-0
                        drop-shadow-[0_3px_6px_rgba(200,45,133,0.18)]">
            <div>
              <h3 class="text-[1.05rem] font-bold text-[#492F48] mb-0.5">Mahir</h3>
              <span class="text-[0.82rem] text-[#9B6898] font-medium">Soal Sulit</span>
            </div>
          </div>
          <input type="radio" name="level" value="mahir" class="hidden">
          <div class="level-radio-dot w-[22px] h-[22px] rounded-full border-2 border-[#D8A8CE]
                      bg-white flex items-center justify-center transition-all duration-200
                      flex-shrink-0"></div>
        </label>

      </div>{{-- /level-list --}}

      <button id="btn-mulai"
              onclick="mulaiKuis()"
              disabled
              class="w-full py-[15px] rounded-[16px] bg-[#C82D85] text-white
                    font-extrabold text-[1.05rem]
                    shadow-[0_6px_20px_rgba(200,45,133,0.32)]
                    transition-all duration-200
                    hover:bg-[#951651] hover:-translate-y-0.5
                    disabled:opacity-40 disabled:cursor-not-allowed disabled:transform-none">
        Mulai Kuis →
      </button>
    </div>{{-- /screen-level --}}


    {{-- ══════════════════════════════
         SCREEN 2 — SOAL
    ══════════════════════════════ --}}
    <div id="screen-soal" class="animate-fadeIn" style="display:none;">

      {{-- Top bar --}}
      {{-- Badge bahasa & level --}}
      <div class="flex gap-2 mb-4" id="badge-info">
        <span id="badge-bahasa"
              class="px-3 py-1 rounded-full bg-[#C82D85] text-white text-[0.78rem] font-bold uppercase">
          BISINDO
        </span>
        <span id="badge-level"
              class="px-3 py-1 rounded-full bg-[#F2B8D8] text-[#C82D85] text-[0.78rem] font-bold capitalize">
          Pemula
        </span>
      </div>
<div class="flex items-center justify-between mb-3">

      <div class="flex items-center gap-3">
        <button class="w-9 h-9 rounded-full flex items-center justify-center
                      text-[18px] text-[#742958] bg-transparent border-0
                      cursor-pointer transition-colors duration-200
                      hover:text-[#C82D85] flex-shrink-0"
                onclick="kembaliKeLevel()">&#8592;</button>

        <span class="text-[0.82rem] text-[#9B6898] font-semibold"
              id="soal-label">Soal 1 dari 5</span>
      </div>

      {{-- Timer --}}
      <span class="text-[0.82rem] font-bold text-[#C82D85] bg-[#FEF0F8]
                  px-3 py-1 rounded-full border border-[#F2B8D8]"
            id="timer-display">00:00</span>

    </div>
      {{-- Progress bar --}}
      <div class="w-full h-[10px] bg-[#F7DAED] rounded-full overflow-hidden mb-6">
        <div class="h-full rounded-full transition-[width] duration-500 ease-in-out
                    shadow-[0_2px_8px_rgba(200,45,133,0.35)]"
             id="quiz-progress"
             style="width:0%; background: linear-gradient(90deg,#E8409A,#C82D85);"></div>
      </div>

      {{-- Soal card --}}
      <div class="bg-white rounded-[22px] px-7 py-8 text-center
                  shadow-[0_6px_28px_rgba(200,45,133,0.10)]
                  border border-[#F7DAED] mb-6">

        <p class="text-[1.05rem] font-semibold text-[#492F48] mb-[22px]">
          Huruf apa yang ditunjukkan gerakan ini?
        </p>

        <img class="soal-img w-[120px] h-[120px] object-contain mx-auto mb-[18px]
                    drop-shadow-[0_6px_12px_rgba(0,0,0,0.10)] block animate-popIn"
             id="soal-img" src="" alt="Gesture isyarat"
             onerror="this.style.display='none'; document.getElementById('soal-img-ph').style.display='flex';">

        <div class="soal-img-placeholder w-[120px] h-[120px] mx-auto mb-[18px]
                    items-center justify-center text-[64px] animate-popIn"
             id="soal-img-ph" style="display:none;">🤟</div>

        {{-- Feedback --}}
        <div class="soal-feedback rounded-[14px] px-[18px] py-[14px]
                    text-[0.95rem] font-bold mt-4"
             id="soal-feedback">
          <div class="text-[1rem] font-extrabold mb-[3px]" id="fb-title"></div>
          <div class="font-medium text-[0.88rem]" id="fb-sub"></div>
        </div>
      </div>

      {{-- Pilihan grid --}}
      <div class="grid grid-cols-2 gap-[14px] mb-5 max-[700px]:grid-cols-1"
           id="pilihan-grid"></div>

      <button class="btn-next-soal w-full py-4 rounded-[18px] bg-[#C82D85] text-white
                     text-[1.05rem] font-extrabold text-center border-0 cursor-pointer
                     shadow-[0_8px_28px_rgba(200,45,133,0.38)] transition-all duration-200
                     hover:bg-[#951651] hover:-translate-y-0.5"
              id="btn-next" onclick="soalBerikutnya()">
        Soal Berikutnya
      </button>
    </div>{{-- /screen-soal --}}


    {{-- ══════════════════════════════
         SCREEN 3 — HASIL
    ══════════════════════════════ --}}
    <div id="screen-hasil" class="animate-fadeUp" style="display:none;">
      <div class="bg-white rounded-[24px] px-8 py-11 text-center
                  shadow-[0_6px_28px_rgba(200,45,133,0.12)]
                  border border-[#F7DAED]">

        <span class="hasil-emoji text-[56px] mb-4 animate-popIn-lg block"
              id="hasil-emoji">🎉</span>

        <h2 class="text-[1.5rem] font-extrabold text-[#492F48] mb-2"
            id="hasil-judul">Kuis Selesai!</h2>

        <div class="text-[3rem] font-black text-[#C82D85] leading-none mb-1"
             id="hasil-skor">0%</div>

        <p class="text-[0.9rem] text-[#9B6898] mb-6"
           id="hasil-sub">dari 5 soal</p>

        <div class="flex justify-center gap-9 mb-7 py-5 px-4
                    bg-[#FEF0F8] rounded-2xl
                    max-[700px]:gap-[18px]">
          <div class="text-center">
            <div class="text-[1.5rem] font-extrabold text-[#2D8B50]"
                 id="hasil-benar">0</div>
            <div class="text-[0.8rem] text-[#9B6898] font-medium mt-0.5">Benar</div>
          </div>
          <div class="text-center">
            <div class="text-[1.5rem] font-extrabold text-[#B22020]"
                 id="hasil-salah">0</div>
            <div class="text-[0.8rem] text-[#9B6898] font-medium mt-0.5">Salah</div>
          </div>
          <div class="text-center">
            <div class="text-[1.5rem] font-extrabold text-[#492F48]"
                 id="hasil-total">0</div>
            <div class="text-[0.8rem] text-[#9B6898] font-medium mt-0.5">Total Soal</div>
          </div>
        </div>
        {{-- Review jawaban --}}
      <div class="mt-6">
        <p class="text-[1rem] font-extrabold text-[#492F48] mb-3">📋 Review Jawaban</p>
        <div id="review-container"></div>
      </div>
        <div class="flex gap-3 flex-wrap">
          <button class="flex-1 py-[14px] rounded-[14px] border-2 border-[#C82D85]
                         text-[#C82D85] bg-white text-[0.95rem] font-bold
                         cursor-pointer transition-all duration-200
                         hover:bg-[#FEE6F2]"
                  onclick="ulangiKuis()">🔄 Ulangi Kuis</button>
          <a href="{{ route('beranda') }}"
             class="flex-1 py-[14px] rounded-[14px] bg-[#C82D85] text-white
                    text-[0.95rem] font-bold border-0
                    shadow-[0_6px_20px_rgba(200,45,133,0.32)]
                    transition-all duration-200 no-underline
                    flex items-center justify-center
                    hover:bg-[#951651] hover:-translate-y-0.5">
            🏠 Ke Beranda
          </a>
        </div>

      </div>
    </div>{{-- /screen-hasil --}}

  </div>{{-- /latihan-content --}}

</div>{{-- /latihan-wrapper --}}

@push('scripts')
<script>
// ── TIMER ──
let timerInterval = null;
let waktuMulai    = null;  // timestamp saat kuis dimulai
let durasiDetik   = 0;
// ── STATE ──
let currentLevel    = null;
let currentLanguage = null; // wajib dipilih user
let soalList        = [];
let currentIndex    = 0;
let skorBenar       = 0;
let answered        = false;
let answersDetail   = []; // untuk review dan simpan ke DB

// ── SCREEN 1: Pilih Level ──

function selectBahasa(bahasa, el) {
  currentLanguage = bahasa;
  document.querySelectorAll('.bahasa-item').forEach(i => i.classList.remove('selected'));
  el.classList.add('selected');
  cekBisaMultai();
}

function selectLevel(level, el) {
  currentLevel = level;
  document.querySelectorAll('.level-item').forEach(i => i.classList.remove('selected'));
  el.classList.add('selected');
  cekBisaMultai();
}

// Tombol Mulai hanya aktif jika KEDUANYA sudah dipilih
function cekBisaMultai() {
  const bisa = currentLanguage !== null && currentLevel !== null;
  document.getElementById('btn-mulai').disabled = !bisa;
}

async function mulaiKuis() {
  if (!currentLevel) return;

  // Tampilkan loading (opsional)
  document.getElementById('btn-mulai').textContent = 'Memuat soal...';
  document.getElementById('btn-mulai').disabled = true;

  try {
    // Fetch soal dari database via API
    const res  = await fetch(`/latihan/soal?language=${currentLanguage}&level=${currentLevel}`);
    const data = await res.json();

    if (!data || data.length === 0) {
      alert('Soal untuk level ini belum tersedia. Silakan coba level lain.');
      document.getElementById('btn-mulai').textContent = 'Mulai Kuis';
      document.getElementById('btn-mulai').disabled = false;
      return;
    }

    soalList      = data;
    currentIndex  = 0;
    skorBenar     = 0;
    answersDetail = [];

    showScreen('soal');
    // Mulai timer
    waktuMulai   = Date.now();
    durasiDetik  = 0;
    clearInterval(timerInterval);

    timerInterval = setInterval(() => {
      durasiDetik = Math.floor((Date.now() - waktuMulai) / 1000);
      const menit  = String(Math.floor(durasiDetik / 60)).padStart(2, '0');
      const detik  = String(durasiDetik % 60).padStart(2, '0');
      const timerEl = document.getElementById('timer-display');
      if (timerEl) timerEl.textContent = menit + ':' + detik;
    }, 1000);
    // Update badge bahasa dan level
    document.getElementById('badge-bahasa').textContent = currentLanguage.toUpperCase();
    document.getElementById('badge-level').textContent  =
      currentLevel.charAt(0).toUpperCase() + currentLevel.slice(1);
    renderSoal();

  } catch (err) {
    console.error('Gagal mengambil soal:', err);
    alert('Terjadi kesalahan. Coba lagi.');
    document.getElementById('btn-mulai').textContent = 'Mulai Kuis';
    document.getElementById('btn-mulai').disabled = false;
  }
}

// ── SCREEN 2: Soal ──

function renderSoal() {
  answered = false;
  const soal  = soalList[currentIndex];
  const total = soalList.length;
  const nomor = currentIndex + 1;

  document.getElementById('soal-label').textContent    = `Soal ${nomor} dari ${total}`;
  document.getElementById('quiz-progress').style.width = ((nomor / total) * 100) + '%';

  // Gambar dari database (URL sudah lengkap dari server)
  const imgEl = document.getElementById('soal-img');
  const phEl  = document.getElementById('soal-img-ph');
  imgEl.onerror = function() {
    // Kalau gambar tidak ada, tampilkan placeholder
    this.src = 'https://placehold.co/280x280/FEF0F8/C82D85?text=Gesture+' + 
              soalList[currentIndex].correct_answer;
  };
  imgEl.src           = soal.image_url;
  imgEl.style.display = 'block';
  phEl.style.display  = 'none';

  // Reset feedback
  const fb = document.getElementById('soal-feedback');
  fb.className     = 'soal-feedback rounded-[14px] px-[18px] py-[14px] text-[0.95rem] font-bold mt-4';
  fb.style.display = '';

  // Tombol next
  const btnNext = document.getElementById('btn-next');
  btnNext.classList.remove('visible');
  btnNext.textContent = (currentIndex < total - 1) ? 'Soal Berikutnya' : 'Lihat Hasil';

  // Render pilihan jawaban
  const grid     = document.getElementById('pilihan-grid');
  grid.innerHTML = '';
  const shuffled = [...soal.options].sort(() => Math.random() - 0.5);

  shuffled.forEach(opt => {
    const item = document.createElement('label');
    item.className = 'pilihan-item flex items-center gap-3 bg-white border-2 border-[#F2B8D8] rounded-2xl px-[18px] py-[14px] cursor-pointer transition-all duration-200 shadow-[0_2px_10px_rgba(200,45,133,0.06)] select-none hover:border-[#C82D85] hover:bg-[#FEF0F8] hover:-translate-y-0.5 hover:shadow-[0_6px_18px_rgba(200,45,133,0.16)]';
    item.innerHTML = `
      <input type="radio" name="jawaban" value="${opt}" class="hidden">
      <div class="pilihan-radio-circle w-5 h-5 rounded-full border-2 border-[#D8A8CE]
                  bg-white flex-shrink-0 flex items-center justify-center
                  transition-all duration-200"></div>
      <span class="pilihan-text text-[1rem] font-bold text-[#492F48] flex-1">${opt}</span>
      <span class="check-icon text-[16px] flex-shrink-0">✅</span>
    `;
    item.addEventListener('click', () => {
      if (answered) return;
      grid.querySelectorAll('.pilihan-item').forEach(i => i.classList.remove('selected'));
      item.classList.add('selected');
      item.querySelector('input').checked = true;
      pilihJawaban(opt, soal);
    });
    grid.appendChild(item);
  });
}

function pilihJawaban(pilihan, soal) {
  if (answered) return;
  answered = true;

  const benar = pilihan === soal.correct_answer;
  const fb    = document.getElementById('soal-feedback');
  const grid  = document.getElementById('pilihan-grid');

  // Simpan detail jawaban untuk review nanti
  answersDetail.push({
    question_id:    soal.id,
    image_url:      soal.image_url,
    user_answer:    pilihan,
    correct_answer: soal.correct_answer,
    explanation:    soal.explanation,
    is_correct:     benar,
  });

  if (benar) skorBenar++;

  // Highlight jawaban benar/salah
  grid.querySelectorAll('.pilihan-item').forEach(el => {
    el.classList.add('locked');
    const val = el.querySelector('input').value;
    if (val === soal.correct_answer) {
      el.classList.remove('selected');
      el.classList.add('correct');
    } else if (val === pilihan && !benar) {
      el.classList.remove('selected');
      el.classList.add('wrong');
    }
  });

  // Feedback
  if (benar) {
    fb.className = 'soal-feedback benar rounded-[14px] px-[18px] py-[14px] text-[0.95rem] font-bold mt-4 bg-[#E8F8EE] border border-[#5CB87A] text-[#2D6A3F]';
    document.getElementById('fb-title').textContent = '✅ Jawaban Benar!';
    document.getElementById('fb-sub').textContent   = `Huruf yang ditunjukkan adalah ${soal.correct_answer}`;
  } else {
    fb.className = 'soal-feedback salah rounded-[14px] px-[18px] py-[14px] text-[0.95rem] font-bold mt-4 bg-[#FDECEC] border border-[#E57373] text-[#8B2020]';
    document.getElementById('fb-title').textContent = '❌ Jawaban Salah!';
    document.getElementById('fb-sub').textContent   = `Jawaban benar: ${soal.correct_answer}. ${soal.explanation ?? ''}`;
  }

  document.getElementById('btn-next').classList.add('visible');
}

function soalBerikutnya() {
  currentIndex++;
  if (currentIndex >= soalList.length) {
    tampilkanHasil();
  } else {
    renderSoal();
  }
}

function kembaliKeLevel() { showScreen('level'); }

// ── SCREEN 3: Hasil ──
async function tampilkanHasil() {
  // Hentikan timer
  clearInterval(timerInterval);

  showScreen('hasil');
  const total  = soalList.length;
  const salah  = total - skorBenar;
  const persen = Math.round((skorBenar / total) * 100);

  document.getElementById('hasil-skor').textContent  = persen + '%';
  document.getElementById('hasil-sub').textContent   = `dari ${total} soal`;
  document.getElementById('hasil-benar').textContent = skorBenar;
  document.getElementById('hasil-salah').textContent = salah;
  document.getElementById('hasil-total').textContent = total;
  document.getElementById('quiz-progress').style.width = '100%';

  const emojiEl = document.getElementById('hasil-emoji');
  const judulEl = document.getElementById('hasil-judul');
  if      (persen === 100) { emojiEl.textContent = '🏆'; judulEl.textContent = 'Sempurna! Luar Biasa!'; }
  else if (persen >= 80)   { emojiEl.textContent = '🎉'; judulEl.textContent = 'Keren! Hampir Sempurna!'; }
  else if (persen >= 60)   { emojiEl.textContent = '👍'; judulEl.textContent = 'Bagus! Terus Berlatih!'; }
  else                     { emojiEl.textContent = '💪'; judulEl.textContent = 'Jangan Menyerah, Coba Lagi!'; }

  // Render review jawaban
  renderReview();

  // Simpan hasil ke database (jika user login)
  await simpanHasilKuisKeDB(persen, total);
}

function renderReview() {
  const container = document.getElementById('review-container');
  if (!container) return;

  container.innerHTML = '';
  answersDetail.forEach((item, idx) => {
    const warna = item.is_correct
      ? 'bg-[#E8F8EE] border-[#5CB87A]'
      : 'bg-[#FDECEC] border-[#E57373]';
    const teks = item.is_correct
      ? `<span class="text-[#2D6A3F] font-bold">✅ Benar</span>`
      : `<span class="text-[#8B2020] font-bold">❌ Salah — Jawaban benar: ${item.correct_answer}</span>`;

    container.innerHTML += `
      <div class="border-2 rounded-[16px] p-4 ${warna} mb-3">
        <div class="flex items-center gap-3 mb-2">
          <img src="${item.image_url}" alt="Soal ${idx+1}"
               class="w-16 h-16 object-contain rounded-xl border border-white shadow">
          <div>
            <p class="text-[0.9rem] font-bold text-[#492F48]">Soal ${idx + 1}</p>
            <p class="text-[0.85rem] text-[#7A4B78]">Jawaban kamu: <strong>${item.user_answer}</strong></p>
            ${teks}
          </div>
        </div>
        ${!item.is_correct && item.explanation
          ? `<p class="text-[0.82rem] text-[#7A4B78] mt-1 italic">💡 ${item.explanation}</p>`
          : ''}
      </div>
    `;
  });
}

async function simpanHasilKuisKeDB(persen, total) {
  try {
    const res = await fetch('/latihan/simpan-hasil', {
      method: 'POST',
      headers: {
        'Content-Type':  'application/json',
        'X-CSRF-TOKEN':  document.querySelector('meta[name="csrf-token"]').content,
      },
      body: JSON.stringify({
        language:        currentLanguage,
        level:           currentLevel,
        total_questions: total,
        correct_answers: skorBenar,
        answers_detail:  answersDetail,
        duration_seconds: durasiDetik,
      }),
    });
    const data = await res.json();
    console.log('Hasil tersimpan:', data);
  } catch (err) {
    // Tidak perlu tampilkan error ke user, gagal simpan tidak bloking
    console.warn('Gagal menyimpan hasil:', err);
  }
}

function ulangiKuis() {
  currentIndex  = 0;
  skorBenar     = 0;
  answersDetail = [];
  soalList      = [...soalList].sort(() => Math.random() - 0.5);
  showScreen('soal');
  // Update badge bahasa dan level
  document.getElementById('badge-bahasa').textContent = currentLanguage.toUpperCase();
  document.getElementById('badge-level').textContent  =
    currentLevel.charAt(0).toUpperCase() + currentLevel.slice(1);
  renderSoal();
}

function showScreen(name) {
  document.getElementById('screen-level').style.display = name === 'level' ? 'block' : 'none';
  document.getElementById('screen-soal').style.display  = name === 'soal'  ? 'block' : 'none';
  document.getElementById('screen-hasil').style.display = name === 'hasil' ? 'block' : 'none';
}

</script>
@endpush
@include('layout.footer')
@endsection
