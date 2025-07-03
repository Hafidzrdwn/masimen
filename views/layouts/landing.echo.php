<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MASIMEN - Manajemen Sistem Informasi Klasemen</title>
  <meta name="description" content="Aplikasi web untuk mengelola klasemen pertandingan futsal dan sepak bola secara otomatis dan profesional">

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Fontawesome Icons -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <!-- AOS Animation -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>

<body>
  <!-- Navigation -->
  @include('includes.landing.navbar')

  <!-- CONTENT -->
  @yield('content')

  <!-- Footer -->
  @include('includes.landing.footer')

  <!-- Scroll to Top Button -->
  <button class="scroll-to-top" id="scrollToTop">
    <i class="fa-solid fa-arrow-up"></i>
  </button>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- AOS Animation -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <script src="{{ asset('js/landing.js') }}"></script>
</body>

</html>