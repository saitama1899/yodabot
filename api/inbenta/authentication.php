<?php
  require_once __DIR__.'/../helpers/curl.php';

	class Authentication {
    // YodaBot API credentials
    const APIKEY = 'nyUl7wzXoKtgoHnd2fB0uRrAv0dDyLC+b4Y6xngpJDY=';
    const SECRET = 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJwcm9qZWN0IjoieW9kYV9jaGF0Ym90X2VuIn0.anf_eerFhoNq6J8b36_qbD4VqngX79-yyBKWih_eA1-HyaMe2skiJXkRNpyWxpjmpySYWzPGncwvlwz5ZRE7eg';
    const URL = 'https://api.inbenta.io/v1/auth';

	  public static function getAuthToken() {
      $headers = [
        'x-inbenta-key: '.self::APIKEY,
        'Content-Type: application/json'
      ];
      $body = [
        'secret' => self::SECRET
      ];

      $response = Curl::post(self::URL, $headers, $body);
      return [
        'accessToken' => $response['accessToken'],
        'expiration' => $response['expiration']
      ];
    }
  }

?>
