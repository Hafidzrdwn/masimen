<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MASIMEN - Manajemen Sistem Informasi Klasemen</title>
  <meta name="description" content="Aplikasi web untuk mengelola klasemen pertandingan futsal dan sepak bola secara otomatis dan profesional">

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <!-- AOS Animation -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?php echo htmlspecialchars(asset('css/landing.css'), ENT_QUOTES, 'UTF-8'); ?>">
</head>

<body>
  <!-- Navigation -->
  <?php include_view('includes.landing.navbar'); ?>

  <!-- CONTENT -->
  <?php yield_section('content'); ?>

  <!-- Footer -->
  <?php include_view('includes.landing.footer'); ?>

  <!-- Scroll to Top Button -->
  <button class="scroll-to-top" id="scrollToTop">
    <i class="bi bi-arrow-up"></i>
  </button>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- AOS Animation -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <script src="<?php echo htmlspecialchars(asset('js/landing.js'), ENT_QUOTES, 'UTF-8'); ?>"></script>
</body>

</html>