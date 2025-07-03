<?php

namespace App\Core\Helpers;

/**
 * Class untuk membantu menangani dan membersihkan input.
 */
class InputHelper
{
  /**
   * Membersihkan input dari tag HTML dan spasi yang tidak perlu.
   *
   * @param mixed $input Data yang ingin dibersihkan.
   * @return mixed Data yang sudah bersih.
   */
  public static function sanitize($input)
  {
    if (is_array($input)) {
      return array_map([self::class, 'sanitize'], $input);
    }

    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
  }
}
