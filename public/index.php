<?php
// Load configuration and dependencies
require_once __DIR__ . '/../app/config/index.php';
require_once __DIR__ . '/../app/database.php';
require_once __DIR__ . '/../app/session.php';
require_once __DIR__ . '/../app/functions.php';
require_once __DIR__ . '/../app/query_builder.php';
require_once __DIR__ . '/../app/view.php';

$query = new QueryBuilder($pdo);

$request_string = explode('/', substr($_SERVER['REQUEST_URI'], 1))[2];
$request_page = sanitizeInput($request_string) ?: 'home';

// Verify if the file exists before including it
$page_file = __DIR__ . "/../views/{$request_page}.php";

if (!file_exists($page_file)) {
  http_response_code(404);
  View::render('404');
  exit;
}

// load globals variables
View::setGlobal('query', $query);

// Load the requested page
View::render($request_page);
