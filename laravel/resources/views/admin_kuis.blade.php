@extends('layout.admin')

@section('title', 'SignLearn - Modul Pembelajaran')

@section('content')

{{-- Header --}}
<div class="flex justify-between items-start mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-800">Modul Pembelajaran</h1>
        <p class="text-gray-400 text-sm mt-1">Kelola modul BISINDO & SIBI beserta huruf A-Z dan referensinya</p>
    </div>
    <button id="btnTambahKuis"
            class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-white text-sm font-bold shadow transition hover:opacity-90"
            style="background-color: #4A1A6B;">
        + Tambah Kuis
    </button>
</div>

{{-- Statistik Cards --}}
<div class="grid grid-cols-2 gap-4 mb-8 max-w-sm">
    <div class="bg-red-100 rounded-2xl shadow-sm border border-red-200 p-5 text-center">
        <p class="text-4xl font-extrabold text-red-700 mb-1" id="totalKuisCount">0</p>
        <p class="text-sm font-bold text-red-600">Total Kuis</p>
    </div>
    <div class="bg-green-100 rounded-2xl shadow-sm border border-green-200 p-5 text-center">
        <p class="text-4xl font-extrabold text-green-700 mb-1" id="totalLevelCount">0</p>
        <p class="text-sm font-bold text-green-600">Level Kuis</p>
    </div>
</div>

{{-- Tabel Kuis --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <div class="mb-4">
        <div class="flex items-center gap-2 border border-gray-200 rounded-xl px-4 py-2 w-52 bg-gray-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 105 11a6 6 0 0012 0z"/>
            </svg>
            <input type="text" id="searchInput" placeholder="Pencarian" class="bg-transparent text-sm text-gray-500 focus:outline-none w-full" />
        </div>
    </div>

    {{-- Header Tabel --}}
    <div class="grid text-sm font-bold text-gray-700 px-4 mb-2" style="grid-template-columns: 60px 1fr 1fr 1fr 1fr 1fr;">
        <span>No</span>
        <span>Nama Kuis</span>
        <span>Level</span>
        <span>Jumlah Soal</span>
        <span>Status</span>
        <span>Aksi</span>
    </div>
    <hr class="border-gray-200 mb-3">

    {{-- Rows --}}
    <div class="space-y-2" id="kuisList"></div>
    <div id="emptyMsg" class="hidden text-center text-gray-400 text-sm py-6">Tidak ada kuis yang ditemukan.</div>
</div>

{{-- MODAL TAMBAH / EDIT KUIS (untuk mengubah nama, level, status) --}}
<div id="modalKuis" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-40">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-extrabold text-gray-800" id="modalKuisTitle">Tambah Kuis</h3>
            <button onclick="closeModal('modalKuis')" class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
        </div>
        <form id="kuisForm">
            <input type="hidden" id="editKuisId" value="">
            <div class="space-y-3">
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Nama Kuis</label>
                    <input type="text" id="kuisNama" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50" required>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Level</label>
                    <select id="kuisLevel" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50">
                        <option>Pemula</option>
                        <option>Menengah</option>
                        <option>Mahir</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Status</label>
                    <select id="kuisStatus" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50">
                        <option>Aktif</option>
                        <option>Non Aktif</option>
                    </select>
                </div>
                <button type="submit" class="w-full py-2.5 rounded-xl text-white text-sm font-bold mt-2 hover:opacity-90 transition" style="background-color: #4A1A6B;">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL TAMBAH SOAL (gambar, opsi, jawaban) --}}
