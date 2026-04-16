@push('styles')
<style>
  .beranda-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 48px;
    background: #FEE6F2;
    position: sticky;
    top: 0;
    z-index: 200;
    box-shadow: 0 2px 16px rgba(200,45,133,0.08);
  }
  .beranda-nav nav {
    display: flex;
    gap: 32px;
  }
  .beranda-nav nav a {
    position: relative;
    padding-bottom: 3px;
    color: #492F48;
    font-size: 14.5px;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.2s;
  }
  .beranda-nav nav a::after {
    content: '';
    position: absolute;
    left: 0; bottom: 0;
    width: 0; height: 2px;
    background: #C82D85;
    border-radius: 9px;
    transition: width 0.22s;
  }
  .beranda-nav nav a:hover { color: #C82D85; }
  .beranda-nav nav a:hover::after,
  .beranda-nav nav a.nav-active::after { width: 100%; }
  .beranda-nav nav a.nav-active { color: #C82D85; }

  .btn-profile {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 18px 8px 10px;
    border-radius: 50px;
    background: #fff;
    border: 1.5px solid #F2B8D8;
    color: #742958;
    font-weight: 700;
    font-size: 14px;
    box-shadow: 0 2px 10px rgba(200,45,133,0.12);
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
  }
  .btn-profile:hover {
    background: #FEE6F2;
    border-color: #C82D85;
    color: #C82D85;
  }
  .btn-profile .avatar {
    width: 32px; height: 32px;
    border-radius: 50%;
    background: linear-gradient(135deg, #F7DAED, #C82D85);
    display: flex; align-items: center; justify-content: center;
    font-size: 13px;
    color: #fff;
    font-weight: 800;
  }

  /* Mobile */
  .nav-hamburger {
    display: none;
    flex-direction: column;
    gap: 5px;
    cursor: pointer;
    padding: 4px;
  }
  .nav-hamburger span {
    display: block;
    width: 24px; height: 2.5px;
    background: #742958;
    border-radius: 9px;
    transition: all 0.3s;
  }
  .nav-mobile-menu {
    display: none;
    flex-direction: column;
    gap: 4px;
    background: #FEE6F2;
    padding: 12px 20px 16px;
    border-top: 1px solid #F2B8D8;
  }
  .nav-mobile-menu a {
    padding: 10px 8px;
    color: #492F48;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    border-radius: 10px;
    transition: all 0.2s;
  }
  .nav-mobile-menu a:hover,
  .nav-mobile-menu a.nav-active {
    color: #C82D85;
    background: #F7DAED;
    padding-left: 14px;
  }
  .nav-mobile-menu .profile-link-mobile {
    margin-top: 8px;
    border-top: 1px solid #F2B8D8;
    padding-top: 12px;
  }

  @media (max-width: 900px) {
    .beranda-nav {
      padding: 14px 20px;
      flex-wrap: wrap;
    }
    .beranda-nav nav { display: none; }
    .btn-profile { display: none; }
    .nav-hamburger { display: flex; }
    .nav-mobile-menu.open { display: flex; }
  }
</style>
@endpush

<header class="beranda-nav">
  <!-- Logo -->
  <a href="{{ route('beranda') }}">
    <img src="{{ asset('assets/logo.png') }}" style="width:120px;" alt="SignLearn">
  </a>

  <!-- Desktop Nav -->
  <nav>
    <a href="{{ route('beranda') }}"
      class="{{ request()->routeIs('beranda') ? 'nav-active' : '' }}">
      Beranda
    </a>
    <a href="{{ route('pembelajaran') }}"
      class="{{ request()->routeIs('pembelajaran*') ? 'nav-active' : '' }}">
      Pembelajaran
    </a>
    <a href="{{ route('latihan') }}"
      class="{{ request()->routeIs('latihan*') ? 'nav-active' : '' }}">
      Latihan
    </a>
    <a href="{{ route('histori') }}"
      class="{{ request()->routeIs('histori*') ? 'nav-active' : '' }}">
      Histori
    </a>
  </nav>

  <!-- Desktop Profile Button -->
  <a href="{{ route('profile') }}" class="btn-profile">
    <div class="avatar">
      {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
    </div>
    {{ auth()->user()->name ?? 'User' }}
  </a>

  <!-- Hamburger (Mobile) -->
  <div class="nav-hamburger" onclick="toggleMobileNav()" id="nav-hamburger">
    <span></span>
    <span></span>
    <span></span>
  </div>
</header>

<!-- Mobile Menu -->
<div class="nav-mobile-menu" id="nav-mobile-menu">
  <a href="{{ route('beranda') }}"
    class="{{ request()->routeIs('beranda') ? 'nav-active' : '' }}">
    Beranda
  </a>
  <a href="{{ route('pembelajaran') }}"
    class="{{ request()->routeIs('pembelajaran*') ? 'nav-active' : '' }}">
    Pembelajaran
  </a>
  <a href="{{ route('latihan') }}"
    class="{{ request()->routeIs('latihan*') ? 'nav-active' : '' }}">
    Latihan
  </a>
  <a href="{{ route('histori') }}"
    class="{{ request()->routeIs('histori*') ? 'nav-active' : '' }}">
    Histori
  </a>
  <div class="profile-link-mobile">
    <a href="{{ route('profile') }}" class="btn-profile" style="display:inline-flex;">
      <div class="avatar">
        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
      </div>
      {{ auth()->user()->name ?? 'User' }}
    </a>
  </div>
</div>

@push('scripts')
<script>
  function toggleMobileNav() {
    const menu = document.getElementById('nav-mobile-menu');
    menu.classList.toggle('open');
  }
  // Tutup menu kalau klik di luar
  document.addEventListener('click', function(e) {
    const menu = document.getElementById('nav-mobile-menu');
    const hamburger = document.getElementById('nav-hamburger');
    if (!menu.contains(e.target) && !hamburger.contains(e.target)) {
      menu.classList.remove('open');
    }
  });
</script>
@endpush