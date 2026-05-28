{{-- resources/views/layout/footer.blade.php --}}

<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap');

  .signlearn-footer {
    font-family: 'Poppins', sans-serif;
    background: #5B1F6E;
    padding: 52px 80px 0;
  }

  .footer-grid {
    display: grid;
    grid-template-columns: 1.6fr 0.9fr 1.4fr 1fr;
    gap: 48px;
    padding-bottom: 44px;
  }

  /* Brand */
  .footer-brand {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }
  .footer-brand-top {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .footer-brand-top img {
    width: 110px;
    height: auto;
    object-fit: contain;
  }
  .footer-brand-desc {
    font-size: 1.13rem;
    font-weight: 600;
    color: #fff;
    line-height: 1.6;
    max-width: 240px;
  }

  /* Nav */
  .footer-col h4 {
    font-size: 1rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 16px;
  }
  .footer-col ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  .footer-col ul li a {
    color: rgba(255,255,255,0.85);
    text-decoration: none;
    font-size: 0.93rem;
    font-weight: 500;
    transition: color 0.2s;
  }
  .footer-col ul li a:hover {
    color: #F7A8D8;
  }

  /* Hubungi Kami */
  .footer-contact-list {
    display: flex;
    flex-direction: column;
    gap: 13px;
  }
  .footer-contact-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    color: rgba(255,255,255,0.88);
    font-size: 0.9rem;
    font-weight: 500;
    line-height: 1.5;
  }
  .footer-contact-item svg {
    flex-shrink: 0;
    margin-top: 2px;
  }

  /* Ikuti Kami */
  .footer-social-list {
    display: flex;
    flex-direction: column;
    gap: 13px;
  }
  .footer-social-item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: rgba(255,255,255,0.88);
    font-size: 0.9rem;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.2s;
  }
  .footer-social-item:hover { color: #F7A8D8; }
  .footer-social-item svg {
    flex-shrink: 0;
  }

  /* Bottom bar */
  .footer-bottom {
    background: #F7DAED;
    text-align: center;
    padding: 15px 80px;
    font-size: 0.9rem;
    color: #5B1F6E;
    font-weight: 600;
    font-family: 'Poppins', sans-serif;
    margin: 0 -80px;
  }

  @media (max-width: 1200px) {
    .signlearn-footer {
      padding: 44px 48px 0;
    }
    .footer-bottom {
      margin: 0 -48px;
      padding-left: 48px;
      padding-right: 48px;
    }
    .footer-grid {
      gap: 32px;
    }
  }

  @media (max-width: 900px) {
    .signlearn-footer {
      padding: 36px 32px 0;
    }
    .footer-grid {
      grid-template-columns: 1fr 1fr;
      gap: 28px;
    }
    .footer-bottom {
      margin: 0 -32px;
      padding-left: 32px;
      padding-right: 32px;
    }
  }

  @media (max-width: 540px) {
    .signlearn-footer {
      padding: 30px 20px 0;
    }
    .footer-grid {
      grid-template-columns: 1fr;
      gap: 24px;
    }
    .footer-bottom {
      margin: 0 -20px;
      padding-left: 20px;
      padding-right: 20px;
    }
    .footer-brand-desc {
      max-width: 100%;
    }
  }
</style>

<footer class="signlearn-footer">
  <div class="footer-grid">

    {{-- Brand --}}
    <div class="footer-brand">
      <div class="footer-brand-top">
        <img src="{{ asset('assets/logo.png') }}" alt="SignLearn Logo">
      </div>
      <p class="footer-brand-desc">Belajar Bahasa Isyarat dengan AI Secara Mandiri</p>
    </div>

    {{-- Navigasi --}}
    <div class="footer-col">
      <h4>Navigasi</h4>
      <ul>
        <li><a href="{{ route('beranda') }}">Beranda</a></li>
        <li><a href="{{ route('pembelajaran') }}">Pembelajaran</a></li>
        <li><a href="{{ route('latihan') }}">Latihan</a></li>
        <li><a href="{{ route('faq') }}">FAQ</a></li>
      </ul>
    </div>

    {{-- Hubungi Kami --}}
    <div class="footer-col">
      <h4>Hubungi Kami</h4>
      <div class="footer-contact-list">
        <div class="footer-contact-item">
          <svg width="17" height="17" fill="none" viewBox="0 0 24 24">
            <path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2a1 1 0 011.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 011 1V20a1 1 0 01-1 1C10.61 21 3 13.39 3 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.25.2 2.45.57 3.58a1 1 0 01-.25 1.01l-2.2 2.2z" fill="#fff"/>
          </svg>
          +62 81234567
        </div>
        <div class="footer-contact-item">
          <svg width="17" height="17" fill="none" viewBox="0 0 24 24">
            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5A2.5 2.5 0 1112 6.5a2.5 2.5 0 010 5z" fill="#fff"/>
          </svg>
          Politeknik Negri Batam
        </div>
        <div class="footer-contact-item">
          <svg width="17" height="17" fill="none" viewBox="0 0 24 24">
            <path d="M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" fill="#fff"/>
          </svg>
          signlearn@gmail.com
        </div>
      </div>
    </div>

    {{-- Ikuti Kami --}}
    <div class="footer-col">
      <h4>Ikuti Kami</h4>
      <div class="footer-social-list">
        <a href="#" class="footer-social-item">
          <svg width="17" height="17" fill="none" viewBox="0 0 24 24">
            <path d="M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" fill="currentColor"/>
          </svg>
          Gmail
        </a>
        <a href="#" class="footer-social-item">
          <svg width="17" height="17" fill="none" viewBox="0 0 24 24">
            <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke="currentColor" stroke-width="2"/>
            <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2"/>
            <circle cx="17.5" cy="6.5" r="1.5" fill="currentColor"/>
          </svg>
          Instagram
        </a>
        <a href="#" class="footer-social-item">
          <svg width="17" height="17" fill="none" viewBox="0 0 24 24">
            <path d="M21.8 8s-.2-1.4-.8-2c-.8-.8-1.6-.8-2-.9C16.8 5 12 5 12 5s-4.8 0-7 .1c-.4.1-1.2.1-2 .9-.6.6-.8 2-.8 2S2 9.6 2 11.2v1.5c0 1.6.2 3.2.2 3.2s.2 1.4.8 2c.8.8 1.8.8 2.3.9C6.8 19 12 19 12 19s4.8 0 7-.2c.4-.1 1.2-.1 2-.9.6-.6.8-2 .8-2s.2-1.6.2-3.2v-1.5C22 9.6 21.8 8 21.8 8zM10 15V9l6 3-6 3z" fill="currentColor"/>
          </svg>
          Youtube
        </a>
      </div>
    </div>

  </div>

  <div class="footer-bottom">
    &copy;2026 SIGNLEARN, All Rights Reserved
  </div>
</footer>