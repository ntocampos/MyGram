(function () {
	var app = angular.module('myGram', []);

	app.controller('MygramController', ['$http', function($http) {
			this.name = 'Moises Neto';
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
})();