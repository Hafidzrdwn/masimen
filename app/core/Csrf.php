<?php

namespace App\Core;

class Csrf
{
  private static $tokenKey = 'csrf_token';

  public static function generateToken(): string
  {
    if (empty($_SESSION[self::$tokenKey])) {
      $_SESSION[self::$tokenKey] = bin2hex(random_bytes(32));
    }
    return $_SESSION[self::$tokenKey];
  }

  public static function field(): string
  {
    $token = self::generateToken();
    return '<input type="hidden" name="' . self::$tokenKey . '" value="' . $token . '">';
  }

  public static function verify(string $token): bool
  {
    $sessionToken = $_SESSION[self::$tokenKey] ?? null;
    if (!$sessionToken || !$token) {
      return false;
    }
    return hash_equals($sessionToken, $token);
  }

  public static function check(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $postedToken = $_POST[self::$tokenKey] ?? '';
      if (!self::verify($postedToken)) {
        throw new \Exception('Invalid CSRF Token.');
      }
    }
  }
}
