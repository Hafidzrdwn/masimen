<?php

// Define secure access to prevent direct script execution
define('SECURE_ACCESS', true);

// Load configuration and dependencies
require_once __DIR__ . '/../config/index.php';
require_once __DIR__ . '/../app/database.php';
require_once __DIR__ . '/../app/session.php';
require_once __DIR__ . '/../app/functions.php';
require_once __DIR__ . '/../security/sanitize.php';
require_once __DIR__ . '/../app/query_builder.php';
require_once __DIR__ . '/../app/view.php';

$query = new QueryBuilder($pdo);

// Start a secure session
if (session_status() === PHP_SESSION_NONE) {
  session_start([
    'cookie_httponly' => true,
    'cookie_secure' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
    'cookie_samesite' => 'Strict'
  ]);
}

$request_string = explode('/', substr($_SERVER['REQUEST_URI'], 1))[2];
$request_page = sanitizeInput($request_string) ?: 'home';

// Verify if the file exists before including it
$page_file = __DIR__ . "/../views/{$request_page}.php";

if (!file_exists($page_file)) {
  http_response_code(404);
  View::render('404');
  exit;
}

// Load the requested page
View::render($request_page, ['query' => $query]);
