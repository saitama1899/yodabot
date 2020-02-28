<?php
  require_once __DIR__.'/../helpers/curl.php';

  class StarWarsSwapi {

    const URL = 'https://swapi.co/api/';
    const LIGHT = [1,2,3,5,10,11,13,14,20,25,32,35,51];
    const DARK = [4,15,16,21,22,36,44,67,79];

    public static function getCharacters() {
      $headers = [
        'Content-Type: application/json'
      ];
      $light_side = Curl::get(self::URL.'people/'.array_rand(self::LIGHT, 1), $headers);
      $dark_side = Curl::get(self::URL.'people/'.array_rand(self::DARK, 1), $headers);

      return 'Know what to say I do not. Hmmmm. You know that '.$light_side['name'].' and '.$dark_side['name'].' were rivals did?';
    }

    public static function getFlims() {
      $headers = [
        'Content-Type: application/json'
      ];

      $films = range(1, 7);
      shuffle($films);

      $f1 = Curl::get(self::URL.'films/'.$films[0], $headers);
      $f2 = Curl::get(self::URL.'films/'.$films[1], $headers);

      return 'You said force did?. Hmmmm. That "'.$f1['title'].'" and "'.$f2['title'].'" are the best films only strongs at force know. Yes, hrrrm.';
    }
  }

?>
