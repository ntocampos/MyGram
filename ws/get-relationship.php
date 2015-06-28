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

    $user_data = $instagram->getUser_mod($user_id);
    $relationship = $instagram->getUserRelationship($user_id);

    $return->user = $user_data;
    $return->relationship = $relationship;

    echo json_encode($return);
	}
?>
