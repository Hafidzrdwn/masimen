<?php

namespace App\Core;

class Session
{
  public static function init()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
  }

  public static function set(string $key, $value): void
  {
    $_SESSION[$key] = $value;
  }

  public static function get(string $key, $default = null)
  {
    return $_SESSION[$key] ?? $default;
  }

  public static function has(string $key): bool
  {
    return isset($_SESSION[$key]);
  }

  public static function forget(string $key): void
  {
    if (self::has($key)) {
      unset($_SESSION[$key]);
    }
  }

  public static function flash(string $key, $value): void
  {
    self::set($key, $value);
    // Hapus setelah diakses
    register_shutdown_function(function () use ($key) {
      self::forget($key);
    });
  }
}
