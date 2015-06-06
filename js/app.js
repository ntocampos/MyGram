(function () {
	var app = angular.module('myGram', []);

	app.controller('MygramController', ['$http', function($http) {
			this.name = 'Moises Neto';
		}]);

	app.controller('UserController', ['$http', function($http) {
		$http.get('../ws/get-user-data.php')
		.success(function(data) {
			this.data = data;
		});
	}]);

	app.controller('LoginController', function() {
		this.login
	});
})();