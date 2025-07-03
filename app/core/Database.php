<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
  private static $instance = null;

  public static function getInstance(): PDO
  {
    if (self::$instance === null) {
      $dsn = 'mysql:host=' . Config::get('db.host') . ';dbname=' . Config::get('db.name');
      try {
        self::$instance = new PDO($dsn, Config::get('db.user'), Config::get('db.pass'));
        self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        if (Config::get('app.debug')) {
          die("Database connection failed: " . $e->getMessage());
        }
        die("Database connection failed.");
      }
    }
    return self::$instance;
  }
}
