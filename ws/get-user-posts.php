<?php
	session_start();
	require_once('config.php');

	if (!isset($_SESSION['access_token']))
		header('Location: ../login.php');

	$token = $_SESSION['access_token'];
	$instagram->setAccessToken($token);
	if (isset($_GET['user_id'])) {
	  $user_id = $_GET['user_id'];
    $posts = $instagram->getUserMedia($user_id, 10000);
    echo json_encode($posts);
	}
?>
