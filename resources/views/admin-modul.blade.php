@extends('layout.admin')

@section('title', 'SignLearn - Modul Pembelajaran')

@section('content')

{{-- Header --}}
<div class="flex justify-between items-start mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-800">Modul Pembelajaran</h1>
        <p class="text-gray-400 text-sm mt-1">Kelola modul BISINDO & SIBI beserta huruf A–Z dan referensinya.</p>
    </div>
    <button id="btnTambahHuruf"
            class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-white text-sm font-bold shadow transition hover:opacity-90"
            style="background-color: #4A1A6B;">
        + Tambah Huruf
    </button>
</div>

{{-- Statistik Cards --}}
<div class="grid grid-cols-3 gap-4 mb-8">
    <div class="rounded-2xl p-5" style="background-color: #EDD5F7;">
        <div class="flex items-center gap-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" style="color:#7B2FBE;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            <span class="text-3xl font-extrabold text-gray-800" id="stat-total">6</span>
        </div>
        <p class="text-sm font-bold" style="color:#7B2FBE;">Total Huruf</p>
    </div>
    <div class="rounded-2xl p-5" style="background-color: #FCE7F3;">
        <div class="flex items-center gap-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" style="color:#C82D85;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3"/>
            </svg>
            <span class="text-3xl font-extrabold text-gray-800" id="stat-bisindo">3</span>
        </div>
        <p class="text-sm font-bold" style="color:#C82D85;">Huruf BISINDO</p>
    </div>
    <div class="rounded-2xl p-5" style="background-color: #E0E7FF;">
        <div class="flex items-center gap-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3"/>
            </svg>
            <span class="text-3xl font-extrabold text-gray-800" id="stat-sibi">3</span>
        </div>
        <p class="text-sm font-bold text-indigo-500">Huruf SIBI</p>
    </div>
</div>

