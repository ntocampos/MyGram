<?php 
	session_start();
	require_once('config.php');

	if (!isset($_SESSION['access_token']))
		header('Location: ../login.php');

	$token = $_SESSION['access_token'];
	$instagram->setAccessToken($token);

	$data = $instagram->getUser();
	echo json_encode($data);
?>