<div id="modalSoal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl mx-4 p-6 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-extrabold text-gray-800">Tambah Soal untuk <span id="soalKuisNama"></span></h3>
            <button onclick="closeModal('modalSoal')" class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
        </div>
        <form id="soalForm">
            <input type="hidden" id="soalKuisId" value="">
            <div class="space-y-4">
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Gambar Soal (opsional)</label>
                    <input type="file" id="gambarSoal" accept="image/*" class="w-full text-sm">
                    <div id="previewGambar" class="mt-2 hidden">
                        <img id="previewImg" src="#" class="max-h-32 rounded border">
                        <button type="button" onclick="hapusGambar()" class="text-xs text-red-500 mt-1">Hapus gambar</button>
                    </div>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Teks Pertanyaan</label>
                    <textarea id="soalPertanyaan" rows="2" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50" placeholder="Contoh: Huruf apakah ini?" required></textarea>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Pilihan Jawaban (minimal 2)</label>
                    <div id="optionList"></div>
                    <button type="button" onclick="tambahOpsi()" class="text-xs text-purple-600 mt-1">+ Tambah opsi</button>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Jawaban Benar (huruf, contoh: A)</label>
                    <input type="text" id="jawabanBenar" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50" placeholder="A" maxlength="1" required>
                </div>
                <button type="submit" class="w-full py-2.5 rounded-xl text-white text-sm font-bold mt-2 hover:opacity-90 transition" style="background-color: #4A1A6B;">Simpan Soal</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Daftar Soal (untuk melihat soal-soal dalam kuis) --}}
