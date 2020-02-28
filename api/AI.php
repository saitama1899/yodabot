<?php

	class AI {

    const SP_SENTENCES = [
      'force',
      'hello there'
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
          return self::starWarsChars();
          break;
        case 1:
          return "<img src='https://media1.tenor.com/images/dc26484243124b4f42647f3eff67f637/tenor.gif' alt='Gif'/>";
          break;
      }
    }

    public static function starWarsChars(){
      return 'Leia, Han, Luke';
    }
  }
?>
