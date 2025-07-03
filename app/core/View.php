<?php

namespace App\Core;

class View
{
  protected static string $viewPath = __DIR__ . '/../../views/';
  protected static string $cachePath = __DIR__ . '/../../storage/views/';

  // Properti untuk menangani layout inheritance
  protected static ?string $layout = null;
  protected static array $sections = [];
  protected static array $sectionStack = [];

  public static function render(string $view, array $data = []): void
  {
    if (!is_dir(self::$cachePath)) {
      mkdir(self::$cachePath, 0777, true);
    }

    $viewFile = self::$viewPath . str_replace('.', '/', $view) . '.echo.php';
    if (!file_exists($viewFile)) {
      throw new \Exception("View [{$view}] not found at path: {$viewFile}");
    }

    $cachedFile = self::$cachePath . md5($viewFile) . '.php';

    if (!file_exists($cachedFile) || filemtime($viewFile) > filemtime($cachedFile)) {
      $content = file_get_contents($viewFile);
      $compiledContent = self::compile($content);
      file_put_contents($cachedFile, $compiledContent);
    }

    // Eksekusi file dari cache
    self::executeView($cachedFile, $data);
  }

  protected static function executeView(string $path, array $data): void
  {
    ob_start();
    extract($data, EXTR_SKIP);
    require $path;
    $content = ob_get_clean();

    // Jika ada layout yang didefinisikan, render layoutnya
    if (self::$layout) {
      $layoutToRender = self::$layout;
      self::$layout = null; // Reset untuk render berikutnya
      self::render($layoutToRender, $data);
    } else {
      echo $content;
    }
  }

  protected static function compile(string $content): string
  {
    // Urutan compile penting!
    $content = self::compileComments($content);
    $content = self::compileEchos($content);
    $content = self::compileControlStructures($content);
    $content = self::compileLayouts($content);
    $content = self::compileCustomDirectives($content);
    return $content;
  }

  protected static function compileComments(string $content): string
  {
    return preg_replace('/\{\{--.*?--\}\}/s', '', $content);
  }

  protected static function compileEchos(string $content): string
  {
    // {{ $variable }} -> echo htmlspecialchars($variable)
    $content = preg_replace_callback('/\{\{\s*(.+?)\s*\}\}/', function ($matches) {
      return '<?php echo htmlspecialchars(' . $matches[1] . ', ENT_QUOTES, \'UTF-8\'); ?>';
    }, $content);

    // {!! $variable !!} -> echo $variable
    $content = preg_replace_callback('/\{\!!\s*(.+?)\s*!!\}/', function ($matches) {
      return '<?php echo ' . $matches[1] . '; ?>';
    }, $content);

    return $content;
  }

  protected static function compileControlStructures(string $content): string
  {
    // @if, @elseif, @else, @endif
    $content = preg_replace('/@if\s*\((.*)\)/', '<?php if ($1): ?>', $content);
    $content = preg_replace('/@elseif\s*\((.*)\)/', '<?php elseif ($1): ?>', $content);
    $content = preg_replace('/@else/', '<?php else: ?>', $content);
    $content = preg_replace('/@endif/', '<?php endif; ?>', $content);

    // @foreach, @endforeach
    $content = preg_replace('/@foreach\s*\((.*)\)/', '<?php foreach ($1): ?>', $content);
    $content = preg_replace('/@endforeach/', '<?php endforeach; ?>', $content);

    // @for, @endfor
    $content = preg_replace('/@for\s*\((.*)\)/', '<?php for ($1): ?>', $content);
    $content = preg_replace('/@endfor/', '<?php endfor; ?>', $content);

    // @php, @endphp
    $content = preg_replace('/@php/', '<?php', $content);
    $content = preg_replace('/@endphp/', '?>', $content);

    return $content;
  }

  protected static function compileLayouts(string $content): string
  {
    $content = preg_replace('/@section\s*\(\s*\'([^\']+)\'\s*,\s*(.*?)\s*\)/', '<?php section(\'$1\', $2); ?>', $content);
    $content = preg_replace('/@section\s*\(\s*\'(.*?)\'\s*\)/', '<?php section(\'$1\'); ?>', $content);

    // ... (sisa aturan compile lain tetap sama) ...
    $content = preg_replace('/@endsection/', '<?php endsection(); ?>', $content);
    $content = preg_replace('/@yield\s*\(\s*\'(.*?)\'\s*\)/', '<?php yield_section(\'$1\'); ?>', $content);
    $content = preg_replace('/@extends\s*\(\s*\'(.*?)\'\s*\)/', '<?php extend(\'$1\'); ?>', $content);
    $content = preg_replace('/@include\s*\(\s*\'(.*?)\'\s*\)/', '<?php include_view(\'$1\'); ?>', $content);

    return $content;
  }

  protected static function compileCustomDirectives(string $content): string
  {
    // @csrf
    $content = preg_replace('/@csrf/', '<?php echo csrf_field(); ?>', $content);
    return $content;
  }

  // --- Helper methods untuk layout engine ---
  public static function setSection(string $name, string $content): void
  {
    self::$sections[$name] = $content;
  }

  public static function extend(string $layout): void
  {
    self::$layout = $layout;
  }

  public static function startSection(string $name): void
  {
    self::$sectionStack[] = $name;
    ob_start();
  }

  public static function endSection(): void
  {
    $lastSection = array_pop(self::$sectionStack);
    self::$sections[$lastSection] = ob_get_clean();
  }

  public static function yield(string $name): string
  {
    return self::$sections[$name] ?? '';
  }
}
