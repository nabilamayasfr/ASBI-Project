@extends('layout.admin')

@section('title', 'SignLearn - Kelola Akun Pengguna')

@section('content')

{{-- Header --}}
<div class="flex justify-between items-start mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-800">Kelola Akun Pengguna</h1>
        <p class="text-gray-400 text-sm mt-1">Kelola Akun Pengguna dan edit pengguna.</p>
    </div>
    <button id="btnTambahAkun"
            class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-white text-sm font-bold shadow transition hover:opacity-90"
            style="background-color: #4A1A6B;">
        + Tambah Akun
    </button>
</div>

{{-- Statistik Cards --}}
<div class="grid grid-cols-3 gap-4 mb-8">

    {{-- Total Pengguna --}}
    <div class="rounded-2xl p-5" style="background-color: #BAE6FD;">
        <div class="flex items-center gap-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4.13a4 4 0 10-8 0 4 4 0 008 0z"/>
            </svg>
            <span class="text-3xl font-extrabold text-gray-800">{{ $users->count() }}</span>
        </div>
        <p class="text-sm font-bold text-blue-600">Total Pengguna</p>
    </div>

    {{-- Pengguna Aktif --}}
    <div class="rounded-2xl p-5" style="background-color: #BBF7D0;">
        <div class="flex items-center gap-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4.13a4 4 0 10-8 0 4 4 0 008 0z"/>
            </svg>
            <span class="text-3xl font-extrabold text-gray-800">{{ $users->count() }}</span>
        </div>
        <p class="text-sm font-bold text-green-600">Pengguna Aktif</p>
    </div>

    {{-- Pengguna Non Aktif --}}
    <div class="rounded-2xl p-5" style="background-color: #FCA5A5;">
        <div class="flex items-center gap-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4.13a4 4 0 10-8 0 4 4 0 008 0z"/>
            </svg>
            <span class="text-3xl font-extrabold text-gray-800">0</span>
        </div>
        <p class="text-sm font-bold text-red-500">Pengguna Non Aktif</p>
    </div>

</div>

