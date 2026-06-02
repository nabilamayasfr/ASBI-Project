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
        <form id="soalForm" enctype="multipart/form-data">
        {{-- Field tersembunyi untuk mode tambah/edit --}}
        <input type="hidden" id="modalSoalMode"   value="tambah">
        <input type="hidden" id="modalSoalEditId" value="">
        <input type="hidden" id="soalKuisId"      value="">
        <input type="hidden" id="soalBahasa"      value="bisindo">
        <input type="hidden" id="soalLevel"       value="pemula">

        <div class="space-y-4">

            {{-- Upload Gambar --}}
            <div>
            <label class="block text-xs text-gray-500 mb-1">Gambar Soal</label>
            <input type="file" id="gambarSoal" accept="image/png,image/jpeg"
                    class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2">
            <p class="text-xs text-gray-400 mt-1">Format PNG/JPG, ukuran disarankan 300x300px</p>
            <div id="previewGambar" class="mt-2 hidden">
                <img id="previewImg" src="#" class="max-h-32 rounded-xl border">
                <button type="button" onclick="hapusGambar()"
                        class="text-xs text-red-500 mt-1 block">✖ Hapus gambar</button>
            </div>
            </div>

            {{-- Pilihan Jawaban --}}
            <div>
            <label class="block text-xs text-gray-500 mb-1">Pilihan Jawaban (minimal 2)</label>
            <div id="optionList"></div>
            <button type="button" onclick="tambahOpsi()"
                    class="text-xs text-purple-600 mt-1 hover:underline">+ Tambah opsi</button>
            </div>

            {{-- Jawaban Benar --}}
            <div>
            <label class="block text-xs text-gray-500 mb-1">Jawaban Benar (huruf, contoh: A)</label>
            <input type="text" id="jawabanBenar" maxlength="1" placeholder="A"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 uppercase"
                    required>
            </div>

            {{-- Penjelasan --}}
            <div>
            <label class="block text-xs text-gray-500 mb-1">Penjelasan (tampil saat jawaban salah)</label>
            <textarea id="soalPenjelasan" rows="2"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50"
                        placeholder="Contoh: Huruf A menggunakan kepalan tangan dengan ibu jari di sisi."></textarea>
            </div>

            <button type="submit"
                    class="w-full py-2.5 rounded-xl text-white text-sm font-bold hover:opacity-90 transition"
                    style="background-color: #4A1A6B;">
            Simpan Soal
            </button>

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
const CSRF = document.querySelector('meta[name="csrf-token"]').content;

// ── STATE ──────────────────────────────────────────
let kuisData = [];   // grup kuis dari server
let soalData = {};   // { kuis_virtual_id: [soal, ...] }

// ── LOAD DATA DARI DATABASE ────────────────────────
async function loadData() {
  try {
    const res  = await fetch('/admin/kuis/data');
    const data = await res.json();

    kuisData = data.kuis;

    // Bangun soalData indexed by virtual kuis id
    soalData = {};
    kuisData.forEach(k => {
      soalData[k.id] = k.soal ?? [];
    });

    document.getElementById('totalKuisCount').innerText = data.total_soal;
    document.getElementById('totalLevelCount').innerText = data.total_level;

    renderKuisTable();
  } catch (err) {
    console.error('Gagal load data:', err);
  }
}

