<?php

namespace App\Core;

class Router
{
  protected $routes = [];

  private function addRoute(string $method, string $uri, array $controller)
  {
    $this->routes[] = [
      'uri' => $uri,
      'controller' => $controller,
      'method' => $method,
    ];
  }

  public function get(string $uri, array $controller)
  {
    $this->addRoute('GET', $uri, $controller);
  }

  public function post(string $uri, array $controller)
  {
    $this->addRoute('POST', $uri, $controller);
  }

  public function put(string $uri, array $controller)
  {
    $this->addRoute('PUT', $uri, $controller);
  }

  public function delete(string $uri, array $controller)
  {
    $this->addRoute('DELETE', $uri, $controller);
  }

  public function dispatch()
  {
    $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $method = $_SERVER['REQUEST_METHOD'];

    $basePath = Config::get('app.base_path');

    $uri = $requestUri;
    if ($basePath && strpos($uri, $basePath) === 0) {
      $uri = substr($uri, strlen($basePath));
    }

    if (empty($uri)) {
      $uri = '/';
    }

    foreach ($this->routes as $route) {
      if ($route['uri'] === $uri && $route['method'] === $method) {
        [$class, $function] = $route['controller'];

        if (class_exists($class) && method_exists($class, $function)) {
          call_user_func([new $class(), $function]);
          return;
        }
      }
    }

    http_response_code(404);
    echo "404 Not Found - Route for '{$uri}' not defined.";
  }
}
