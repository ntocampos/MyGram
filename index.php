<!DOCTYPE html>
<?php
	session_start();
	require_once('ws/config.php');

	if (isset($_SESSION['access_token'])) {
		$token = $_SESSION['access_token'];
		$instagram->setAccessToken($token);
	}
	else
		header('Location: login.php');
?>

<html ng-app="myGram">
<head>
	<title>mygram</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="theme/paper/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="theme/bootswatch.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">

	<link rel="stylesheet" type="text/css" href="css/simple-sidebar.css">
	<link rel="stylesheet" type="text/css" href="css/app.css">


	<link rel="shortcut icon" type="image/ico" href="assets/favicon.ico"/>

	<link rel='stylesheet' href='css/loading-bar.css' type='text/css' media='all'
</head>

<body>
	<div id="wrapper">
		<sidebar></sidebar>
  	<button type="button" class="btn btn-default my-toggle-button" id="menu-toggle"
			style="outline: none; border-radius: 0px; box-shadow: none;">
			<i id="toggle-symbol" class="fa fa-chevron-left fa-lg"></i>
		</button>

    <div id="page-content-wrapper">
    	<div class="container">
				<div ng-view></div>
    	</div>
    </div>
	</div>


	<script type="text/javascript" src="js/angular.min.1.4.js"></script>
	<script type="text/javascript" src="js/angular-route.js"></script>
	<script type="text/javascript" src="theme/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type='text/javascript' src='js/loading-bar.js'></script>

	<script type="text/javascript" src="js/app.js"></script>

	<script>
		$("#menu-toggle").click(function(e) {
	        e.preventDefault();
	        $("#wrapper").toggleClass("toggled");
	        document.getElementById('toggle-symbol').className =
	        	document.getElementById('toggle-symbol').getAttribute('class') == "fa fa-chevron-right fa-lg" ?
	        	"fa fa-chevron-left fa-lg" : "fa fa-chevron-right fa-lg";
	    });
  </script>
</body>
</html>
