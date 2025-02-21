<?php

class View
{
  protected static array $sections = [];
  protected static string $layout;

  // Start capturing a section
  public static function startSection(string $name)
  {
    self::$sections[$name] = '';
    ob_start();
  }

  // Stop capturing and save the section
  public static function endSection()
  {
    $lastKey = array_key_last(self::$sections);
    self::$sections[$lastKey] = ob_get_clean();
  }

  // Set the layout
  public static function extend(string $layout)
  {
    self::$layout = $layout;
  }

  // Render the final view with layout
  public static function render(string $view, array $data = [])
  {
    extract($data);
    ob_start();

    include __DIR__ . "/../views/$view.php";
    $content = ob_get_clean();

    if (isset(self::$layout)) {
      include __DIR__ . "/../views/layouts/" . self::$layout . ".php";
    } else {
      echo $content;
    }
  }

  // Yield a section
  public static function yield(string $name)
  {
    echo self::$sections[$name] ?? '';
  }
}
