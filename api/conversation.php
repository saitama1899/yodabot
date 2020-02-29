<?php
  require_once 'inbenta/authentication.php';
  require_once 'AI.php';

  session_start();

  // If the user don't have access token or it's expired
  if (!isset($_SESSION['access_token']) || time() > $_SESSION['access_token_expiration']) {
    newAccessToken();
  }

  // If no-results count is not initialized
  if (!isset($_SESSION['no-results'])) {
    $_SESSION['no-results'] = 0;
  }

  // If conversation session is not initialized
  if(!isset($_SESSION['conversation_token'])){
    isset($_SESSION['conversation_token']);
  }

  // If there is a conversation session already
  if (isset($_SESSION['conversation_token'])){
    $message = htmlentities($_POST['message']);
    // If the message contains an easter egg word/sentence
    $is_easter_egg = AI::isEasterEgg($message);

    // If don't contains a special word we talk with the bot
    if (!is_int($is_easter_egg)) {
      $answer = Authentication::getBotAnswer(
        $_SESSION['access_token'],
        $_SESSION['conversation_token'],
        $message
      );

      // If the answer have no-result flag
			if ($answer['no-results'] == 1) {
        $_SESSION['no-results'] += 1;
        if ($_SESSION['no-results'] == 2){
          echo AI::helperMessage();
          $_SESSION['no-results'] = 0;
        } else {
          echo $answer['message'];
        }
			} else {
        // If we got a good answer
        $_SESSION['no-results'] = 0;
        echo $answer['message'];
      }

    } else {
      echo AI::easterEggs($is_easter_egg);
    }
  }
  //else {
  //   newConversationToken($_SESSION['access_token']);
  // }

  function newAccessToken() {
    $authentication = Authentication::getAuthToken();
    $_SESSION['access_token'] = $authentication['accessToken'];
    $_SESSION['access_token_expiration'] = $authentication['expiration'];
  }

  function newConversationToken() {
    $_SESSION['conversation_token'] = Authentication::getConversationToken($_SESSION['access_token']);
  }


?>
