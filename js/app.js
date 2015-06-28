(function () {
	var app = angular.module('myGram', ['ngRoute']);

	// Configure routes
	app.config(['$routeProvider', function($routeProvider) {
		$routeProvider
			.when('/', {
				templateUrl: 'pages/recent-likes.html',
				controller: 'LikeController'
			})
			.when('/recent', {
				templateUrl: 'pages/recent-likes.html',
				controller: 'LikeController'
			})
			.when('/relationship/:user_id', {
				templateUrl:'pages/relationship.html',
				controller: 'RelationshipController'
			})
			.otherwise({
				redirectTo: '/'
			});
	}]);
	// /Config

	// Controllers
	app.controller('UserController', ['$http', function($http) {
		var instagram = this;
		$http.get('ws/get-user-data.php')
		.success(function(data) {
			instagram.user = angular.fromJson(data.data);
		});
	}]);

	app.controller('LikeController', ['$http', function($http) {
		var instagram = this;
		instagram.likes = [];
		$http.get('ws/get-user-likes.php?q=50')
		.success(function(data) {
			instagram.likes = angular.fromJson(data.data);
		});
	}]);

	app.controller('RelationshipController', ['$http', '$routeParams', function($http, $routeParams) {
		var user_id = $routeParams.user_id;
		var instagram = this;
		$http.get('ws/get-relationship.php?user_id=' + user_id)
		.success(function(data) {
			instagram.user_info = angular.fromJson(data.user.data);
			instagram.relationship = angular.fromJson(data.relationship.data);
			console.log(instagram.user_info.bio);
		});
	}]);

	app.controller('LikedByMeController', ['$http', '$routeParams',
	function($http, $routeParams) {
		var user_id = $routeParams.user_id;
		var instagram = this;
		$http.get('ws/get-user-media-lbm.php?user_id=' + user_id)
		.success(function(data) {
			instagram.liked = angular.fromJson(data);
		});
	}]);

	app.controller('LikedByThemController', ['$http', '$routeParams',
	function($http, $routeParams) {
		var user_id = $routeParams.user_id;
		var instagram = this;
		$http.get('ws/get-my-media-lbt.php?user_id=' + user_id)
		.success(function(data) {
			instagram.liked = angular.fromJson(data);
		});
	}]);
	// /Controllers


	// Custom directives
	app.directive('sidebar', function() {
		return {
			restrict: 'E',
			templateUrl: 'templates/sidebar.html'
		};
	});
})();
