<?php

use App\Core\Config;
use App\Core\View;
use App\Core\Csrf;

// --- View & Layout Helpers ---

if (!function_exists('view')) {
  /**
   * Render sebuah view. Ini adalah shortcut utama untuk App\Core\View::render().
   */
  function view(string $view, array $data = [])
  {
    View::render($view, $data);
  }
}

if (!function_exists('extend')) {
  /**
   * Menentukan layout utama yang akan digunakan.
   */
  function extend(string $layout)
  {
    View::extend($layout);
  }
}

if (!function_exists('section')) {
  /**
   * Memulai sebuah section atau mendefinisikan section satu baris.
   */
  function section(string $name, ?string $content = null)
  {
    if ($content === null) {
      // Jika tidak ada konten, mulai output buffering (cara lama)
      View::startSection($name);
    } else {
      // Jika ada konten, langsung set nilainya
      View::setSection($name, $content);
    }
  }
}

if (!function_exists('endsection')) {
  /**
   * Mengakhiri section konten yang sedang aktif.
   */
  function endsection()
  {
    View::endSection();
  }
}

if (!function_exists('yield_section')) {
  /**
   * Menampilkan konten dari sebuah section.
   */
  function yield_section(string $name)
  {
    echo View::yield($name);
  }
}

if (!function_exists('include_view')) {
  /**
   * Menyertakan sebuah sub-view (partial).
   */
  function include_view(string $view, array $data = [])
  {
    View::render($view, $data);
  }
}


// --- URL & Asset Helpers ---

if (!function_exists('asset')) {
  /**
   * Membuat URL lengkap ke sebuah file aset (CSS, JS, gambar).
   */
  function asset(string $path): string
  {
    $baseUrl = rtrim(Config::get('app.url'), '/');
    return $baseUrl . '/public/assets/' . ltrim($path, '/');
  }
}

if (!function_exists('url')) {
  /**
   * Membuat URL lengkap ke sebuah path di dalam aplikasi.
   */
  function url(string $path): string
  {
    $baseUrl = rtrim(Config::get('app.url'), '/');
    return $baseUrl . '/' . ltrim($path, '/');
  }
}


// --- Form & Security Helpers ---

if (!function_exists('csrf_field')) {
  /**
   * Menghasilkan input field CSRF yang tersembunyi.
   */
  function csrf_field(): string
  {
    return Csrf::field();
  }
}

if (!function_exists('config')) {
  /**
   * Mengambil nilai dari file konfigurasi.
   */
  function config(string $key, $default = null)
  {
    return Config::get($key, $default);
  }
}
