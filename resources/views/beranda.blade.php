@extends('layout.app')
@section('title', 'SignLearn - Beranda')
@section('content')
@include('layout.navbar')

@push('styles')
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap');

  * { font-family: 'Poppins', sans-serif; }

  @keyframes heroFloat {
    0%,100% { transform: translateY(0); }
    50% { transform: translateY(-12px); }
  }
  @keyframes fadeUp {
    from { opacity:0; transform:translateY(28px); }
    to { opacity:1; transform:translateY(0); }
  }
  @keyframes progressFill {
    from { width: 0%; }
    to { width: 46%; }
  }
  @keyframes pulse-glow {
    0%,100% { box-shadow: 0 0 0 0 rgba(200,45,133,0.3); }
    50% { box-shadow: 0 0 0 10px rgba(200,45,133,0); }
  }
  @keyframes slideInLeft {
    from { opacity:0; transform: translateX(-30px); }
    to { opacity:1; transform: translateX(0); }
  }
  @keyframes slideInRight {
    from { opacity:0; transform: translateX(30px); }
    to { opacity:1; transform: translateX(0); }
  }
  @keyframes fadeIn {
    from { opacity:0; }
    to { opacity:1; }
  }

  .beranda-wrapper {
    background: linear-gradient(160deg, #FFE8F4 0%, #FFF0F8 40%, #FDE6F2 100%);
    min-height: 100vh;
  }

  /* HERO */
  .hero-section {
    display: grid;
    grid-template-columns: 1.1fr 0.9fr;
    align-items: center;
    gap: 32px;
    padding: 44px 48px 36px;
    animation: fadeIn 0.6s ease;
  }
  .hero-text h1 {
    font-size: clamp(2rem, 3.8vw, 3.4rem);
    font-weight: 1000;
    line-height: 1.25;
    color: #492F48;
    margin-bottom: 14px;
    animation: slideInLeft 0.7s ease;
  }
  .hero-text h1 .pink { color: #C82D85; }
  .hero-text p {
    font-size: 1rem;
    color: #492F48;
    line-height: 1.75;
    margin-bottom: 26px;
    max-width: 460px;
    animation: slideInLeft 0.9s ease;
  }
  .hero-btns {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    animation: slideInLeft 1.1s ease;
  }
  .btn-outline-pink {
    padding: 11px 26px;
    border-radius: 12px;
    border: 2px solid #C82D85;
    color: #C82D85;
    background: #fff;
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
  }
  .btn-outline-pink:hover { background: #FEE6F2; }
  .btn-solid-pink {
    padding: 11px 26px;
    border-radius: 12px;
    background: #C82D85;
    color: #fff;
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    box-shadow: 0 8px 24px rgba(200,45,133,0.35);
    transition: all 0.2s;
    text-decoration: none;
  }
  .btn-solid-pink:hover {
    background: #951651;
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(200,45,133,0.45);
  }
  .hero-img-wrap {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    min-height: 300px;
    animation: slideInRight 0.7s ease;
  }
  .hero-img-wrap .glow {
    position: absolute;
    width: 280px; height: 280px;
    border-radius: 50%;
    background: radial-gradient(circle, #F7DAED 0%, transparent 70%);
  }
  .hero-img-wrap img {
    position: relative;
    max-width: 380px;
    width: 100%;
    drop-shadow: 0 24px 40px rgba(200,45,133,0.2);
    animation: heroFloat 5s ease-in-out infinite;
    filter: drop-shadow(0 18px 30px rgba(200,45,133,0.18));
  }

  /* AKSES CEPAT */
  .section-title {
    font-size: 1.35rem;
    font-weight: 800;
    color: #2D1A2E;
    margin-bottom: 18px;
  }
  .akses-cepat {
    padding: 0 48px 32px;
    animation: fadeUp 0.7s ease 0.2s both;
  }
  .akses-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
  }
  .akses-card {
    border-radius: 20px;
    padding: 22px 22px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 8px 28px rgba(180,80,160,0.22);
    transition: all 0.22s;
    cursor: pointer;
    text-decoration: none;
    position: relative;
    overflow: hidden;
  }
  .akses-card-1 { background: linear-gradient(135deg, #E4ACDB 50%, #BA76AE 100%); }
  .akses-card-2 { background: linear-gradient(135deg, #F1A2D0 53%, #FE6AC0 100%); }
  .akses-card-3 { background: linear-gradient(135deg, #FD95CE 49%, #B45087 100%); }
  .akses-card::before {
    content: '';
    position: absolute;
    right: -20px; top: -20px;
    width: 80px; height: 80px;
    border-radius: 50%;
    background: rgba(255,255,255,0.08);
  }
  .akses-card:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 16px 40px rgba(200,45,133,0.45);
  }
  .akses-card-left h3 {
    font-size: 1rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 14px;
    line-height: 1.3;
  }
  .akses-card .btn-mulai {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 6px 16px;
    border-radius: 50px;
    background: rgba(255,255,255,0.22);
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    border: 1.5px solid rgba(255,255,255,0.35);
    transition: background 0.2s;
  }
  .akses-card .btn-mulai:hover { background: rgba(255,255,255,0.35); }
  .akses-card-img {
    width: 75px; height: 75px;
    object-fit: contain;
    filter: drop-shadow(0 4px 8px rgba(0,0,0,0.12));
    flex-shrink: 0;
  }

  /* KEMAJUAN BELAJAR */
  .kemajuan-section {
    padding: 0 48px 32px;
    animation: fadeUp 0.7s ease 0.35s both;
  }
  .kemajuan-card {
    background: #fff;
    border-radius: 22px;
    padding: 30px 34px;
    box-shadow: 0 6px 28px rgba(200,45,133,0.10);
    border: 1.5px solid #F7DAED;
  }
  .kemajuan-card h2 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.15rem;
    font-weight: 800;
    color: #2D1A2E;
    margin-bottom: 6px;
  }
  .kemajuan-card .sub {
    font-size: 0.93rem;
    color: #7A4B78;
    margin-bottom: 18px;
  }
  .progress-bar-bg {
    width: 100%;
    height: 14px;
    background: #F7DAED;
    border-radius: 50px;
    overflow: hidden;
    margin-bottom: 8px;
  }
  .progress-bar-fill {
    height: 100%;
    border-radius: 50px;
    background: linear-gradient(90deg, #E8409A, #C82D85);
    width: 46%;
    animation: progressFill 1.2s ease 0.8s both;
    box-shadow: 0 2px 10px rgba(200,45,133,0.4);
  }
  .progress-label {
    font-size: 0.85rem;
    color: #C82D85;
    font-weight: 700;
  }

  /* ===== FAQ ===== */
  .faq-section {
    padding: 0 48px 36px;
    animation: fadeUp 0.7s ease 0.5s both;
  }
  .faq-inner {
    background: #fff;
    border-radius: 22px;
    padding: 30px 30px 24px;
    box-shadow: 0 6px 22px rgba(200,45,133,0.10);
    border: 1.5px solid #F7DAED;
    transition: box-shadow 0.3s, transform 0.3s, border-color 0.3s;
  }
  .faq-inner:hover {
    box-shadow: 0 18px 48px rgba(250,150,200,0.65);
    border-color: #FA96C8;
    transform: translateY(-4px);
  }
  .faq-cards {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 22px;
  }
  .faq-card {
    border-radius: 16px;
    padding: 22px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    box-shadow: 0 4px 16px rgba(200,45,133,0.15);
    transition: all 0.2s;
    cursor: pointer;
    border: 1.5px solid rgba(255,255,255,0.4);
  }
  .faq-card-1 { background: linear-gradient(135deg, #E4ACDB 50%, #BA76AE 100%); }
  .faq-card-2 { background: linear-gradient(135deg, #F1A2D0 53%, #FE6AC0 100%); }
  .faq-card:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(200,45,133,0.25); }
  /* Teks FAQ: 0.95rem + 700 + putih */
  .faq-card p {
    font-size: 0.95rem;
    font-weight: 700;
    color: #fff;
    text-shadow: 0 1px 4px rgba(0,0,0,0.12);
    line-height: 1.45;
  }
  .faq-card-icon {
    width: 60px; height: 60px;
    object-fit: contain;
    filter: drop-shadow(0 3px 6px rgba(0,0,0,0.12));
    flex-shrink: 0;
    background: rgba(255,255,255,0.25);
    border-radius: 10px;
    padding: 5px;
    border: 1.5px dashed rgba(255,255,255,0.5);
  }
  .btn-klik-disini {
    display: block;
    width: fit-content;
    margin: 0 auto;
    padding: 13px 48px;
    border-radius: 50px;
    background: #C82D85;
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 8px 24px rgba(200,45,133,0.35);
    transition: all 0.2s;
    animation: pulse-glow 2.5s ease-in-out infinite;
  }
  .btn-klik-disini:hover {
    background: #951651;
    transform: translateY(-2px);
    box-shadow: 0 14px 36px rgba(200,45,133,0.5);
  }

  @media (max-width: 900px) {
    .beranda-nav { padding: 14px 20px; }
    .hero-section { grid-template-columns: 1fr; padding: 30px 20px; }
    .hero-img-wrap { min-height: 220px; }
    .akses-cepat, .kemajuan-section, .faq-section { padding-left: 20px; padding-right: 20px; }
    .akses-grid { grid-template-columns: 1fr; }
    .faq-cards { grid-template-columns: 1fr; }
    .footer-grid { grid-template-columns: 1fr 1fr; }
    .beranda-footer { padding: 30px 20px 16px; }
  }
</style>
@endpush

<div class="beranda-wrapper">

  <!-- HERO -->
  <section class="hero-section">
    <div class="hero-text">
      <h1>
        Selamat Datang <span class="pink">{{ explode(' ', auth()->user()->name ?? 'Ara')[0] }}!</span><br>
        Mari Belajar Bahasa Isyarat<br>
        Secara Mandiri
      </h1>
      <p>SIGNLEARN siap membantu kamu belajar dan melatih bahasa isyarat dengan mudah dan menyenangkan.</p>
      <div class="hero-btns">
        <a href="{{ route('pembelajaran') }}" class="btn-outline-pink">Mulai Belajar</a>
        <a href="{{ route('latihan') }}" class="btn-solid-pink">Mulai Latihan</a>
      </div>
    </div>
    <div class="hero-img-wrap">
      <div class="glow"></div>
      <img src="{{ asset('assets/hero-illustration.png') }}" alt="Hero Illustration">
    </div>
  </section>

  <!-- AKSES CEPAT -->
  <section class="akses-cepat">
    <p class="section-title">Akses Cepat</p>
    <div class="akses-grid">
      <!-- Belajar SIBI -->
      <a href="{{ route('pembelajaran.sibi') }}" class="akses-card akses-card-1">
        <div class="akses-card-left">
          <h3>Belajar<br>SIBI</h3>
          <span class="btn-mulai">Mulai &rsaquo;</span>
        </div>
        <img src="{{ asset('assets/quick-sibi.png') }}" alt="Belajar SIBI" class="akses-card-img">
      </a>
      <!-- Belajar BISINDO -->
      <a href="{{ route('pembelajaran.bisindo') }}" class="akses-card akses-card-2">
        <div class="akses-card-left">
          <h3>Belajar<br>Bisindo</h3>
          <span class="btn-mulai">Mulai &rsaquo;</span>
        </div>
        <img src="{{ asset('assets/quick-bisindo.png') }}" alt="Belajar Bisindo" class="akses-card-img">
      </a>
      <!-- Latihan Bahasa Isyarat -->
      <a href="{{ route('latihan') }}" class="akses-card akses-card-3">
        <div class="akses-card-left">
          <h3>Latihan Bahasa<br>Isyarat</h3>
          <span class="btn-mulai">Mulai &rsaquo;</span>
        </div>
        <img src="{{ asset('assets/quick-latihan.png') }}" alt="Latihan Isyarat" class="akses-card-img">
      </a>
    </div>
  </section>

  <!-- KEMAJUAN BELAJAR -->
  <section class="kemajuan-section">
    <p class="section-title">Kemajuan Belajar</p>
    <div class="kemajuan-card">
      <h2>Kemajuan Belajar</h2>
      @php
        $mastered = $userProgress->mastered ?? 12;
        $total = $userProgress->total ?? 26;
        $pct = round(($mastered / $total) * 100);
      @endphp
      <p class="sub">Kamu sudah menguasai {{ $mastered }}/{{ $total }} huruf ({{ $pct }}%)</p>
      <div class="progress-bar-bg">
        <div class="progress-bar-fill" style="width: {{ $pct }}%;"></div>
      </div>
      <p class="progress-label">{{ $pct }}% selesai</p>
    </div>
  </section>

  <!-- FAQ DAN CARA PENGGUNAAN -->
  <section class="faq-section">
    <p class="section-title">FAQ dan Cara Penggunaan</p>
    <div class="faq-inner">
      <div class="faq-cards">
        <div class="faq-card faq-card-1">
          <p>Ada pertanyaan?<br>Temukan jawabnnya disini.</p>
          <img src="{{ asset('assets/icon-faq.png') }}" alt="FAQ" class="faq-card-icon">
        </div>
        <div class="faq-card faq-card-2">
          <p>Panduan Cara penggunaan aplikasi SIGNLEARN</p>
          <img src="{{ asset('assets/icon-panduan.png') }}" alt="Panduan" class="faq-card-icon">
        </div>
      </div>
      <a href="{{ route('faq') }}" class="btn-klik-disini">Klik Disini</a>
    </div>
  </section>


</div>
@endsection