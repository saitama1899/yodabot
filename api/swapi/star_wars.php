<?php
  require_once __DIR__.'/../helpers/curl.php';

  class StarWarsSwapi {

    const URL = 'https://swapi.co/api/';

    public static function getCharacters() {
      $headers = [
        'Content-Type: application/json'
      ];
      $chars = range(1, 70);
      shuffle($chars);

      $c1 = Curl::get(self::URL.'people/'.$chars[0], $headers);
      $c2 = Curl::get(self::URL.'people/'.$chars[1], $headers);

      return 'Know what to say I do not. Hmmmm. You know that '.$c1['name'].' and '.$c2['name'].' were rivals did? Or friends were they?';
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