// ── RENDER TABEL ──────────────────────────────────
function renderKuisTable() {
  const container  = document.getElementById('kuisList');
  const searchTerm = document.getElementById('searchInput').value.toLowerCase();
  const emptyMsg   = document.getElementById('emptyMsg');

  let filtered = kuisData.filter(k =>
    k.nama.toLowerCase().includes(searchTerm) ||
    k.level.toLowerCase().includes(searchTerm) ||
    k.bahasa.toLowerCase().includes(searchTerm)
  );

  if (filtered.length === 0) {
    container.innerHTML = '';
    emptyMsg.classList.remove('hidden');
    return;
  }

  emptyMsg.classList.add('hidden');
  let html = '';

  filtered.forEach((kuis, idx) => {
    const jumlahSoal = (soalData[kuis.id] ?? []).length;
    html += `
      <div class="kuis-row grid items-center bg-white border border-gray-100 rounded-xl px-4 py-3 shadow-sm text-sm"
           style="grid-template-columns: 60px 1fr 1fr 1fr 1fr 1fr;">
        <span class="text-gray-700 font-semibold">${idx + 1}</span>
        <span class="font-bold text-gray-800">${kuis.nama}</span>
        <span class="text-gray-500">${ucfirst(kuis.level)}</span>
        <span class="text-gray-500">${jumlahSoal} Soal</span>
        <span>
          <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-600">Aktif</span>
        </span>
        <span class="flex items-center gap-2">
          <button onclick="lihatSoal(${kuis.id})"
                  class="px-2 py-1 rounded-lg text-xs font-bold bg-blue-100 text-blue-600 hover:bg-blue-200">
            Lihat Soal
          </button>
          <button onclick="bukaModalTambahSoal(${kuis.id})"
                  class="px-2 py-1 rounded-lg text-xs font-bold bg-green-100 text-green-600 hover:bg-green-200">
            Tambah Soal
          </button>
        </span>
      </div>
    `;
  });

  container.innerHTML = html;
}

// ── LIHAT DAFTAR SOAL ────────────────────────────
function lihatSoal(kuisId) {
  const kuis      = kuisData.find(k => k.id == kuisId);
  const soalList  = soalData[kuisId] ?? [];

  document.getElementById('listSoalKuisNama').innerText = kuis?.nama ?? '';

  const container = document.getElementById('daftarSoalContainer');

  if (soalList.length === 0) {
    container.innerHTML = '<p class="text-gray-400 text-center py-6">Belum ada soal. Klik "Tambah Soal" untuk menambahkan.</p>';
  } else {
    let html = '<div class="space-y-3">';
    soalList.forEach((soal, idx) => {
      const imgHtml = soal.image_url
        ? `<img src="${soal.image_url}" class="w-16 h-16 object-contain rounded-lg border bg-pink-50 p-1 mb-2"
                onerror="this.style.opacity='0.3'">`
        : '';

      const opsiHtml = (soal.options ?? [])
        .map((opt, i) => {
          const isBenar = opt === soal.correct_answer;
          return `<span class="${isBenar ? 'text-green-600 font-bold' : 'text-gray-500'}">${String.fromCharCode(65+i)}. ${opt}</span>`;
        }).join(' &nbsp; ');

      html += `
        <div class="border rounded-xl p-4 bg-gray-50">
          <div class="flex justify-between items-start gap-3">
            <div class="flex-1">
              ${imgHtml}
              <p class="font-semibold text-gray-800 mb-1">${idx+1}. Huruf apa yang ditunjukkan?</p>
              <div class="text-sm mb-1">${opsiHtml}</div>
              <p class="text-xs text-green-600 font-bold">✅ Jawaban benar: ${soal.correct_answer}</p>
              ${soal.explanation ? `<p class="text-xs text-gray-400 mt-1 italic">💡 ${soal.explanation}</p>` : ''}
            </div>
            <div class="flex flex-col gap-1 shrink-0">
              <button onclick="bukaModalEditSoal(${soal.id})"
                      class="px-3 py-1 rounded-lg text-xs font-bold bg-yellow-100 text-yellow-600 hover:bg-yellow-200">
                Edit
              </button>
              <button onclick="konfirmasiHapusSoal(${soal.id})"
                      class="px-3 py-1 rounded-lg text-xs font-bold bg-red-100 text-red-500 hover:bg-red-200">
                Hapus
              </button>
            </div>
          </div>
        </div>
      `;
    });
    html += '</div>';
    container.innerHTML = html;
  }

  openModal('modalListSoal');
}

