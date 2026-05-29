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
            class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-white text-sm font-bold shadow transition hover:opacity-90 bg-[#4A1A6B]">
        + Tambah Huruf
    </button>
</div>

{{-- Alert Success --}}
@if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-600 text-sm rounded-xl px-4 py-3 mb-5">
        {{ session('success') }}
    </div>
@endif

{{-- Alert Error --}}
@if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-500 text-sm rounded-xl px-4 py-3 mb-5">
        <ul class="list-disc ml-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Statistik Cards --}}
<div class="grid grid-cols-3 gap-4 mb-8">
    <div class="rounded-2xl p-5 bg-[#EDD5F7]">
        <div class="flex items-center gap-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#7B2FBE]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332-.477-4.5-1.253"/>
            </svg>
            <span class="text-3xl font-extrabold text-gray-800" id="stat-total">{{ $moduls->count() }}</span>
        </div>
        <p class="text-sm font-bold text-[#7B2FBE]">Total Huruf</p>
    </div>

    <div class="rounded-2xl p-5 bg-[#FCE7F3]">
        <div class="flex items-center gap-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#C82D85]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3"/>
            </svg>
            <span class="text-3xl font-extrabold text-gray-800" id="stat-bisindo">{{ $bisindo->count() }}</span>
        </div>
        <p class="text-sm font-bold text-[#C82D85]">Huruf BISINDO</p>
    </div>

    <div class="rounded-2xl p-5 bg-[#E0E7FF]">
        <div class="flex items-center gap-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3"/>
            </svg>
            <span class="text-3xl font-extrabold text-gray-800" id="stat-sibi">{{ $sibi->count() }}</span>
        </div>
        <p class="text-sm font-bold text-indigo-500">Huruf SIBI</p>
    </div>
</div>

{{-- ===== SECTION BISINDO ===== --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
    <div class="flex items-center gap-3 mb-1">
        <span class="text-base font-bold text-gray-800">Kelola Huruf:</span>
        <span class="px-4 py-1 rounded-full text-xs font-extrabold text-white bg-[#C82D85]">BISINDO</span>
    </div>

    <p class="text-gray-400 text-sm mb-5">Klik kartu huruf untuk melihat detail atau mengedit.</p>

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
        @foreach($bisindo as $item)
            <div class="huruf-card cursor-pointer group relative w-32 rounded-2xl border border-gray-100 bg-white shadow-sm overflow-hidden transition hover:-translate-y-1 hover:shadow-lg hover:border-pink-300"
                 data-id="{{ $item->id }}"
                 data-update-url="{{ route('admin.modul.update', $item->id) }}"
                 data-modul="{{ $item->modul }}"
                 data-huruf="{{ $item->huruf }}"
                 data-penjelasan="{{ e($item->penjelasan) }}"
                 data-thumbnail="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : '' }}"
                 onclick="klikKartu(this)">

                <div class="thumbnail-wrap relative h-20 flex items-center justify-center bg-gradient-to-br from-pink-50 to-purple-50 overflow-hidden">
                    @if($item->thumbnail)
                        <img class="thumb-img absolute inset-0 w-full h-full object-cover"
                             src="{{ asset('storage/' . $item->thumbnail) }}"
                             alt="Thumbnail {{ $item->huruf }}">
                    @else
                        <div class="thumb-placeholder flex flex-col items-center justify-center w-full h-full">
                            <span class="text-xs text-gray-400 font-medium">No Image</span>
                        </div>
                    @endif
                </div>

                <div class="flex items-center justify-between px-3 py-2">
                    <span class="text-xl font-extrabold text-gray-800">{{ $item->huruf }}</span>
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-[#FCE7F3] text-[#C82D85]">BISINDO</span>
                </div>
            </div>
        @endforeach

        <button onclick="openTambahModal('BISINDO')"
                class="w-32 h-36 rounded-2xl border-2 border-dashed border-purple-300 bg-purple-50 flex flex-col items-center justify-center gap-1 hover:border-pink-400 hover:bg-pink-50 transition">
            <span class="text-3xl font-light text-[#C82D85]">+</span>
            <span class="text-xs font-bold text-center leading-tight text-[#7B2FBE]">Tambah Huruf<br>Baru</span>
        </button>

        <p id="emptyBisindo" class="hidden w-full text-center text-gray-400 text-sm py-4">Belum ada huruf BISINDO.</p>
    </div>
</div>

{{-- ===== SECTION SIBI ===== --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
    <div class="flex items-center gap-3 mb-1">
        <span class="text-base font-bold text-gray-800">Kelola Huruf:</span>
        <span class="px-4 py-1 rounded-full text-xs font-extrabold text-white bg-[#7B2FBE]">SIBI</span>
    </div>

    <p class="text-gray-400 text-sm mb-5">Klik kartu huruf untuk melihat detail atau mengedit.</p>

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
        @foreach($sibi as $item)
            <div class="huruf-card cursor-pointer group relative w-32 rounded-2xl border border-gray-100 bg-white shadow-sm overflow-hidden transition hover:-translate-y-1 hover:shadow-lg hover:border-indigo-300"
                 data-id="{{ $item->id }}"
                 data-update-url="{{ route('admin.modul.update', $item->id) }}"
                 data-modul="{{ $item->modul }}"
                 data-huruf="{{ $item->huruf }}"
                 data-penjelasan="{{ e($item->penjelasan) }}"
                 data-thumbnail="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : '' }}"
                 onclick="klikKartu(this)">

                <div class="thumbnail-wrap relative h-20 flex items-center justify-center bg-gradient-to-br from-indigo-50 to-purple-50 overflow-hidden">
                    @if($item->thumbnail)
                        <img class="thumb-img absolute inset-0 w-full h-full object-cover"
                             src="{{ asset('storage/' . $item->thumbnail) }}"
                             alt="Thumbnail {{ $item->huruf }}">
                    @else
                        <div class="thumb-placeholder flex flex-col items-center justify-center w-full h-full">
                            <span class="text-xs text-gray-400 font-medium">No Image</span>
                        </div>
                    @endif
                </div>

                <div class="flex items-center justify-between px-3 py-2">
                    <span class="text-xl font-extrabold text-gray-800">{{ $item->huruf }}</span>
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-[#EDE9FE] text-[#7B2FBE]">SIBI</span>
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

{{-- ===== MODAL DETAIL ===== --}}
<div id="modalDetail" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4 overflow-hidden">

        <div class="flex items-center justify-between px-6 pt-5 pb-4 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <span class="text-3xl font-extrabold text-gray-800" id="detailHuruf">A</span>
                <span class="px-3 py-1 rounded-full text-xs font-extrabold text-white bg-[#C82D85]" id="detailBadge">BISINDO</span>
            </div>

            <div class="flex items-center gap-2">
                <button type="button"
                        onclick="openEditModal()"
                        class="px-4 py-2 rounded-xl text-xs font-bold border-2 border-yellow-400 text-yellow-600 hover:bg-yellow-50 transition">
                    Edit
                </button>

                <button onclick="closeModal('modalDetail')" class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
            </div>
        </div>

        <div class="p-6 space-y-4 max-h-96 overflow-y-auto">
            <div>
                <p class="text-xs font-bold text-gray-500 mb-2">THUMBNAIL REFERENSI</p>

                <div id="detailThumbWrap" class="w-full h-44 rounded-xl overflow-hidden bg-gray-100 flex items-center justify-center relative">
                    <div id="detailThumbPlaceholder" class="flex flex-col items-center gap-2">
                        <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                        </div>
                        <span class="text-sm text-gray-400 font-medium">Belum ada thumbnail</span>
                    </div>

                    <img id="detailThumbImg" src="" alt="" class="hidden absolute inset-0 w-full h-full object-cover">
                </div>
            </div>

            <div>
                <p class="text-xs font-bold text-gray-500 mb-2">PENJELASAN & KUMPULAN KATA</p>
                <div id="detailPenjelasan"
                     class="w-full min-h-16 p-3 rounded-xl bg-gray-50 border border-gray-100 text-sm text-gray-700 whitespace-pre-line leading-relaxed">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===== MODAL FORM TAMBAH / EDIT ===== --}}
<div id="modalForm" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4 overflow-hidden">

        <div class="flex justify-between items-center px-6 pt-5 pb-4 border-b border-gray-100">
            <h3 class="text-lg font-extrabold text-gray-800" id="modalFormTitle">Tambah Huruf Baru</h3>
            <button type="button" onclick="closeModal('modalForm')" class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
        </div>

        <form id="formModul" action="{{ route('admin.modul.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">

            <div class="p-6 space-y-4 max-h-96 overflow-y-auto">

                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1">MODUL</label>
                    <select name="modul" id="fModul"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-300">
                        <option value="BISINDO">BISINDO</option>
                        <option value="SIBI">SIBI</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1">HURUF (A–Z)</label>
                    <input type="text" name="huruf" id="fHuruf" maxlength="1" placeholder="Contoh: A"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-300 uppercase" />
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1">THUMBNAIL</label>
                    <input type="file" name="thumbnail" id="fThumbnail" accept="image/*"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-300" />
                    <p class="text-xs text-gray-400 mt-1">Format: JPG, JPEG, PNG, atau WebP. Maksimal 2MB.</p>
                    <p id="editThumbnailNote" class="hidden text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengganti thumbnail.</p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1">PENJELASAN & KUMPULAN KATA</label>
                    <textarea name="penjelasan" id="fPenjelasan" rows="4"
                              placeholder="Contoh:
Kata: Api, Anak, Ayah
Cara: Kepalan tangan dengan ibu jari ke samping"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-300 resize-none"></textarea>
                </div>

            </div>

            <div class="flex gap-3 px-6 pb-5 pt-3 border-t border-gray-100">
                <button type="button" onclick="closeModal('modalForm')"
                        class="flex-1 py-2.5 rounded-xl text-sm font-bold border border-gray-200 text-gray-500 hover:bg-gray-50 transition">
                    Batal
                </button>

                <button type="submit"
                        id="btnSubmitModul"
                        class="flex-1 py-2.5 rounded-xl text-white text-sm font-bold hover:opacity-90 transition bg-[#4A1A6B]">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    let kartuAktif = null;

    function klikKartu(el) {
        kartuAktif = el;

        const huruf = el.dataset.huruf;
        const modul = el.dataset.modul;
        const penjelasan = el.dataset.penjelasan || 'Belum ada penjelasan.';
        const thumb = el.dataset.thumbnail;

        document.getElementById('detailHuruf').textContent = huruf;

        const badge = document.getElementById('detailBadge');
        badge.textContent = modul;
        badge.className = `px-3 py-1 rounded-full text-xs font-extrabold text-white ${
            modul === 'BISINDO' ? 'bg-[#C82D85]' : 'bg-[#7B2FBE]'
        }`;

        document.getElementById('detailPenjelasan').textContent = penjelasan;

        const placeholder = document.getElementById('detailThumbPlaceholder');
        const thumbImg = document.getElementById('detailThumbImg');

        if (thumb) {
            placeholder.classList.add('hidden');
            thumbImg.src = thumb;
            thumbImg.classList.remove('hidden');
        } else {
            placeholder.classList.remove('hidden');
            thumbImg.src = '';
            thumbImg.classList.add('hidden');
        }

        showModal('modalDetail');
    }

    document.getElementById('btnTambahHuruf').addEventListener('click', function () {
        openTambahModal('BISINDO');
    });

    function openTambahModal(modul) {
        kartuAktif = null;

        document.getElementById('modalFormTitle').textContent = 'Tambah Huruf Baru';
        document.getElementById('formModul').action = "{{ route('admin.modul.store') }}";
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('btnSubmitModul').textContent = 'Simpan';

        document.getElementById('fModul').value = modul;
        document.getElementById('fHuruf').value = '';
        document.getElementById('fPenjelasan').value = '';
        document.getElementById('fThumbnail').value = '';

        document.getElementById('editThumbnailNote').classList.add('hidden');

        showModal('modalForm');
    }

    function openEditModal() {
        if (!kartuAktif) return;

        closeModal('modalDetail');

        document.getElementById('modalFormTitle').textContent = 'Edit Huruf ' + kartuAktif.dataset.huruf;
        document.getElementById('formModul').action = kartuAktif.dataset.updateUrl;
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('btnSubmitModul').textContent = 'Simpan Perubahan';

        document.getElementById('fModul').value = kartuAktif.dataset.modul;
        document.getElementById('fHuruf').value = kartuAktif.dataset.huruf;
        document.getElementById('fPenjelasan').value = kartuAktif.dataset.penjelasan || '';
        document.getElementById('fThumbnail').value = '';

        document.getElementById('editThumbnailNote').classList.remove('hidden');

        showModal('modalForm');
    }

    function showModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    ['modalDetail', 'modalForm'].forEach(id => {
        document.getElementById(id).addEventListener('click', function (e) {
            if (e.target === this) closeModal(id);
        });
    });

    document.getElementById('fHuruf').addEventListener('input', function () {
        this.value = this.value.toUpperCase();
    });

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
            card.classList.toggle('hidden', !show);
            if (show) visible++;
        });

        document.getElementById(emptyId).classList.toggle('hidden', visible > 0);
    }

    function checkEmpty() {
        const bisindoCount = document.querySelectorAll('#bisindo-grid .huruf-card').length;
        const sibiCount = document.querySelectorAll('#sibi-grid .huruf-card').length;

        document.getElementById('emptyBisindo').classList.toggle('hidden', bisindoCount > 0);
        document.getElementById('emptySibi').classList.toggle('hidden', sibiCount > 0);
    }

    checkEmpty();
</script>
@endpush

@endsection
