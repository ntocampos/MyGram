<?php
  // Get my media liked by them (user_id)
  session_start();
  require_once('config.php');

  if (!isset($_SESSION['access_token']))
    header('Location: ../login.php');

  $token = $_SESSION['access_token'];
  $instagram->setAccessToken($token);
  if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $posts = $instagram->getUserMedia('self', 10000);
    if ($posts->meta->code == 200) {
      $posts = $posts->data;
      $liked = [];

      foreach ($posts as $post) {
        $postLikes = $instagram->getMediaLikes($post->id);
        $postLikes = $postLikes->data;
        if(strpos(json_encode($postLikes), $user_id))
          $liked [] = $post;
      }

      echo json_encode($liked);
    }
  }
?>
