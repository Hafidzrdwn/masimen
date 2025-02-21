<?php
require_once __DIR__ . '/../env.php';

// Define application settings
define('APP_NAME', 'MASIMEN');
define('APP_URL', 'http://localhost:8080/masimen/public');
define('APP_ENV', getenv('APP_ENV') ?: 'development');
define('APP_DEBUG', APP_ENV === 'development'); // Set to false in production

// Database configuration
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'db_name');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');

// Set timezone
date_default_timezone_set('Asia/Jakarta');

// Error reporting
if (APP_DEBUG) {
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
} else {
  error_reporting(0);
  ini_set('display_errors', 0);
}