{{-- Tabel --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

    {{-- Search --}}
    <div class="mb-4">
        <div class="flex items-center gap-2 border border-gray-200 rounded-xl px-4 py-2 w-52 bg-gray-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 105 11a6 6 0 0012 0z"/>
            </svg>
            <input type="text" id="searchInput" placeholder="Pencarian"
                   class="bg-transparent text-sm text-gray-500 focus:outline-none w-full" />
        </div>
    </div>

    {{-- Header Tabel --}}
    <div class="grid grid-cols-4 text-sm font-bold text-gray-700 px-4 mb-2">
        <span>Nama Pengguna</span>
        <span>Gmail</span>
        <span>Status</span>
        <span>Aksi</span>
    </div>
    <hr class="border-gray-200 mb-3">

    {{-- Rows --}}
    <div class="space-y-2" id="userList">

        @foreach($users as $user)
<div class="user-row grid grid-cols-4 items-center bg-white border border-gray-100 rounded-xl px-4 py-3 shadow-sm text-sm">
    <span class="font-semibold text-gray-800 user-name">{{ $user->name }}</span>
    <span class="text-gray-500 user-email">{{ $user->email }}</span>
    <span class="user-status">
        <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-600">Aktif</span>
    </span>
            <span class="flex items-center gap-2">
                {{-- Tombol Edit (style seperti modul) --}}
                <button onclick="openEditModal(this)"
                        data-nama="{{ $user->name }}"
data-email="{{ $user->email }}"
data-status="Aktif"
                        class="px-3 py-1 rounded-lg text-xs font-bold border-2 border-yellow-400 text-yellow-600 hover:bg-yellow-50 transition">
                    Edit
                </button>
                {{-- Tombol Hapus --}}
                <button class="text-gray-500 hover:text-red-500 transition" onclick="confirmDelete(this)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </span>
        </div>
        @endforeach

        <div id="emptyMsg" class="hidden text-center text-gray-400 text-sm py-6">
            Tidak ada pengguna yang ditemukan.
        </div>
    </div>

</div>

{{-- Modal Tambah Akun --}}
<div id="modalTambah" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-extrabold text-gray-800">Tambah Akun Pengguna</h3>
            <button onclick="closeModal('modalTambah')" class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
        </div>
        <div class="space-y-3">
            <div>
                <label class="block text-xs text-gray-500 mb-1">Nama Lengkap</label>
                <input type="text" id="tambahNama" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-300" />
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Email</label>
                <input type="email" id="tambahEmail" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-300" />
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Password</label>
                <input type="password" id="tambahPassword" autocomplete="new-password" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-300" placeholder="Masukkan password" />
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Status</label>
                <select id="tambahStatus" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-300">
                    <option value="Aktif">Aktif</option>
                    <option value="Non Aktif">Non Aktif</option>
                </select>
            </div>
            <button id="btnSimpanTambah" class="w-full py-2.5 rounded-xl text-white text-sm font-bold mt-2 hover:opacity-90 transition"
                    style="background-color: #4A1A6B;">
                Simpan
            </button>
        </div>
    </div>
</div>

{{-- Modal Edit Akun (terpisah) --}}
<div id="modalEdit" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-extrabold text-gray-800">Edit Akun Pengguna</h3>
            <button onclick="closeModal('modalEdit')" class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
        </div>
        <div class="space-y-3">
            <div>
                <label class="block text-xs text-gray-500 mb-1">Nama Lengkap</label>
                <input type="text" id="editNama" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-300" />
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Email</label>
                <input type="email" id="editEmail" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-300" />
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Password</label>
                <input type="password" id="editPassword" autocomplete="new-password" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-300" placeholder="Kosongkan jika tidak diubah" />
            </div>
            <div>
                <label class="block text-xs text-gray-500 mb-1">Status</label>
                <select id="editStatus" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-300">
                    <option value="Aktif">Aktif</option>
                    <option value="Non Aktif">Non Aktif</option>
                </select>
            </div>
            <button id="btnSimpanEdit" class="w-full py-2.5 rounded-xl text-white text-sm font-bold mt-2 hover:opacity-90 transition"
                    style="background-color: #4A1A6B;">
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let currentEditRow = null; // menyimpan baris yang sedang diedit

    // Buka modal tambah
    document.getElementById('btnTambahAkun').addEventListener('click', function () {
        // Reset form tambah
        document.getElementById('tambahNama').value = '';
        document.getElementById('tambahEmail').value = '';
        document.getElementById('tambahPassword').value = '';
        document.getElementById('tambahStatus').value = 'Aktif';
        document.getElementById('modalTambah').style.display = 'flex';
    });

    // Tutup modal (umum)
    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }

    // Klik luar modal
    ['modalTambah', 'modalEdit'].forEach(id => {
        document.getElementById(id).addEventListener('click', function (e) {
            if (e.target === this) closeModal(id);
        });
    });

    // Buka modal edit
    function openEditModal(btn) {
        currentEditRow = btn.closest('.user-row');
        const nama = btn.dataset.nama;
        const email = btn.dataset.email;
        const status = btn.dataset.status;

        document.getElementById('editNama').value = nama;
        document.getElementById('editEmail').value = email;
        document.getElementById('editPassword').value = ''; // kosongkan untuk keamanan
        document.getElementById('editStatus').value = status;
        document.getElementById('modalEdit').style.display = 'flex';
    }

    // Simpan data tambah
    document.getElementById('btnSimpanTambah').addEventListener('click', function () {
        const nama = document.getElementById('tambahNama').value.trim();
        const email = document.getElementById('tambahEmail').value.trim();
        const password = document.getElementById('tambahPassword').value;
        const status = document.getElementById('tambahStatus').value;

        if (!nama || !email) {
            alert('Nama dan Email harus diisi!');
            return;
        }
        if (!password) {
            alert('Password harus diisi untuk akun baru!');
            return;
        }

        // Buat baris baru
        const userList = document.getElementById('userList');
        const newRow = document.createElement('div');
        newRow.className = 'user-row grid grid-cols-4 items-center bg-white border border-gray-100 rounded-xl px-4 py-3 shadow-sm text-sm';
        newRow.innerHTML = `
            <span class="font-semibold text-gray-800 user-name">${escapeHtml(nama)}</span>
            <span class="text-gray-500 user-email">${escapeHtml(email)}</span>
            <span class="user-status">
                ${status === 'Aktif'
                    ? '<span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-600">Aktif</span>'
                    : '<span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-500">Non Aktif</span>'}
            </span>
            <span class="flex items-center gap-2">
                <button onclick="openEditModal(this)"
                        data-nama="${escapeHtml(nama)}"
                        data-email="${escapeHtml(email)}"
                        data-status="${status}"
                        class="px-3 py-1 rounded-lg text-xs font-bold border-2 border-yellow-400 text-yellow-600 hover:bg-yellow-50 transition">
                    Edit
                </button>
                <button class="text-gray-500 hover:text-red-500 transition" onclick="confirmDelete(this)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </span>
        `;
        const emptyMsg = document.getElementById('emptyMsg');
        userList.insertBefore(newRow, emptyMsg);
        closeModal('modalTambah');
        updateStats();
        checkEmpty();
    });

    // Simpan perubahan edit
    document.getElementById('btnSimpanEdit').addEventListener('click', function () {
        if (!currentEditRow) return;

        const nama = document.getElementById('editNama').value.trim();
        const email = document.getElementById('editEmail').value.trim();
        const status = document.getElementById('editStatus').value;
        // password diabaikan karena tidak disimpan di frontend demo

        if (!nama || !email) {
            alert('Nama dan Email harus diisi!');
            return;
        }

        // Update baris
        currentEditRow.querySelector('.user-name').innerText = nama;
        currentEditRow.querySelector('.user-email').innerText = email;
        const statusSpan = currentEditRow.querySelector('.user-status');
        statusSpan.innerHTML = status === 'Aktif'
            ? '<span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-600">Aktif</span>'
            : '<span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-500">Non Aktif</span>';

        // Update data attribute pada tombol edit di baris tersebut
        const editBtn = currentEditRow.querySelector('button[onclick*="openEditModal"]');
        if (editBtn) {
            editBtn.setAttribute('data-nama', nama);
            editBtn.setAttribute('data-email', email);
            editBtn.setAttribute('data-status', status);
        }

        closeModal('modalEdit');
        updateStats();
    });

    // Hapus baris
    function confirmDelete(btn) {
        if (confirm('Yakin ingin menghapus pengguna ini?')) {
            btn.closest('.user-row').remove();
            updateStats();
            checkEmpty();
        }
    }

    // Cek kosong
    function checkEmpty() {
        const rows = document.querySelectorAll('.user-row:not([style*="display: none"])');
        document.getElementById('emptyMsg').classList.toggle('hidden', rows.length > 0);
    }

    // Search realtime
    document.getElementById('searchInput').addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        document.querySelectorAll('.user-row').forEach(row => {
            const nama = row.querySelector('.user-name').innerText.toLowerCase();
            const email = row.querySelector('.user-email').innerText.toLowerCase();
            row.style.display = (nama.includes(keyword) || email.includes(keyword)) ? '' : 'none';
        });
        checkEmpty();
    });

    // Update statistik
    function updateStats() {
        const rows = document.querySelectorAll('.user-row');
        let total = rows.length;
        let aktif = 0;
        rows.forEach(row => {
            const statusText = row.querySelector('.user-status span').innerText;
            if (statusText === 'Aktif') aktif++;
        });
        const nonAktif = total - aktif;
        const allStats = document.querySelectorAll('.grid.grid-cols-3.gap-4 .rounded-2xl');
        if (allStats.length >= 3) {
            allStats[0].querySelector('.text-3xl').innerText = total;
            allStats[1].querySelector('.text-3xl').innerText = aktif;
            allStats[2].querySelector('.text-3xl').innerText = nonAktif;
        }
    }

    // Helper escape HTML
    function escapeHtml(str) {
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }

    // Inisialisasi
    updateStats();
    checkEmpty();
</script>
@endpush

@endsection
