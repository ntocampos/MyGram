<?php 
	session_start();
	require_once('config.php');
	
	if (!isset($_SESSION['access_token']))
		header('Location: ../login.php');

	$token = $_SESSION['access_token'];
	$instagram->setAccessToken($token);

	$q = isset($_GET['q']) ? $_GET['q'] : 10;

	$likes = $instagram->getUserLikes($q);

	echo json_encode($likes);
?>