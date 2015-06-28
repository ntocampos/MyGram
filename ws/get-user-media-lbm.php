<?php
  // Get user (user_id) media liked by me
	session_start();
	require_once('config.php');

	if (!isset($_SESSION['access_token']))
		header('Location: ../login.php');

	$token = $_SESSION['access_token'];
	$instagram->setAccessToken($token);
	if (isset($_GET['user_id'])) {
	  $user_id = $_GET['user_id'];
    var_dump((string) $user_id);
    $posts = $instagram->getUserMedia_mod((string) $user_id, 1000);
    echo json_encode($posts);
    if ($posts->meta->code == 200) {
      echo "string";
      $posts = $posts->data;
      $liked = [];
      foreach ($posts as $post)
        if ($post->user_has_liked)
          $liked[] = $post;

      echo json_encode($liked);
    }
	}
?>
