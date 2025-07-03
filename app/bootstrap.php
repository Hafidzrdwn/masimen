<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Config;

Config::load();

if (Config::get('app.debug')) {
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
} else {
  error_reporting(0);
  ini_set('display_errors', 0);
}

date_default_timezone_set('Asia/Jakarta');
session_start();
