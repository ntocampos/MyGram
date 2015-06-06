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
	<title>myGram</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script type="text/javascript" src="js/angular.min.1.4.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	
	<script type="text/javascript" src="theme/bootstrap.js"></script>

	<link rel="stylesheet" type="text/css" href="theme/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="theme/bootswatch.min.css">
	<link rel="shortcut icon" type="image/ico" href="assets/favicon.ico"/>
</head>

<body>
	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a href="../mygram" class="navbar-brand">mygram</a>
				<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="navbar-collapse collapse" id="navbar-main">
				<ul class="nav navbar-nav">
					<li>
						<a href="../help/">Help</a>
					</li>
					<li>
						<a href="http://news.bootswatch.com">Blog</a>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Download <span class="caret"></span></a>
						<ul class="dropdown-menu" aria-labelledby="download">
							<li><a href="#">Android</a></li>
							<li class="divider"></li>
							<li><a href="#">iOS</a></li>
							<li><a href="#">Windows Phone</a></li>
						</ul>
					</li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.php">Hello, <b>Fulano</b>!</a></li>
					<li><a href="logout.php" title="Log out">logout</a></li>
				</ul>

			</div>
		</div>
	</div>

	<div class="container">
		<div class="page-header" id="banner">
			<div class="row">
				<div class="col-lg-8 col-md-7 col-sm-6">
				<h1>mygram</h1>
					<p class="lead">A plus+ to your Instagram(tm)</p>
				</div>
				<div class="col-lg-4 col-md-5 col-sm-6">
					<div class="sponsor">

					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-4">
				<div class="panel panel-default">
					<div class="panel-body">
						Panel content
					</div>
					<div class="panel-footer">Panel footer</div>
				</div>
			</div>	
		</div>
	</div>
</body>
</html>