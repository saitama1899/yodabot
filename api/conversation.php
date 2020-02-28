<?php
  require_once 'inbenta/authentication.php';
  require_once 'AI.php';

  session_start();
  // session_destroy();

  // If the user don't have access token or it's expired
  if (!isset($_SESSION['access_token']) || time() > $_SESSION['access_token_expiration']) {
    newAccessToken();
  }

  // If there is a conversation session already
  if (isset($_SESSION['conversation_token'])){
    // $message = htmlentities($_POST['message']);
    $message = "force";
    // If the message contains an easter egg word/sentence
    $is_easter_egg = AI::isEasterEgg($message);

    // If don't contains a special word
    if (!is_int($is_easter_egg)) {
      $answer = Authentication::getBotAnswer(
        $_SESSION['access_token'],
        $_SESSION['conversation_token'],
        $message
      );

      echo $answer['message'];

    } else {
      echo AI::easterEggs($is_easter_egg);
    }
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
