<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>@yield('title', 'SignLearn Admin')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>* { font-family: 'Poppins', sans-serif; }</style>
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800">

<div class="flex min-h-screen">

    {{-- ===== SIDEBAR ===== --}}
    <div class="w-48 min-h-screen flex flex-col" style="background-color: #6B2D8B;">

        {{-- Logo --}}
        <div class="flex items-center gap-2 px-4 py-5 border-b border-purple-700">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-10 object-contain">
            <div>
                <p class="text-white font-extrabold text-sm leading-tight">SIGNLEARN</p>
                <p class="text-white font-bold text-sm">Admin Panel</p>
            </div>
        </div>

        {{-- Menu --}}
        <nav class="flex-1 py-4 space-y-1 px-2">


            <a href="{{ route('admin.pengguna') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
               {{ request()->routeIs('admin.pengguna') ? 'bg-white text-purple-700' : 'text-white hover:bg-purple-700' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4.13a4 4 0 10-8 0 4 4 0 008 0z"/>
                </svg>
                Data Pengguna
            </a>

            <a href="{{ route('admin.modul') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
               {{ request()->routeIs('admin.modul') ? 'bg-white text-purple-700' : 'text-white hover:bg-purple-700' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Modul Pembelajaran
            </a>

            <a href="{{ route('admin.kuis') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
               {{ request()->routeIs('admin.kuis') ? 'bg-white text-purple-700' : 'text-white hover:bg-purple-700' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Data Kuis
            </a>
        </nav>

        {{-- Admin Profile --}}
      <div class="px-3 py-4 border-t border-purple-700 relative">

    <!-- Button Admin -->
    <button onclick="toggleAdminMenu()"
        class="flex items-center gap-2 bg-purple-700 px-3 py-2.5 rounded-xl w-full">

        <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm"
             style="background-color: #E9D5FF; color: #6B2D8B;">A</div>

        <span class="text-white text-sm font-semibold">Admin</span>
    </button>

    <!-- Dropdown -->
    <div id="adminMenu" class="hidden absolute bottom-16 left-3 right-3 bg-white rounded-xl shadow-lg border p-2">

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="w-full text-left px-3 py-2 text-sm font-semibold text-red-500 hover:bg-red-50 rounded-lg">
                Keluar
            </button>
        </form>

    </div>
</div>

    </div>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="flex-1 bg-gray-50 p-8">
        @yield('content')
    </div>

</div>

@stack('scripts')

<script>
    function toggleAdminMenu() {
        const menu = document.getElementById('adminMenu');
        menu.classList.toggle('hidden');
    }

    document.addEventListener('click', function (e) {
        const menu = document.getElementById('adminMenu');
        const button = e.target.closest('button');

        if (menu && !e.target.closest('#adminMenu') && !button?.onclick) {
            menu.classList.add('hidden');
        }
    });
</script>

</body>
</html>
