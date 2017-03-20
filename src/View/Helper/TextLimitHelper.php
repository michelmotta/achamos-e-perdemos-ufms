<?php
namespace App\View\Helper;

use Cake\View\Helper;

class TextLimitHelper extends Helper {

    public function limitText($text, $lenght)
    {
      $counter = strlen($text);
      if ( $counter >= $lenght ) {
          $text = substr($text, 0, strrpos(substr($text, 0, $lenght), ' ')) . '...';
          return $text;
      }
      else{
          return $text;
      }
   }
}
