<?php

namespace App\Core;

class Config
{
  private static $config = [];

  public static function load(): void
  {
    $envPath = __DIR__ . '/../../.env';
    if (!file_exists($envPath)) {
      die('.env file not found. Please create one.');
    }

    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
      if (strpos(trim($line), '#') === 0) continue;
      list($key, $value) = explode('=', $line, 2);
      $_ENV[trim($key)] = trim($value);
    }

    $basePath = str_replace('/public', '', dirname($_SERVER['SCRIPT_NAME']));

    // Muat konfigurasi aplikasi
    self::$config = [
      'app' => [
        'name' => $_ENV['APP_NAME'] ?? 'MASIMEN',
        'env' => $_ENV['APP_ENV'] ?? 'development',
        'debug' => ($_ENV['APP_ENV'] ?? 'development') === 'development',
        'url' => $_ENV['APP_URL'] ?? 'http://localhost',
        'base_path' => $basePath === '/' ? '' : $basePath,
      ],
      'db' => [
        'host' => $_ENV['DB_HOST'] ?? 'localhost',
        'name' => $_ENV['DB_NAME'] ?? '',
        'user' => $_ENV['DB_USER'] ?? 'root',
        'pass' => $_ENV['DB_PASS'] ?? '',
      ],
    ];
  }

  public static function get(string $key, $default = null)
  {
    $keys = explode('.', $key);
    $value = self::$config;
    foreach ($keys as $k) {
      if (!isset($value[$k])) {
        return $default;
      }
      $value = $value[$k];
    }
    return $value;
  }
}
