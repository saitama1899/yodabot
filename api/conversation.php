<?php
  require_once 'inbenta/authentication.php';

  $authentication = Authentication::getAuthToken();
  echo $authentication['accessToken'];

?>
