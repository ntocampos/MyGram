<?php 
	require_once('config.php');
	$code = $_GET['code'];
	$data = $instagram->getOAuthToken($code);
	echo json_encode($data);
?>