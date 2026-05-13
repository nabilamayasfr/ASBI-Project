@extends('layout.app')

@section('title', 'SignLearn - Beranda')

@section('content')

@include('layout.navbar')

<div class="min-h-screen bg-gradient-to-br from-pink-100 via-pink-50 to-pink-100 font-[Poppins]">

  <!-- HERO -->
  <section class="grid md:grid-cols-2 gap-8 items-center px-6 md:px-12 py-10 animate-fade-in">

    <!-- TEXT -->
    <div>
      <h1 class="text-3xl md:text-5xl font-extrabold text-[#492F48] leading-tight mb-4">
        Selamat Datang
        <span class="text-pink-600">
          {{ explode(' ', auth()->user()->name ?? 'Ara')[0] }}!
        </span><br>
        Mari Belajar Bahasa Isyarat<br>
        Secara Mandiri
      </h1>

      <p class="text-[#492F48] leading-relaxed mb-6 max-w-md">
        SIGNLEARN siap membantu kamu belajar dan melatih bahasa isyarat dengan mudah dan menyenangkan.
      </p>

      <div class="flex flex-wrap gap-3">
        <a href="{{ route('pembelajaran.index') }}"
           class="px-6 py-2 rounded-xl border-2 border-pink-600 text-pink-600 font-bold bg-white hover:bg-pink-100 transition">
           Mulai Belajar
        </a>

        <a href="{{ route('latihan') }}"
           class="px-6 py-2 rounded-xl bg-pink-600 text-white font-bold shadow-lg hover:bg-pink-800 hover:-translate-y-1 transition">
           Mulai Latihan
        </a>
      </div>
    </div>

    <!-- IMAGE -->
 <div class="flex justify-center items-center relative min-h-[300px]">

    <div class="absolute w-[280px] h-[280px] rounded-full
    bg-[radial-gradient(circle,_#F7DAED_0%,_transparent_70%)]">
    </div>

    <img src="{{ asset('assets/hero-illustration.webp') }}"
         class="relative w-full max-w-[380px]
         drop-shadow-[0_18px_30px_rgba(200,45,133,0.18)]
         animate-[heroFloat_5s_ease-in-out_infinite]">
</div>
  </section>

  <!-- AKSES CEPAT -->
  <section class="px-6 md:px-12 pb-8">
    <p class="text-xl font-extrabold text-[#2D1A2E] mb-4">
      Akses Cepat
    </p>

    <div class="grid md:grid-cols-3 gap-4">

      <!-- CARD -->
      <a href="{{ route('pembelajaran.index') }}"
          class="flex justify-between items-center p-5 rounded-2xl text-white shadow-lg hover:scale-105 hover:shadow-xl transition bg-[linear-gradient(135deg,_#E4ACDB_50%,_#BA76AE_100%)]">

        <div>
          <h3 class="font-extrabold mb-3">
            Belajar<br>SIBI
          </h3>

          <span class="px-4 py-1 text-sm rounded-full bg-white/30 border border-white/40">
            Mulai ›
          </span>
        </div>

        <img src="{{ asset('assets/quick-sibi.png') }}"
             class="w-16"
             alt="SIBI">
      </a>

      <a href="{{ route('pembelajaran.index') }}"
         class="flex justify-between items-center p-5 rounded-2xl text-white shadow-lg hover:scale-105 hover:shadow-xl transition bg-gradient-to-br from-pink-300 to-pink-600">

        <div>
          <h3 class="font-extrabold mb-3">
            Belajar<br>Bisindo
          </h3>

          <span class="px-4 py-1 text-sm rounded-full bg-white/30 border border-white/40">
            Mulai ›
          </span>
        </div>

        <img src="{{ asset('assets/quick-bisindo.png') }}"
             class="w-16"
             alt="Bisindo">
      </a>

      <a href="{{ route('latihan') }}"
         class="flex justify-between items-center p-5 rounded-2xl text-white shadow-lg hover:scale-105 hover:shadow-xl transition bg-gradient-to-br from-pink-400 to-pink-700">

        <div>
          <h3 class="font-extrabold mb-3">
            Latihan Bahasa<br>Isyarat
          </h3>

          <span class="px-4 py-1 text-sm rounded-full bg-white/30 border border-white/40">
            Mulai ›
          </span>
        </div>

        <img src="{{ asset('assets/quick-latihan.png') }}"
             class="w-16"
             alt="Latihan">
      </a>

    </div>
  </section>

  <!-- KEMAJUAN -->
  <section class="px-6 md:px-12 pb-8">

    <p class="text-xl font-extrabold text-[#2D1A2E] mb-4">
      Kemajuan Belajar
    </p>

    <div class="bg-white rounded-2xl p-6 shadow-md border border-pink-100">

      <h2 class="font-extrabold text-lg mb-1">
        Kemajuan Belajar
      </h2>

      @php
        $mastered = $userProgress->mastered ?? 12;
        $total = $userProgress->total ?? 26;
        $pct = round(($mastered / $total) * 100);
      @endphp

      <p class="text-sm text-black mb-4">
        Kamu sudah menguasai {{ $mastered }}/{{ $total }} huruf ({{ $pct }}%)
      </p>

      <div class="w-full h-3 bg-pink-100 rounded-full overflow-hidden mb-2">
        <div class="h-full bg-gradient-to-r from-pink-500 to-pink-700"
             style="width: {{ $pct }}%">
        </div>
      </div>

      <p class="text-sm font-bold text-pink-600">
        {{ $pct }}% selesai
      </p>

    </div>
  </section>

  <!-- FAQ -->
  <section class="px-6 md:px-12 pb-10">

    <p class="text-xl font-extrabold text-[#2D1A2E] mb-4">
      FAQ dan Cara Penggunaan
    </p>

    <div class="bg-white rounded-2xl p-6 shadow-md border border-pink-100 hover:shadow-xl transition">

      <div class="grid md:grid-cols-2 gap-4 mb-6">

        <div class="flex justify-between items-center gap-3 p-[22px_18px] rounded-2xl text-white
bg-[linear-gradient(135deg,_#E4ACDB_50%,_#BA76AE_100%)]
shadow-[0_4px_16px_rgba(200,45,133,0.15)]
border-[1.5px] border-[rgba(255,255,255,0.4)]
cursor-pointer transition-all duration-200
hover:-translate-y-[3px]
hover:shadow-[0_10px_28px_rgba(200,45,133,0.25)]">

    <p class="text-[0.95rem] font-bold text-white leading-[1.45] drop-shadow-sm">
        Ada pertanyaan?<br>Temukan jawabannya disini.
    </p>

    <img src="{{ asset('assets/icon-faq.png') }}"
         class="w-[60px] h-[60px] object-contain flex-shrink-0
         bg-white/25 rounded-[10px] p-[5px]
         border-[1.5px] border-dashed border-white/50
         drop-shadow-[0_3px_6px_rgba(0,0,0,0.12)]">
</div>


<div class="flex justify-between items-center gap-3 p-[22px_18px] rounded-2xl text-white
bg-[linear-gradient(135deg,_#F1A2D0_53%,_#FE6AC0_100%)]
shadow-[0_4px_16px_rgba(200,45,133,0.15)]
border-[1.5px] border-[rgba(255,255,255,0.4)]
cursor-pointer transition-all duration-200
hover:-translate-y-[3px]
hover:shadow-[0_10px_28px_rgba(200,45,133,0.25)]">

    <p class="text-[0.95rem] font-bold text-white leading-[1.45] drop-shadow-sm">
        Panduan Cara penggunaan aplikasi SIGNLEARN
    </p>

    <img src="{{ asset('assets/icon-panduan.png') }}"
         class="w-[60px] h-[60px] object-contain flex-shrink-0
         bg-white/25 rounded-[10px] p-[5px]
         border-[1.5px] border-dashed border-white/50
         drop-shadow-[0_3px_6px_rgba(0,0,0,0.12)]">
</div>

      </div>

      <a href="{{ route('faq') }}"
         class="block mx-auto w-fit px-10 py-3 rounded-full bg-pink-600 text-white font-semibold shadow-lg hover:bg-pink-800 hover:-translate-y-1 transition">
         Klik Disini
      </a>

    </div>
  </section>

</div>

@include('layout.footer')

@endsection
