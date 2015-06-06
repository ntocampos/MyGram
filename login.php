<?php
	session_start();
	require_once('ws/config.php');

	if(!isset($_GET['code'])) {
		$loginUrl = $instagram->getLoginUrl(array('basic', 'likes', 'comments', 'relationships'));
		echo "<pre><a href='{$loginUrl}'>Login with Instagram</a></pre>";
	}
	else {
		// Parametro code do OAuth
		$code = $_GET['code'];

		if (isset($code)) {
			$data = $instagram->getOAuthToken($code);
			$token = $data->access_token;
			$_SESSION['access_token'] = $token;

			header('Location: index.php');
		}
		else {
			if (isset($_GET['error']))
				echo "An error occurred: " . $_GET['error_description'];
		}
	}
?>