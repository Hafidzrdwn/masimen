<?php
// Load environment variables
require_once __DIR__ . '/../app/env.php';

// Define application settings
define('APP_NAME', 'My PHP Native App');
define('APP_URL', 'http://localhost/myapp');
define('APP_ENV', getenv('APP_ENV') ?: 'development');
define('APP_DEBUG', APP_ENV === 'development'); // Set to false in production

// Database configuration
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'my_database');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');

// Security settings
define('SESSION_LIFETIME', 3600);
define('HASH_ALGO', 'sha256');
define('CSRF_TOKEN_SECRET', getenv('CSRF_SECRET') ?: 'my_random_secret');


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
