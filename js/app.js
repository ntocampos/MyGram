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
			.when('/relationship/', {
				templateUrl:'pages/relationship.html',
				controller: 'RelationshipController'
			})
			.otherwise({
				redirectTo: '/'
			});
	}]);

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

	// app.controller('UserPostController', ['$http', function($http) {
	// 	$http.get('ws/get-user-posts.php?user_id')
	// }]);



	// Custom directives
	app.directive('sidebar', function() {
		return {
			restrict: 'E',
			templateUrl: 'templates/sidebar.html'
		};
	});

	// app.directive('recentLikes', function() {
	// 	return {
	// 		restrict: 'E',
	// 		templateUrl: 'pages/recent-likes.html'
	// 	};
	// });
})();