<div id="modalListSoal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-45">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl mx-4 p-6 max-h-[80vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-extrabold text-gray-800">Daftar Soal - <span id="listSoalKuisNama"></span></h3>
            <button onclick="closeModal('modalListSoal')" class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
        </div>
        <div id="daftarSoalContainer"></div>
        <div class="mt-4 flex justify-end">
            <button onclick="closeModal('modalListSoal')" class="px-4 py-2 bg-gray-200 rounded-xl text-sm">Tutup</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Data kuis dan soal
    let kuisData = [];
    let soalData = []; // each soal: { id, kuis_id, gambar, pertanyaan, opsi: [], jawaban }

    // Load data dari localStorage
    function loadData() {
        const storedKuis = localStorage.getItem('adminKuis');
        if (storedKuis) {
            kuisData = JSON.parse(storedKuis);
        } else {
            // Data awal
            kuisData = [
                { id: 1, nama: 'Pemula 1', level: 'Pemula', status: 'Aktif' },
                { id: 2, nama: 'Pemula 2', level: 'Pemula', status: 'Aktif' },
                { id: 3, nama: 'Menengah 1', level: 'Menengah', status: 'Non Aktif' }
            ];
            saveKuisData();
        }
        const storedSoal = localStorage.getItem('adminSoal');
        if (storedSoal) {
            soalData = JSON.parse(storedSoal);
        } else {
            soalData = [];
            saveSoalData();
        }
        updateStatistik();
        renderKuisTable();
    }

    function saveKuisData() {
        localStorage.setItem('adminKuis', JSON.stringify(kuisData));
    }
    function saveSoalData() {
        localStorage.setItem('adminSoal', JSON.stringify(soalData));
    }

    function updateStatistik() {
        document.getElementById('totalKuisCount').innerText = kuisData.length;
        const uniqueLevels = new Set(kuisData.map(k => k.level)).size;
        document.getElementById('totalLevelCount').innerText = uniqueLevels;
    }

    function renderKuisTable() {
        const container = document.getElementById('kuisList');
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        let filtered = kuisData.filter(k => k.nama.toLowerCase().includes(searchTerm) || k.level.toLowerCase().includes(searchTerm));
        const emptyMsg = document.getElementById('emptyMsg');
        if (filtered.length === 0) {
            container.innerHTML = '';
            emptyMsg.classList.remove('hidden');
            return;
        }
        emptyMsg.classList.add('hidden');
        let html = '';
        filtered.forEach((kuis, idx) => {
            const jumlahSoal = soalData.filter(s => s.kuis_id === kuis.id).length;
            html += `
                <div class="kuis-row grid items-center bg-white border border-gray-100 rounded-xl px-4 py-3 shadow-sm text-sm" style="grid-template-columns: 60px 1fr 1fr 1fr 1fr 1fr;">
                    <span class="text-gray-700 font-semibold">${idx+1}</span>
                    <span class="font-bold text-gray-800 kuis-nama">${kuis.nama}</span>
                    <span class="text-gray-500">${kuis.level}</span>
                    <span class="text-gray-500">${jumlahSoal} Soal</span>
                    <span>${kuis.status === 'Aktif' ? '<span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-600">Aktif</span>' : '<span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-500">Non Aktif</span>'}</span>
                    <span class="flex items-center gap-2">
                        <button onclick="lihatSoal(${kuis.id})" class="px-2 py-1 rounded-lg text-xs font-bold bg-blue-100 text-blue-600 hover:bg-blue-200">Lihat Soal</button>
                        <button onclick="tambahSoal(${kuis.id}, '${kuis.nama}')" class="px-2 py-1 rounded-lg text-xs font-bold bg-green-100 text-green-600 hover:bg-green-200">Tambah Soal</button>
                        <button onclick="editKuis(${kuis.id})" class="px-2 py-1 rounded-lg text-xs font-bold border-2 border-yellow-400 text-yellow-600 hover:bg-yellow-50">Edit</button>
                        <button onclick="hapusKuis(${kuis.id})" class="text-gray-500 hover:text-red-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </span>
                </div>
            `;
        });
        container.innerHTML = html;
    }

    // Tambah Kuis
    document.getElementById('btnTambahKuis').addEventListener('click', function() {
        document.getElementById('modalKuisTitle').innerText = 'Tambah Kuis';
        document.getElementById('editKuisId').value = '';
        document.getElementById('kuisNama').value = '';
        document.getElementById('kuisLevel').value = 'Pemula';
        document.getElementById('kuisStatus').value = 'Aktif';
        document.getElementById('modalKuis').style.display = 'flex';
    });

    document.getElementById('kuisForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const id = document.getElementById('editKuisId').value;
        const nama = document.getElementById('kuisNama').value.trim();
        const level = document.getElementById('kuisLevel').value;
        const status = document.getElementById('kuisStatus').value;
        if (!nama) return alert('Nama kuis harus diisi');
        if (id) {
            // edit
            const index = kuisData.findIndex(k => k.id == id);
            if (index !== -1) {
                kuisData[index].nama = nama;
                kuisData[index].level = level;
                kuisData[index].status = status;
            }
        } else {
            // tambah baru
            const newId = Date.now();
            kuisData.push({ id: newId, nama: nama, level: level, status: status });
        }
        saveKuisData();
        updateStatistik();
        renderKuisTable();
        closeModal('modalKuis');
    });

    function editKuis(id) {
        const kuis = kuisData.find(k => k.id == id);
        if (kuis) {
            document.getElementById('modalKuisTitle').innerText = 'Edit Kuis';
            document.getElementById('editKuisId').value = kuis.id;
            document.getElementById('kuisNama').value = kuis.nama;
            document.getElementById('kuisLevel').value = kuis.level;
            document.getElementById('kuisStatus').value = kuis.status;
            document.getElementById('modalKuis').style.display = 'flex';
        }
    }

    function hapusKuis(id) {
        if (confirm('Yakin hapus kuis ini? Semua soal di dalamnya juga akan terhapus.')) {
            kuisData = kuisData.filter(k => k.id != id);
            soalData = soalData.filter(s => s.kuis_id != id);
            saveKuisData();
            saveSoalData();
            updateStatistik();
            renderKuisTable();
        }
    }

    // Tambah Soal
    let currentKuisId = null;
    function tambahSoal(kuisId, kuisNama) {
        currentKuisId = kuisId;
        document.getElementById('soalKuisNama').innerText = kuisNama;
        document.getElementById('soalKuisId').value = kuisId;
        // Reset form
        document.getElementById('soalForm').reset();
        document.getElementById('previewGambar').classList.add('hidden');
        window._tempGambar = null;
        // Reset opsi minimal 4 baris kosong
        const optionContainer = document.getElementById('optionList');
        optionContainer.innerHTML = '';
        for (let i = 0; i < 4; i++) {
            addOptionRow('', String.fromCharCode(65+i));
        }
        document.getElementById('modalSoal').style.display = 'flex';
    }

    function addOptionRow(value = '', label = '') {
        const container = document.getElementById('optionList');
        const huruf = label || String.fromCharCode(65 + container.children.length);
        const div = document.createElement('div');
        div.className = 'flex gap-2 mb-2';
        div.innerHTML = `
            <input type="text" placeholder="Opsi ${huruf}" value="${value.replace(/"/g, '&quot;')}" class="option-input w-full border border-gray-200 rounded-xl px-3 py-2 text-sm" data-opt="${huruf}">
            <button type="button" onclick="this.parentElement.remove()" class="text-red-400 text-sm">✖</button>
        `;
        container.appendChild(div);
    }

    function tambahOpsi() {
        addOptionRow('');
    }

    function hapusGambar() {
        window._tempGambar = null;
        document.getElementById('previewGambar').classList.add('hidden');
        document.getElementById('gambarSoal').value = '';
    }

    document.getElementById('gambarSoal').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                window._tempGambar = ev.target.result;
                document.getElementById('previewImg').src = ev.target.result;
                document.getElementById('previewGambar').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('soalForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const kuis_id = parseInt(document.getElementById('soalKuisId').value);
        const pertanyaan = document.getElementById('soalPertanyaan').value.trim();
        if (!pertanyaan) return alert('Pertanyaan harus diisi');
        const optionInputs = document.querySelectorAll('#optionList .option-input');
        const opsi = Array.from(optionInputs).map(inp => inp.value.trim()).filter(v => v !== '');
        if (opsi.length < 2) return alert('Minimal 2 opsi jawaban');
        let jawaban = document.getElementById('jawabanBenar').value.trim().toUpperCase();
        const validHuruf = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if (jawaban.length !== 1 || !validHuruf.includes(jawaban)) return alert('Jawaban benar harus berupa satu huruf (A, B, C, ...)');
        const jawabanIndex = jawaban.charCodeAt(0) - 65;
        if (jawabanIndex >= opsi.length) return alert(`Jawaban ${jawaban} tidak valid, hanya ada ${opsi.length} opsi.`);
        const gambar = window._tempGambar || null;
        const newSoal = {
            id: Date.now(),
            kuis_id: kuis_id,
            gambar: gambar,
            pertanyaan: pertanyaan,
            opsi: opsi,
            jawaban: jawaban
        };
        soalData.push(newSoal);
        saveSoalData();
        renderKuisTable(); // Update jumlah soal
        closeModal('modalSoal');
        alert('Soal berhasil ditambahkan');
    });

    // Lihat daftar soal dalam kuis
    function lihatSoal(kuisId) {
        const kuis = kuisData.find(k => k.id == kuisId);
        if (!kuis) return;
        document.getElementById('listSoalKuisNama').innerText = kuis.nama;
        const soalList = soalData.filter(s => s.kuis_id == kuisId);
        const container = document.getElementById('daftarSoalContainer');
        if (soalList.length === 0) {
            container.innerHTML = '<p class="text-gray-400 text-center py-4">Belum ada soal untuk kuis ini.</p>';
        } else {
            let html = '<div class="space-y-3">';
            soalList.forEach((soal, idx) => {
                html += `
                    <div class="border rounded-xl p-3 bg-gray-50">
                        <div class="flex justify-between">
                            <div class="flex-1">
                                ${soal.gambar ? `<img src="${soal.gambar}" class="max-h-24 rounded mb-2">` : ''}
                                <p class="font-medium">${idx+1}. ${soal.pertanyaan}</p>
                                <div class="text-sm mt-1">${soal.opsi.map((opt,i)=>`${String.fromCharCode(65+i)}. ${opt}`).join(' &nbsp; ')}</div>
                                <p class="text-xs text-green-600 mt-1">Jawaban: ${soal.jawaban}</p>
                            </div>
                            <button onclick="hapusSoal(${soal.id})" class="text-red-500 text-sm border border-red-300 px-2 py-1 rounded h-fit">Hapus</button>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
            container.innerHTML = html;
        }
        document.getElementById('modalListSoal').style.display = 'flex';
    }

    function hapusSoal(soalId) {
        if (confirm('Yakin hapus soal ini?')) {
            soalData = soalData.filter(s => s.id != soalId);
            saveSoalData();
            // Refresh tampilan daftar soal yang sedang dibuka
            const currentKuisId = document.getElementById('listSoalKuisNama') ? kuisData.find(k => k.nama === document.getElementById('listSoalKuisNama').innerText)?.id : null;
            if (currentKuisId) lihatSoal(currentKuisId);
            renderKuisTable();
        }
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }

    // Klik luar modal
    window.onclick = function(e) {
        if (e.target === document.getElementById('modalKuis')) closeModal('modalKuis');
        if (e.target === document.getElementById('modalSoal')) closeModal('modalSoal');
        if (e.target === document.getElementById('modalListSoal')) closeModal('modalListSoal');
    };

    document.getElementById('searchInput').addEventListener('input', function() {
        renderKuisTable();
    });

    loadData();
</script>
@endpush

@endsection