// ── MODAL TAMBAH SOAL ────────────────────────────
let activeKuisId = null;

function bukaModalTambahSoal(kuisId) {
  const kuis    = kuisData.find(k => k.id == kuisId);
  activeKuisId  = kuisId;

  document.getElementById('soalKuisNama').innerText    = kuis?.nama ?? '';
  document.getElementById('soalKuisId').value          = kuisId;
  document.getElementById('modalSoalMode').value       = 'tambah';
  document.getElementById('modalSoalEditId').value     = '';
  document.getElementById('soalForm').reset();
  document.getElementById('previewGambar').classList.add('hidden');

  // Isi otomatis bahasa dan level dari kuis yang dipilih
  document.getElementById('soalBahasa').value = kuis?.bahasa ?? 'bisindo';
  document.getElementById('soalLevel').value  = kuis?.level  ?? 'pemula';

  // Reset opsi default 4 baris
  const optionContainer = document.getElementById('optionList');
  optionContainer.innerHTML = '';
  for (let i = 0; i < 4; i++) addOptionRow('', String.fromCharCode(65 + i));

  openModal('modalSoal');
}

// ── MODAL EDIT SOAL ───────────────────────────────
function bukaModalEditSoal(soalId) {
  // Cari soal dari soalData
  let targetSoal = null;
  for (const soalList of Object.values(soalData)) {
    targetSoal = soalList.find(s => s.id == soalId);
    if (targetSoal) break;
  }
  if (!targetSoal) return;

  document.getElementById('modalSoalMode').value   = 'edit';
  document.getElementById('modalSoalEditId').value = soalId;
  document.getElementById('soalKuisNama').innerText = 'Edit Soal — Huruf ' + targetSoal.correct_answer;
  document.getElementById('jawabanBenar').value     = targetSoal.correct_answer;
  document.getElementById('soalPenjelasan').value   = targetSoal.explanation ?? '';

  // Isi opsi jawaban
  const optionContainer = document.getElementById('optionList');
  optionContainer.innerHTML = '';
  (targetSoal.options ?? []).forEach((opt, i) => addOptionRow(opt, String.fromCharCode(65 + i)));

  // Preview gambar
  if (targetSoal.image_url) {
    document.getElementById('previewImg').src = targetSoal.image_url;
    document.getElementById('previewGambar').classList.remove('hidden');
  } else {
    document.getElementById('previewGambar').classList.add('hidden');
  }

  openModal('modalSoal');
}

// ── SUBMIT FORM SOAL (TAMBAH / EDIT) ─────────────
document.getElementById('soalForm').addEventListener('submit', async function(e) {
  e.preventDefault();

  const mode   = document.getElementById('modalSoalMode').value;
  const editId = document.getElementById('modalSoalEditId').value;
  const kuis   = kuisData.find(k => k.id == activeKuisId);

  // Kumpulkan opsi jawaban
  const opsiInputs = document.querySelectorAll('#optionList .option-input');
  const opsi       = Array.from(opsiInputs).map(i => i.value.trim()).filter(v => v !== '');
  if (opsi.length < 2) return alert('Minimal 2 opsi jawaban');

  const jawaban = document.getElementById('jawabanBenar').value.trim().toUpperCase();
  if (!/^[A-Z]$/.test(jawaban)) return alert('Jawaban harus berupa satu huruf (A-Z)');
  if (!opsi.includes(jawaban)) return alert(`Jawaban "${jawaban}" harus ada di dalam opsi pilihan`);

  // Buat FormData (karena ada file upload)
  const formData = new FormData();
  formData.append('_token',          CSRF);
  formData.append('bahasa',          document.getElementById('soalBahasa').value);
  formData.append('level',           document.getElementById('soalLevel').value);
  formData.append('correct_answer',  jawaban);
  formData.append('explanation',     document.getElementById('soalPenjelasan').value);
  opsi.forEach(o => formData.append('options[]', o));

  const gambarFile = document.getElementById('gambarSoal').files[0];
  if (gambarFile) formData.append('gambar', gambarFile);

  // Tentukan URL dan method
  let url, method;
  if (mode === 'edit') {
    url    = `/admin/soal/${editId}`;
    method = 'POST';
    formData.append('_method', 'PUT');  // Laravel method spoofing
  } else {
    url    = '/admin/soal';
    method = 'POST';
  }

  try {
    const res  = await fetch(url, { method, body: formData });
    const data = await res.json();

    if (!res.ok) {
      const pesan = data.message ?? 'Terjadi kesalahan';
      return alert('Error: ' + pesan);
    }

    closeModal('modalSoal');
    await loadData();  // Refresh semua data dari server

    alert(mode === 'edit' ? '✅ Soal berhasil diupdate!' : '✅ Soal berhasil ditambahkan!');
  } catch (err) {
    console.error(err);
    alert('Gagal menyimpan soal. Coba lagi.');
  }
});

