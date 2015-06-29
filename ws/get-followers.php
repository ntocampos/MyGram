<?php
  // Get user followers
  session_start();
  require_once('config.php');

  if (!isset($_SESSION['access_token']))
    header('Location: ../login.php');

  $token = $_SESSION['access_token'];
  $instagram->setAccessToken($token);

  $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : 'self';

  $cursor = isset($_GET['cursor']) ? $_GET['cursor'] : null;

  $followers = $instagram->getUserFollower($user_id, 91, $cursor);

  echo json_encode($followers);
?>
