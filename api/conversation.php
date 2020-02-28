<?php
  require_once 'inbenta/authentication.php';

  $message = htmlentities($_POST['message']);
  echo strtoupper($message);

  // $authentication = Authentication::getAuthToken();

?>