// ── HAPUS SOAL ────────────────────────────────────
async function konfirmasiHapusSoal(soalId) {
  if (!confirm('Yakin hapus soal ini? Tindakan ini tidak bisa dibatalkan.')) return;

  try {
    const res  = await fetch(`/admin/soal/${soalId}`, {
      method:  'DELETE',
      headers: {
        'X-CSRF-TOKEN': CSRF,
        'Content-Type': 'application/json',
      },
    });
    const data = await res.json();

    if (!res.ok) return alert('Gagal menghapus: ' + (data.message ?? ''));

    await loadData();
    closeModal('modalListSoal');
    alert('✅ Soal berhasil dihapus');
  } catch (err) {
    alert('Gagal menghapus soal.');
  }
}

// ── HELPER FUNCTIONS ────────────────────────────
function addOptionRow(value = '', label = '') {
  const container = document.getElementById('optionList');
  const huruf     = label || String.fromCharCode(65 + container.children.length);
  const div       = document.createElement('div');
  div.className   = 'flex gap-2 mb-2';
  div.innerHTML   = `
    <span class="w-6 text-sm font-bold text-gray-500 flex items-center">${huruf}</span>
    <input type="text" placeholder="Opsi ${huruf}" value="${value.replace(/"/g, '&quot;')}"
           class="option-input w-full border border-gray-200 rounded-xl px-3 py-2 text-sm" data-opt="${huruf}">
    <button type="button" onclick="this.parentElement.remove()"
            class="text-red-400 text-sm px-1">✖</button>
  `;
  container.appendChild(div);
}

function tambahOpsi() { addOptionRow(); }

function hapusGambar() {
  document.getElementById('gambarSoal').value = '';
  document.getElementById('previewGambar').classList.add('hidden');
}

function ucfirst(str) {
  return str ? str.charAt(0).toUpperCase() + str.slice(1) : '';
}

function openModal(id) {
  const el = document.getElementById(id);
  el.classList.remove('hidden');
  el.classList.add('flex');
}

function closeModal(id) {
  const el = document.getElementById(id);
  el.classList.add('hidden');
  el.classList.remove('flex');
}

window.onclick = function(e) {
  ['modalKuis','modalSoal','modalListSoal'].forEach(id => {
    if (e.target === document.getElementById(id)) closeModal(id);
  });
};

document.getElementById('gambarSoal').addEventListener('change', function(e) {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = ev => {
      document.getElementById('previewImg').src = ev.target.result;
      document.getElementById('previewGambar').classList.remove('hidden');
    };
    reader.readAsDataURL(file);
  }
});

document.getElementById('searchInput').addEventListener('input', renderKuisTable);

// ── INIT ─────────────────────────────────────────
loadData();
</script>
@endpush

@endsection
