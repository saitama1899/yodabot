<?php
  require_once 'inbenta/authentication.php';

  session_start();

  if (!isset($_SESSION['access_token']) || time() > $_SESSION['access_token_expiration']) {
    newAccessToken();
  }

  if (isset($_SESSION['conversation_token'])){
    echo $_SESSION['conversation_token'];
    // $message = htmlentities($_POST['message']);
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
