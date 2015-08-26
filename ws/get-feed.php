<?php
	session_start();
	require_once('config.php');

	if (!isset($_SESSION['access_token']))
		header('Location: ../login.php');

	$token = $_SESSION['access_token'];
	$instagram->setAccessToken($token);

	$max_id = isset($_GET['max_id']) ? $_GET['max_id'] : null;

	$feed = $instagram->getFeed(15, $max_id);

	echo json_encode($feed);
?>
