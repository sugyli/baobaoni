<?php

namespace App\Libraries;

class SlugTranslate
{
  public static function translate($text)
  {
    if (static::isEnglish($text)) {
        return str_slug($text);
    }

    return static::pinyin($text);


  }
  public static function pinyin($text)
  {
      return str_slug(pinyin_permalink($text));
  }

  public static function isEnglish($text)
  {
      if (preg_match("/\p{Han}+/u", $text)) {
          return false;
      }

      return true;
  }
}
