<?php

  require_once './swapi/star_wars.php';

	class AI {

    const SP_SENTENCES = [
      'force',
      'hello there',
      'baby yoda'
    ];

    public static function isEasterEgg ($message) {
      for ($i = 0; $i < count(self::SP_SENTENCES); $i++) {
        if (stripos($message, self::SP_SENTENCES[$i])!== false){
          $message = $i;
          break;
        }
      }
      return $message;
    }

    public static function easterEggs ($position) {
      switch ($position) {
        case 0:
          return StarWarsSwapi::getFlims();
          break;
        case 1:
          return "Hello there! Yes, hrrrm.";
          break;
        case 2:
          return "My younger version is not, know if you knew I do not.";
          break;
      }
    }

    public static function helperMessage() {
      return StarWarsSwapi::getCharacters();
    }
  }
?>
