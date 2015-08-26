(function () {
	var app = angular.module('myGram', ['ngRoute', 'angular-loading-bar']);

	// Configure routes
	app.config(['$routeProvider', function($routeProvider) {
		$routeProvider
			.when('/', {
				templateUrl: 'pages/recent-likes.html',
				controller: 'LikeController',
				controllerAs: 'userLikes'
			})
			.when('/recent', {
				templateUrl: 'pages/recent-likes.html',
				controller: 'LikeController',
				controllerAs: 'userLikes'
			})
			.when('/relationship/:user_id', {
				templateUrl:'pages/relationship.html',
				controller: 'RelationshipController',
				controllerAs: 'relationship'
			})
			.when('/followers', {
				templateUrl:'pages/followers.html',
				controller: 'FollowerController',
				controllerAs: 'followers'
			})
			.otherwise({
				redirectTo: '/'
			});
	}]);
	// /Routes

	app.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = false;
  }]);

	// Controllers
	app.controller('UserController', ['$http', '$location', function($http, $location) {
		this.location = $location;
		var instagram = this;
		$http.get('ws/get-user-data.php')
		.success(function(data) {
			instagram.user = angular.fromJson(data.data);
		});
	}]);

	app.controller('LikeController', ['$http', '$location', function($http, $location) {
		this.location = $location;
		var instagram = this;
		instagram.likes = [];
		$http.get('ws/get-user-likes.php?q=50')
		.success(function(data) {
			instagram.likes = angular.fromJson(data.data);
		});
	}]);

	app.controller('TabController', function() {
		var tab = 1;

		this.selectTab = function(setTab) {
			this.tab = setTab;
		};

		this.isSelected = function(checkTab) {
			return this.tab === checkTab;
		};
	});

	app.controller('RelationshipController', ['$http', '$routeParams', '$location', function($http, $routeParams, $location) {
		this.location = $location;
		var user_id = $routeParams.user_id;
		var instagram = this;
		$http.get('ws/get-relationship.php?user_id=' + user_id)
		.success(function(data) {
			instagram.user_info = angular.fromJson(data.user.data);
			instagram.relationship = angular.fromJson(data.relationship.data);
		});
	}]);

	app.controller('LikedByMeController', ['$http', '$routeParams', '$location',
	function($http, $routeParams, $location) {
		this.location = $location;
		var user_id = $routeParams.user_id;
		var instagram = this;
		$http.get('ws/get-user-media-lbm.php?user_id=' + user_id)
		.success(function(data) {
			instagram.liked = angular.fromJson(data);
		});
	}]);

	app.controller('LikedByThemController', ['$http', '$routeParams', '$location',
	function($http, $routeParams, $location) {
		this.location = $location;
		var user_id = $routeParams.user_id;
		var instagram = this;
		$http.get('ws/get-my-media-lbt.php?user_id=' + user_id)
		.success(function(data) {
			instagram.liked = angular.fromJson(data);
		});
	}]);

	app.controller('FollowerController', ['$http', '$routeParams', '$location',
	function($http, $routeParams, $location) {
		this.location = $location;
		console.log(this.location.path());
		var instagram = this;
		$http.get('ws/get-followers.php')
		.success(function(data) {
			console.log(data);
			instagram.followers = data.data;
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
