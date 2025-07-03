<!doctype html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
  data-style="light">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>MASIMEN - @yield('title')</title>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon/favicon.ico') }}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="{{ asset('vendor/fonts/remixicon/remixicon.css') }}" />

  <!-- Menu waves for no-customizer fix -->
  <link rel="stylesheet" href="{{ asset('vendor/libs/node-waves/node-waves.css') }}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('vendor/css/core.css') }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
  <!-- <link rel="stylesheet" href="../assets/css/demo.css" /> -->

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="{{ asset('vendor/css/pages/page-auth.css') }}" />

  <!-- Helpers -->
  <script src="{{ asset('vendor/js/helpers.js') }}"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="{{ asset('js/config.js') }}"></script>
</head>

<body>
  <!-- Content -->
  <div class="position-relative">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-6 mx-4">

        @yield('content')
        <img
          src="{{ asset('img/illustrations/tree-3.png') }}"
          alt="auth-tree"
          class="authentication-image-object-left d-none d-lg-block" />
        <img
          src="{{ asset('img/illustrations/auth-basic-mask-light.png') }}"
          class="authentication-image d-none d-lg-block"
          height="172"
          alt="triangle-bg"
          data-app-light-img="illustrations/auth-basic-mask-light.png"
          data-app-dark-img="illustrations/auth-basic-mask-dark.png" />
        <img
          src="{{ asset('img/illustrations/tree.png') }}"
          alt="auth-tree"
          class="authentication-image-object-right d-none d-lg-block" />
      </div>
    </div>
  </div>

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('vendor/libs/node-waves/node-waves.js') }}"></script>
  <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('vendor/js/menu.js') }}"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="{{ asset('js/main.js') }}"></script>

  <!-- Page JS -->

  <!-- Place this tag before closing body tag for github widget button. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>