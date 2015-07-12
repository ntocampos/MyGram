<?php
	require_once('Instagram.php');
	require_once('connection.php');
	use MetzWeb\Instagram\Instagram;

	$instagram = new Instagram(array(
	    'apiKey'      => '3ed87dd71758481686cf48a77e122029',
	    'apiSecret'   => '47fe76ad5fca4cdc89ef6ef65f68fb28',
	    'apiCallback' => 'http://localhost/mygram/login.php'
	));
?>
