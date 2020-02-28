<?php
  require_once 'inbenta/authentication.php';

  session_start();

  // $actual = new DateTime();
  // $actual->setTimestamp(time());
  // $expiration = new DateTime();
  // $expiration->setTimestamp($_SESSION['access_token_expiration']);
  // echo 'Expiration: '. $expiration->format('U = Y-m-d H:i:s') . "<br>";
  // echo 'Actual: '. $actual->format('U = Y-m-d H:i:s') . "<br>";


  // If the user don't have access token or it's expired
  if (!isset($_SESSION['access_token']) || time() > $_SESSION['access_token_expiration']) {
    newAccessToken();
  }

  // If there is a conversation session already
  if (isset($_SESSION['conversation_token'])){
    // $message = htmlentities($_POST['message']);
    $message = "Hi";
    $answer = Authentication::getBotAnswer($_SESSION['access_token'], $_SESSION['conversation_token'], $message);

    return $answer;
  } else {
    newConversationToken($_SESSION['access_token']);
  }

  function newAccessToken() {
    $authentication = Authentication::getAuthToken();
    $_SESSION['access_token'] = $authentication['accessToken'];
    $_SESSION['access_token_expiration'] = $authentication['expiration'];
  }

  function newConversationToken() {
    $_SESSION['conversation_token'] = Authentication::getConversationToken($_SESSION['access_token']);
  }


?>