{{-- ===== SECTION BISINDO ===== --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
    <div class="flex items-center gap-3 mb-1">
        <span class="text-base font-bold text-gray-800">Kelola Huruf:</span>
        <span class="px-4 py-1 rounded-full text-xs font-extrabold text-white" style="background-color:#C82D85;">BISINDO</span>
    </div>
    <p class="text-gray-400 text-sm mb-5">Klik kartu huruf untuk edit atau hapus</p>

    <div class="mb-4">
        <div class="flex items-center gap-2 border border-gray-200 rounded-xl px-4 py-2 w-52 bg-gray-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 105 11a6 6 0 0012 0z"/>
            </svg>
            <input type="text" id="searchBisindo" placeholder="Cari huruf..."
                   class="bg-transparent text-sm text-gray-500 focus:outline-none w-full" />
        </div>
    </div>

    <div class="flex flex-wrap gap-3" id="bisindo-grid">
        @php
        $bisindoDummy = [
            ['huruf' => 'A', 'penjelasan' => "Kata: Api, Anak, Ayah\nContoh: Api = tangan membentuk jari A", 'video' => '', 'thumbnail' => ''],
            ['huruf' => 'B', 'penjelasan' => "Kata: Buku, Baju, Bunga\nContoh: Buku = telapak tangan terbuka ke atas", 'video' => '', 'thumbnail' => ''],
            ['huruf' => 'C', 'penjelasan' => "Kata: Cinta, Coklat, Cuaca\nContoh: Cinta = tangan menyilang di dada", 'video' => '', 'thumbnail' => ''],
        ];
        @endphp

        @foreach($bisindoDummy as $item)
        <div class="huruf-card cursor-pointer group relative w-32 rounded-2xl border border-gray-100 bg-white shadow-sm overflow-hidden transition hover:-translate-y-1 hover:shadow-lg hover:border-pink-300"
             data-modul="BISINDO"
             data-huruf="{{ $item['huruf'] }}"
             data-penjelasan="{{ addslashes($item['penjelasan']) }}"
             data-video="{{ $item['video'] }}"
             data-thumbnail="{{ $item['thumbnail'] }}"
             onclick="klikKartu(this)">

            {{-- Thumbnail area --}}
            <div class="thumbnail-wrap relative h-20 flex items-center justify-center bg-gradient-to-br from-pink-50 to-purple-50 overflow-hidden">
                {{-- Placeholder video thumbnail --}}
                <div class="thumb-placeholder flex flex-col items-center justify-center w-full h-full">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center mb-1" style="background:#C82D85;">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="white">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-400 font-medium">No Video</span>
                </div>
                {{-- Thumbnail gambar jika ada --}}
                <img class="thumb-img absolute inset-0 w-full h-full object-cover hidden" src="" alt="">
                {{-- Play overlay jika ada video --}}
                <div class="thumb-play-overlay absolute inset-0 bg-black/30 flex items-center justify-center hidden">
                    <div class="w-9 h-9 rounded-full bg-white/90 flex items-center justify-center">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="#C82D85"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                </div>
            </div>

            {{-- Label huruf --}}
            <div class="flex items-center justify-between px-3 py-2">
                <span class="text-xl font-extrabold text-gray-800">{{ $item['huruf'] }}</span>
                <span class="text-xs font-semibold px-2 py-0.5 rounded-full" style="background:#FCE7F3;color:#C82D85;">BISINDO</span>
            </div>
        </div>
        @endforeach

        {{-- Tombol Tambah --}}
        <button onclick="openTambahModal('BISINDO')"
                class="w-32 h-36 rounded-2xl border-2 border-dashed border-purple-300 bg-purple-50 flex flex-col items-center justify-center gap-1 hover:border-pink-400 hover:bg-pink-50 transition">
            <span class="text-3xl font-light" style="color:#C82D85;">+</span>
            <span class="text-xs font-bold text-center leading-tight" style="color:#7B2FBE;">Tambah Huruf<br>Baru</span>
        </button>
        <p id="emptyBisindo" class="hidden w-full text-center text-gray-400 text-sm py-4">Belum ada huruf BISINDO.</p>
    </div>
</div>

{{-- ===== SECTION SIBI ===== --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
    <div class="flex items-center gap-3 mb-1">
        <span class="text-base font-bold text-gray-800">Kelola Huruf:</span>
        <span class="px-4 py-1 rounded-full text-xs font-extrabold text-white" style="background-color:#7B2FBE;">SIBI</span>
    </div>
    <p class="text-gray-400 text-sm mb-5">Klik kartu huruf untuk edit atau hapus</p>

    <div class="mb-4">
        <div class="flex items-center gap-2 border border-gray-200 rounded-xl px-4 py-2 w-52 bg-gray-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 105 11a6 6 0 0012 0z"/>
            </svg>
            <input type="text" id="searchSibi" placeholder="Cari huruf..."
                   class="bg-transparent text-sm text-gray-500 focus:outline-none w-full" />
        </div>
    </div>

    <div class="flex flex-wrap gap-3" id="sibi-grid">
        @php
        $sibiDummy = [
            ['huruf' => 'A', 'penjelasan' => "Kata: Api, Anak, Ayah\nContoh: Kepalan tangan dengan ibu jari ke samping", 'video' => '', 'thumbnail' => ''],
            ['huruf' => 'B', 'penjelasan' => "Kata: Buku, Baju, Bunga\nContoh: Empat jari lurus ke atas, ibu jari ditekuk", 'video' => '', 'thumbnail' => ''],
            ['huruf' => 'C', 'penjelasan' => "Kata: Cinta, Coklat, Cuaca\nContoh: Tangan melengkung membentuk huruf C", 'video' => '', 'thumbnail' => ''],
        ];
        @endphp

        @foreach($sibiDummy as $item)
        <div class="huruf-card cursor-pointer group relative w-32 rounded-2xl border border-gray-100 bg-white shadow-sm overflow-hidden transition hover:-translate-y-1 hover:shadow-lg hover:border-indigo-300"
             data-modul="SIBI"
             data-huruf="{{ $item['huruf'] }}"
             data-penjelasan="{{ addslashes($item['penjelasan']) }}"
             data-video="{{ $item['video'] }}"
             data-thumbnail="{{ $item['thumbnail'] }}"
             onclick="klikKartu(this)">

            <div class="thumbnail-wrap relative h-20 flex items-center justify-center bg-gradient-to-br from-indigo-50 to-purple-50 overflow-hidden">
                <div class="thumb-placeholder flex flex-col items-center justify-center w-full h-full">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center mb-1" style="background:#7B2FBE;">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="white"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                    <span class="text-xs text-gray-400 font-medium">No Video</span>
                </div>
                <img class="thumb-img absolute inset-0 w-full h-full object-cover hidden" src="" alt="">
                <div class="thumb-play-overlay absolute inset-0 bg-black/30 flex items-center justify-center hidden">
                    <div class="w-9 h-9 rounded-full bg-white/90 flex items-center justify-center">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="#7B2FBE"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between px-3 py-2">
                <span class="text-xl font-extrabold text-gray-800">{{ $item['huruf'] }}</span>
                <span class="text-xs font-semibold px-2 py-0.5 rounded-full" style="background:#EDE9FE;color:#7B2FBE;">SIBI</span>
            </div>
        </div>
        @endforeach

        <button onclick="openTambahModal('SIBI')"
                class="w-32 h-36 rounded-2xl border-2 border-dashed border-indigo-300 bg-indigo-50 flex flex-col items-center justify-center gap-1 hover:border-purple-400 hover:bg-purple-50 transition">
            <span class="text-3xl font-light text-indigo-500">+</span>
            <span class="text-xs font-bold text-center text-indigo-500 leading-tight">Tambah Huruf<br>Baru</span>
        </button>
        <p id="emptySibi" class="hidden w-full text-center text-gray-400 text-sm py-4">Belum ada huruf SIBI.</p>
    </div>
</div>

{{-- ====== MODAL DETAIL / EDIT ====== --}}
{{-- Muncul saat kartu diklik, tampil detail dulu, ada tombol Edit & Hapus --}}
<div id="modalDetail" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4 overflow-hidden">

        {{-- Header modal --}}
        <div class="flex items-center justify-between px-6 pt-5 pb-4 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <span class="text-3xl font-extrabold text-gray-800" id="detailHuruf">A</span>
                <span class="px-3 py-1 rounded-full text-xs font-extrabold text-white" id="detailBadge" style="background:#C82D85;">BISINDO</span>
            </div>
            <div class="flex items-center gap-2">
                <button onclick="openEditDariDetail()"
                        class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold border-2 border-yellow-400 text-yellow-600 hover:bg-yellow-50 transition">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                    </svg>
                    Edit
                </button>
                <button onclick="openHapusDariDetail()"
                        class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold border-2 border-red-300 text-red-500 hover:bg-red-50 transition">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                        <polyline points="3 6 5 6 21 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                        <path d="M19 6l-1 14H6L5 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                    </svg>
                    Hapus
                </button>
                <button onclick="closeModal('modalDetail')" class="text-gray-400 hover:text-gray-600 text-2xl leading-none ml-1">&times;</button>
            </div>
        </div>

        <div class="p-6 space-y-4 max-h-96 overflow-y-auto">
            {{-- Thumbnail / Video preview --}}
            <div>
                <p class="text-xs font-bold text-gray-500 mb-2">VIDEO REFERENSI</p>
                <div id="detailVideoWrap" class="w-full h-44 rounded-xl overflow-hidden bg-gray-100 flex items-center justify-center relative">
                    {{-- Placeholder jika tidak ada video --}}
                    <div id="detailVideoPlaceholder" class="flex flex-col items-center gap-2">
                        <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="2">
                                <polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/>
                            </svg>
                        </div>
                        <span class="text-sm text-gray-400 font-medium">Belum ada video</span>
                    </div>
                    {{-- Thumbnail jika ada --}}
                    <img id="detailThumbImg" src="" alt="" class="hidden absolute inset-0 w-full h-full object-cover">
                    <div id="detailThumbOverlay" class="hidden absolute inset-0 bg-black/30 flex items-center justify-center">
                        <div class="w-12 h-12 rounded-full bg-white/90 flex items-center justify-center">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="#C82D85"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                </div>
                {{-- URL video --}}
                <p id="detailVideoUrl" class="text-xs text-indigo-500 mt-1.5 truncate hidden"></p>
            </div>

            {{-- Penjelasan --}}
            <div>
                <p class="text-xs font-bold text-gray-500 mb-2">PENJELASAN & KUMPULAN KATA</p>
                <div id="detailPenjelasan"
                     class="w-full min-h-16 p-3 rounded-xl bg-gray-50 border border-gray-100 text-sm text-gray-700 whitespace-pre-line leading-relaxed">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ====== MODAL FORM TAMBAH / EDIT ====== --}}
<div id="modalForm" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4 overflow-hidden">
        <div class="flex justify-between items-center px-6 pt-5 pb-4 border-b border-gray-100">
            <h3 class="text-lg font-extrabold text-gray-800" id="modalFormTitle">Tambah Huruf Baru</h3>
            <button onclick="closeModal('modalForm')" class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
        </div>

        <div class="p-6 space-y-4 max-h-96 overflow-y-auto">

            {{-- 1. Modul --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 mb-1">MODUL</label>
                <select id="fModul" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-300">
                    <option value="BISINDO">BISINDO</option>
                    <option value="SIBI">SIBI</option>
                </select>
            </div>

            {{-- 2. Huruf --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 mb-1">HURUF (A–Z)</label>
                <input type="text" id="fHuruf" maxlength="1" placeholder="Contoh: A"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-300 uppercase" />
            </div>

            {{-- 3. Thumbnail --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 mb-1">THUMBNAIL VIDEO</label>
                <div id="thumbUploadBox"
                     class="w-full h-36 rounded-xl border-2 border-dashed border-purple-200 bg-purple-50 flex flex-col items-center justify-center gap-2 cursor-pointer relative overflow-hidden hover:border-pink-400 hover:bg-pink-50 transition">
                    <input type="file" id="thumbInput" accept="image/*"
                           class="absolute inset-0 opacity-0 cursor-pointer w-full h-full">
                    <div id="thumbPlaceholder" class="flex flex-col items-center gap-1.5">
                        <div class="w-10 h-10 rounded-full bg-purple-200 flex items-center justify-center">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#7B2FBE" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-purple-500">Klik untuk upload thumbnail</span>
                        <span class="text-xs text-gray-400">JPG, PNG, WebP maks 2MB</span>
                    </div>
                    <img id="thumbPreview" src="" alt="Preview" class="hidden absolute inset-0 w-full h-full object-cover pointer-events-none">
                    <div id="thumbPreviewOverlay" class="hidden absolute inset-0 bg-black/20 flex items-center justify-center pointer-events-none">
                        <div class="w-10 h-10 rounded-full bg-white/80 flex items-center justify-center">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="#C82D85"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. Penjelasan --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 mb-1">PENJELASAN & KUMPULAN KATA</label>
                <textarea id="fPenjelasan" rows="4" placeholder="Contoh:&#10;Kata: Api, Anak, Ayah&#10;Cara: Kepalan tangan dengan ibu jari ke samping"
                          class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-300 resize-none"></textarea>
            </div>

            {{-- 5. URL Video --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 mb-1">LINK VIDEO (URL YouTube / Drive)</label>
                <input type="url" id="fVideo" placeholder="https://youtube.com/watch?v=..."
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-300" />
            </div>

        </div>

        <div class="flex gap-3 px-6 pb-5 pt-3 border-t border-gray-100">
            <button type="button" onclick="closeModal('modalForm')"
                    class="flex-1 py-2.5 rounded-xl text-sm font-bold border border-gray-200 text-gray-500 hover:bg-gray-50 transition">
                Batal
            </button>
            <button type="button" onclick="simpanHuruf()"
                    class="flex-1 py-2.5 rounded-xl text-white text-sm font-bold hover:opacity-90 transition"
                    style="background-color: #4A1A6B;">
                Simpan
            </button>
        </div>
    </div>
</div>

{{-- ====== MODAL HAPUS ====== --}}
<div id="modalDelete" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm mx-4 p-6 text-center">
        <div class="text-4xl mb-3">🗑️</div>
        <h4 class="text-base font-extrabold text-gray-800 mb-2">Hapus Huruf Ini?</h4>
        <p class="text-sm text-gray-400 mb-5" id="delConfirmText">Tindakan ini tidak dapat dibatalkan.</p>
        <div class="flex gap-3">
            <button onclick="closeModal('modalDelete')"
                    class="flex-1 py-2.5 rounded-xl text-sm font-bold border border-gray-200 text-gray-500 hover:bg-gray-50 transition">
                Batal
            </button>
            <button onclick="konfirmasiHapus()"
                    class="flex-1 py-2.5 rounded-xl text-white text-sm font-bold hover:opacity-90 transition"
                    style="background-color:#C82D85;">
                Hapus
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // ============================================================
    // STATE
    // ============================================================
    let modeForm    = 'add';   // 'add' | 'edit'
    let kartuAktif  = null;    // elemen DOM kartu yang sedang aktif
    let thumbDataUrl = null;   // base64 thumbnail

    // ============================================================
    // KLIK KARTU → buka modal detail
    // ============================================================
    function klikKartu(el) {
        kartuAktif = el;
        const huruf      = el.dataset.huruf;
        const modul      = el.dataset.modul;
        const penjelasan = el.dataset.penjelasan.replace(/\\n/g, '\n');
        const video      = el.dataset.video;
        const thumb      = el.dataset.thumbnail;

        document.getElementById('detailHuruf').textContent = huruf;
        const badge = document.getElementById('detailBadge');
        badge.textContent = modul;
        badge.style.background = modul === 'BISINDO' ? '#C82D85' : '#7B2FBE';

        document.getElementById('detailPenjelasan').textContent = penjelasan || 'Belum ada penjelasan.';

        // Video / thumbnail
        const placeholder    = document.getElementById('detailVideoPlaceholder');
        const thumbImg       = document.getElementById('detailThumbImg');
        const thumbOverlay   = document.getElementById('detailThumbOverlay');
        const videoUrlEl     = document.getElementById('detailVideoUrl');

        if (thumb) {
            placeholder.classList.add('hidden');
            thumbImg.src = thumb;
            thumbImg.classList.remove('hidden');
            thumbOverlay.classList.remove('hidden');
        } else {
            placeholder.classList.remove('hidden');
            thumbImg.classList.add('hidden');
            thumbOverlay.classList.add('hidden');
        }

        if (video) {
            videoUrlEl.textContent = video;
            videoUrlEl.classList.remove('hidden');
        } else {
            videoUrlEl.classList.add('hidden');
        }

        showModal('modalDetail');
    }

    // ============================================================
    // DARI MODAL DETAIL → buka form edit
    // ============================================================
    function openEditDariDetail() {
        closeModal('modalDetail');
        if (!kartuAktif) return;

        modeForm = 'edit';
        const el = kartuAktif;
        document.getElementById('modalFormTitle').textContent = 'Edit Huruf ' + el.dataset.huruf;
        document.getElementById('fModul').value      = el.dataset.modul;
        document.getElementById('fHuruf').value      = el.dataset.huruf;
        document.getElementById('fPenjelasan').value = el.dataset.penjelasan.replace(/\\n/g, '\n');
        document.getElementById('fVideo').value      = el.dataset.video || '';

        thumbDataUrl = el.dataset.thumbnail || null;
        thumbDataUrl ? showThumbPreview(thumbDataUrl) : resetThumbPreview();

        showModal('modalForm');
    }

    // ============================================================
    // DARI MODAL DETAIL → buka konfirmasi hapus
    // ============================================================
    function openHapusDariDetail() {
        closeModal('modalDetail');
        if (!kartuAktif) return;
        document.getElementById('delConfirmText').textContent =
            `Huruf "${kartuAktif.dataset.huruf}" (${kartuAktif.dataset.modul}) akan dihapus permanen.`;
        showModal('modalDelete');
    }

    // ============================================================
    // TOMBOL TAMBAH HURUF (header & tombol di grid)
    // ============================================================
    document.getElementById('btnTambahHuruf').addEventListener('click', function () {
        openTambahModal('BISINDO');
    });

    function openTambahModal(modul) {
        modeForm = 'add';
        kartuAktif = null;
        document.getElementById('modalFormTitle').textContent = 'Tambah Huruf Baru';
        document.getElementById('fModul').value      = modul;
        document.getElementById('fHuruf').value      = '';
        document.getElementById('fPenjelasan').value = '';
        document.getElementById('fVideo').value      = '';
        resetThumbPreview();
        showModal('modalForm');
    }

    // ============================================================
    // SIMPAN (tambah / edit)
    // ============================================================
    function simpanHuruf() {
        const modul      = document.getElementById('fModul').value;
        const huruf      = document.getElementById('fHuruf').value.toUpperCase().trim();
        const penjelasan = document.getElementById('fPenjelasan').value.trim();
        const video      = document.getElementById('fVideo').value.trim();

        if (!huruf)              { alert('Huruf tidak boleh kosong!'); return; }
        if (!/^[A-Z]$/.test(huruf)) { alert('Huruf hanya boleh satu karakter A–Z!'); return; }

        if (modeForm === 'add') {
            buatKartu(modul, huruf, penjelasan, video, thumbDataUrl);
        } else {
            updateKartu(modul, huruf, penjelasan, video, thumbDataUrl);
        }

        updateStats();
        closeModal('modalForm');
    }

    // ============================================================
    // BUAT KARTU BARU
    // ============================================================
    function buatKartu(modul, huruf, penjelasan, video, thumb) {
        const gridId    = modul === 'BISINDO' ? 'bisindo-grid' : 'sibi-grid';
        const grid      = document.getElementById(gridId);
        const hoverBrd  = modul === 'BISINDO' ? 'hover:border-pink-300' : 'hover:border-indigo-300';
        const bgGrad    = modul === 'BISINDO'
            ? 'from-pink-50 to-purple-50' : 'from-indigo-50 to-purple-50';
        const accentClr = modul === 'BISINDO' ? '#C82D85' : '#7B2FBE';
        const badgeBg   = modul === 'BISINDO' ? '#FCE7F3' : '#EDE9FE';
        const badgeClr  = accentClr;

        const thumbHTML = thumb
            ? `<img class="thumb-img absolute inset-0 w-full h-full object-cover" src="${thumb}" alt="">
               <div class="thumb-play-overlay absolute inset-0 bg-black/30 flex items-center justify-center">
                 <div class="w-9 h-9 rounded-full bg-white/90 flex items-center justify-center">
                   <svg width="14" height="14" viewBox="0 0 24 24" fill="${accentClr}"><path d="M8 5v14l11-7z"/></svg>
                 </div>
               </div>`
            : `<div class="thumb-placeholder flex flex-col items-center justify-center w-full h-full">
                 <div class="w-8 h-8 rounded-full flex items-center justify-center mb-1" style="background:${accentClr};">
                   <svg width="12" height="12" viewBox="0 0 24 24" fill="white"><path d="M8 5v14l11-7z"/></svg>
                 </div>
                 <span class="text-xs text-gray-400 font-medium">No Video</span>
               </div>`;

        const safePenjelasan = penjelasan.replace(/'/g, "\\'").replace(/\n/g, '\\n');

        const card = document.createElement('div');
        card.className = `huruf-card cursor-pointer group relative w-32 rounded-2xl border border-gray-100 bg-white shadow-sm overflow-hidden transition hover:-translate-y-1 hover:shadow-lg ${hoverBrd}`;
        card.dataset.modul      = modul;
        card.dataset.huruf      = huruf;
        card.dataset.penjelasan = safePenjelasan;
        card.dataset.video      = video;
        card.dataset.thumbnail  = thumb || '';
        card.setAttribute('onclick', 'klikKartu(this)');
        card.innerHTML = `
            <div class="thumbnail-wrap relative h-20 flex items-center justify-center bg-gradient-to-br ${bgGrad} overflow-hidden">
                ${thumbHTML}
            </div>
            <div class="flex items-center justify-between px-3 py-2">
                <span class="text-xl font-extrabold text-gray-800">${huruf}</span>
                <span class="text-xs font-semibold px-2 py-0.5 rounded-full"
                      style="background:${badgeBg};color:${badgeClr};">${modul}</span>
            </div>
        `;

        const addBtn = grid.querySelector('button[onclick*="openTambahModal"]');
        grid.insertBefore(card, addBtn);
        checkEmpty(modul);
    }

    // ============================================================
    // UPDATE KARTU YANG DIEDIT
    // ============================================================
    function updateKartu(modul, huruf, penjelasan, video, thumb) {
        if (!kartuAktif) return;
        const accentClr = modul === 'BISINDO' ? '#C82D85' : '#7B2FBE';
        const bgGrad    = modul === 'BISINDO' ? 'from-pink-50 to-purple-50' : 'from-indigo-50 to-purple-50';
        const badgeBg   = modul === 'BISINDO' ? '#FCE7F3' : '#EDE9FE';
        const safePenjelasan = penjelasan.replace(/'/g, "\\'").replace(/\n/g, '\\n');

        kartuAktif.dataset.huruf      = huruf;
        kartuAktif.dataset.modul      = modul;
        kartuAktif.dataset.penjelasan = safePenjelasan;
        kartuAktif.dataset.video      = video;
        kartuAktif.dataset.thumbnail  = thumb || '';

        const thumbWrap = kartuAktif.querySelector('.thumbnail-wrap');
        thumbWrap.className = `thumbnail-wrap relative h-20 flex items-center justify-center bg-gradient-to-br ${bgGrad} overflow-hidden`;
        thumbWrap.innerHTML = thumb
            ? `<img class="thumb-img absolute inset-0 w-full h-full object-cover" src="${thumb}" alt="">
               <div class="thumb-play-overlay absolute inset-0 bg-black/30 flex items-center justify-center">
                 <div class="w-9 h-9 rounded-full bg-white/90 flex items-center justify-center">
                   <svg width="14" height="14" viewBox="0 0 24 24" fill="${accentClr}"><path d="M8 5v14l11-7z"/></svg>
                 </div>
               </div>`
            : `<div class="thumb-placeholder flex flex-col items-center justify-center w-full h-full">
                 <div class="w-8 h-8 rounded-full flex items-center justify-center mb-1" style="background:${accentClr};">
                   <svg width="12" height="12" viewBox="0 0 24 24" fill="white"><path d="M8 5v14l11-7z"/></svg>
                 </div>
                 <span class="text-xs text-gray-400 font-medium">No Video</span>
               </div>`;

        kartuAktif.querySelector('.text-xl').textContent = huruf;
        const badge = kartuAktif.querySelector('.text-xs.font-semibold');
        badge.textContent = modul;
        badge.style.background = badgeBg;
        badge.style.color = accentClr;
    }

    // ============================================================
    // HAPUS
    // ============================================================
    function konfirmasiHapus() {
        if (kartuAktif) {
            const modul = kartuAktif.dataset.modul;
            kartuAktif.remove();
            kartuAktif = null;
            updateStats();
            checkEmpty(modul);
        }
        closeModal('modalDelete');
    }

    // ============================================================
    // THUMBNAIL UPLOAD
    // ============================================================
    document.getElementById('thumbInput').addEventListener('change', function () {
        const file = this.files[0]; if (!file) return;
        const reader = new FileReader();
        reader.onload = e => { thumbDataUrl = e.target.result; showThumbPreview(thumbDataUrl); };
        reader.readAsDataURL(file);
    });

    function showThumbPreview(src) {
        document.getElementById('thumbPreview').src = src;
        document.getElementById('thumbPreview').classList.remove('hidden');
        document.getElementById('thumbPreviewOverlay').classList.remove('hidden');
        document.getElementById('thumbPlaceholder').classList.add('hidden');
    }
    function resetThumbPreview() {
        thumbDataUrl = null;
        document.getElementById('thumbPreview').classList.add('hidden');
        document.getElementById('thumbPreview').src = '';
        document.getElementById('thumbPreviewOverlay').classList.add('hidden');
        document.getElementById('thumbPlaceholder').classList.remove('hidden');
        document.getElementById('thumbInput').value = '';
    }

    // ============================================================
    // HELPERS
    // ============================================================
    function showModal(id) { document.getElementById(id).style.display = 'flex'; }
    function closeModal(id) { document.getElementById(id).style.display = 'none'; }

    ['modalDetail', 'modalForm', 'modalDelete'].forEach(id => {
        document.getElementById(id).addEventListener('click', function (e) {
            if (e.target === this) closeModal(id);
        });
    });

    document.getElementById('fHuruf').addEventListener('input', function () {
        this.value = this.value.toUpperCase();
    });

    // Search
    document.getElementById('searchBisindo').addEventListener('input', function () {
        filterGrid('bisindo-grid', this.value, 'emptyBisindo');
    });
    document.getElementById('searchSibi').addEventListener('input', function () {
        filterGrid('sibi-grid', this.value, 'emptySibi');
    });
    function filterGrid(gridId, keyword, emptyId) {
        const kw = keyword.toLowerCase();
        const cards = document.querySelectorAll(`#${gridId} .huruf-card`);
        let visible = 0;
        cards.forEach(card => {
            const show = card.dataset.huruf.toLowerCase().includes(kw);
            card.style.display = show ? '' : 'none';
            if (show) visible++;
        });
        document.getElementById(emptyId).classList.toggle('hidden', visible > 0);
    }

    function updateStats() {
        const b = document.querySelectorAll('#bisindo-grid .huruf-card').length;
        const s = document.querySelectorAll('#sibi-grid .huruf-card').length;
        document.getElementById('stat-bisindo').textContent = b;
        document.getElementById('stat-sibi').textContent    = s;
        document.getElementById('stat-total').textContent   = b + s;
    }

    function checkEmpty(modul) {
        const count = document.querySelectorAll(
            `#${modul === 'BISINDO' ? 'bisindo' : 'sibi'}-grid .huruf-card`
        ).length;
        document.getElementById(
            modul === 'BISINDO' ? 'emptyBisindo' : 'emptySibi'
        ).classList.toggle('hidden', count > 0);
    }

    updateStats();
</script>
@endpush

@endsection