<?php
  class Jobeet
  {
    static public function slugify($text)
    {
      //replace non-alphanumeric letters to hiphen
      // \pL = one that is alphabet
      $text = preg_replace('#[^\\pL\d]+#u', '-', $text);

      $text = trim($text, '-');

      if (function_exists('iconv'))
      {
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
      }

      //convert it to lower letters
      $text = strtolower($text);

      $text = preg_replace('#[^-\w]+#', '', $text);

      if (empty($text)){
        return 'n-a';
      }
      return $text;
    }
  }
?>
