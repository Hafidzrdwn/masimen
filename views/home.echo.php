@extends('layouts.landing')

@section('content')
<!-- Hero Section -->
<section id="home" class="hero-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 hero-content" data-aos="fade-up">
        <h1 class="hero-title">MASIMEN</h1>
        <p class="hero-subtitle">
          Aplikasi web untuk mengelola klasemen pertandingan futsal dan sepak bola secara otomatis dan profesional.
        </p>
        <div class="hero-buttons">
          <a href="#" class="btn-primary-custom">
            <i class="fa-solid fa-right-to-bracket me-2"></i>Gas Coba Sekarang
          </a>
        </div>
      </div>
      <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
        <img src="{{ asset('img/illustrations/hero-image.png') }}" alt="Hero Illustration" class="img-fluid hero-image">
      </div>
    </div>
  </div>
</section>

<!-- Features Section -->
<section id="features" class="section-padding">
  <div class="container">
    <h2 class="section-title" data-aos="fade-up">Fitur Unggulan</h2>
    <div class="row g-4">
      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fa-solid fa-folder-tree"></i>
          </div>
          <h3 class="feature-title">Multi-kompetisi</h3>
          <p class="feature-description">
            Kelola berbagai turnamen sekaligus dalam satu platform yang terintegrasi.
          </p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fa-solid fa-users"></i>
          </div>
          <h3 class="feature-title">Manajemen Tim & Pertandingan</h3>
          <p class="feature-description">
            Atur tim, jadwal pertandingan, dan hasil dengan mudah dan terorganisir.
          </p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fa-solid fa-ranking-star"></i>
          </div>
          <h3 class="feature-title">Klasemen Otomatis Real-time</h3>
          <p class="feature-description">
            Klasemen ter-update otomatis setiap kali hasil pertandingan diinput.
          </p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fa-solid fa-mobile-screen"></i>
          </div>
          <h3 class="feature-title">Tampilan Responsif</h3>
          <p class="feature-description">
            Akses dari desktop, tablet, atau smartphone dengan tampilan yang optimal.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- How It Works Section -->
<section id="how-it-works" class="how-it-works section-padding">
  <div class="container">
    <h2 class="section-title" data-aos="fade-up">Cara Kerja</h2>
    <div class="row g-4">
      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="step-card">
          <div class="step-number">1</div>
          <h4 class="step-title">Buat Kompetisi</h4>
          <p class="step-description">Buat turnamen baru dengan nama, format, dan aturan yang diinginkan.</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="step-card">
          <div class="step-number">2</div>
          <h4 class="step-title">Tambah Tim</h4>
          <p class="step-description">Daftarkan semua tim peserta yang akan mengikuti kompetisi.</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
        <div class="step-card">
          <div class="step-number">3</div>
          <h4 class="step-title">Input Hasil</h4>
          <p class="step-description">Masukkan hasil pertandingan setelah setiap match selesai.</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
        <div class="step-card">
          <div class="step-number">4</div>
          <h4 class="step-title">Klasemen Ter-update</h4>
          <p class="step-description">Klasemen otomatis ter-update dan siap untuk dipublikasikan.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- About Section -->
<section id="about" class="about-section section-padding">
  <div class="container">
    <div class="about-content" data-aos="fade-up">
      <h2 class="section-title">Tentang MASIMEN</h2>
      <p class="about-text">
        MASIMEN membantu panitia event futsal/sepak bola dalam mengelola kompetisi dengan cara modern dan efisien, tanpa ribet Excel.
        Sistem ini dirancang khusus untuk memudahkan penyelenggara turnamen antar kampus, antar RT/RW, antar kota,
        serta panitia event tahunan seperti Agustusan dalam mengelola klasemen secara profesional dan real-time.
      </p>
      <p class="about-text">
        Dengan MASIMEN, Anda tidak perlu lagi repot menghitung poin manual atau khawatir dengan kesalahan perhitungan.
        Semua proses otomatis dan transparan untuk semua peserta.
      </p>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section id="cta" class="cta-section section-padding">
  <div class="container">
    <div class="text-center" data-aos="fade-up">
      <h2 class="cta-title">Mulai kelola kompetisimu dengan MASIMEN sekarang</h2>
      <p class="cta-subtitle">
        Bergabunglah dengan ratusan penyelenggara turnamen yang sudah merasakan kemudahan MASIMEN
      </p>
      <div class="cta-buttons">
        <a href="#" class="btn-primary-custom me-3">
          <i class="fa-solid fa-rocket me-2"></i>Coba Sekarang
        </a>
        <a href="#" class="btn-outline-custom">
          <i class="fa-solid fa-comments me-2"></i>Hubungi Kami
        </a>
      </div>
    </div>
  </div>
</section>
@endsection