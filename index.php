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

	<link rel="stylesheet" type="text/css" href="theme/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="theme/bootswatch.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">

	<link rel="stylesheet" type="text/css" href="css/simple-sidebar.css">

	<link rel="shortcut icon" type="image/ico" href="assets/favicon.ico"/>
</head>

<body>
	<div id="wrapper">
		<!-- Sidebar -->
        <div id="sidebar-wrapper">
        	<br><br>
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Start Bootstrap
                    </a>
                </li>
                <li>
                    <a href="#">
                    	<i class="fa fa-dashcube fa-lg pull-left"></i>
                    	Dashboard
                    </a>
                </li>
                <li>
                    <a href="#">
                    	<i class="fa fa-heartbeat fa-lg pull-left"></i>
                    	Shortcuts
                    </a>
                </li>
                <li>
                    <a href="#">
                    	<i class="fa fa-sellsy fa-lg pull-left"></i>
                    	Overview
                    </a>
                </li>
                <li>
                    <a href="#">
                    	<i class="fa fa-server fa-lg pull-left"></i>
                    	Events
                    </a>
                </li>
                <li>
                    <a href="#">
                    	<i class="fa fa-check-circle fa-lg pull-left"></i>
                    	About
                    </a>
                </li>
                <li>
                    <a href="#">
                    	<i class="fa fa-camera-retro fa-lg pull-left"></i>
                    	Services
                    </a>
                </li>
                <li>
                    <a href="#">
                    	<i class="fa fa-envelope-o fa-lg pull-left"></i>
                    	Contact
                    </a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

    	<button type="button" class="btn btn-default my-toggle-button" id="menu-toggle" style="outline: none;">
			<i id="toggle-symbol" class="fa fa-chevron-left fa-lg"></i>
		</button>
        <div id="page-content-wrapper">
        	<div class="container">
        		<div class="page-header" id="banner">
					<div class="row">
						<div class="col-lg-8 col-md-7 col-sm-6">
							<h1>mygram</h1>
							<p class="lead">A plus+ to your <u>Instagram</u>&trade;</p>
						</div>
						<div class="col-lg-4 col-md-5 col-sm-6">
							<div class="sponsor">

							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="page-header">
							<h1 id="navbar">recent likes</h1>
						</div>
					</div>
				</div>
				<div class="row" ng-controller="LikeController as userLikes">
					<div class="col-lg-4" ng-repeat="like in userLikes.likes" align="center">
						<div class="panel panel-default" style="max-width: 360px">
							<div class="panel-body">
								<a href="{{like.link}}">
								<img ng-src="{{like.images.low_resolution.url}}" alt="{{like.caption.from.username}}">
								</a>
							</div>
							<div class="panel-footer" style="max-height:85px; min-height: 85px">
								<div id="description-text" ng-show="like.caption.text">{{like.caption.text | limitTo: 85}}{{like.caption.text.length > 85 ? '...' : ''}}, </div>
								<div>by <a href="http://instagram.com/{{like.user.username}}"><b>{{like.user.username}}</b></a></div>
							</div>
						</div>
					</div>
				</div>
        	</div>
        </div>
	</div>


	<script type="text/javascript" src="js/angular.min.1.4.js"></script>
	<script type="text/javascript" src="theme/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	
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