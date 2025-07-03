<?php
require_once __DIR__ . '/../app/bootstrap.php';

use App\Core\Router;
use App\Core\Csrf;
use App\Core\ModelNotFoundException;
// use App\Core\View;

try {
  Csrf::check();
} catch (\Exception $e) {
  http_response_code(403);
  die($e->getMessage());
}

$router = new Router();
require_once __DIR__ . '/../app/routes.php';

try {
  $router->dispatch();
} catch (ModelNotFoundException $e) {
  http_response_code(404);
  die($e->getMessage());
  // View::render('errors.404', ['message' => $e->getMessage()]); // Gunakan getMessage() bawaan

} catch (\Exception $e) {
  http_response_code(500);
  die($e->getMessage());
  // View::render('errors.500', ['message' => $e->getMessage()]);
}
