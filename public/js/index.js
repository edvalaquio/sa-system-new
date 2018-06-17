'use strict';

angular.module("indexApp",
	["ngRoute",
	"controllers.accountsCtrl",
	"controllers.homeCtrl",
	"controllers.filesCtrl"])
.config(["$routeProvider", "$locationProvider",
	function($routeProvider, $locationProvider){
		$routeProvider
		.when("/", {
			templateUrl: 	"/templates/home.html",
			controller:		"homeCtrl"
		})
		.when("/sent", {
			templateUrl: 	"/templates/sent.html",
			controller: 	"filesCtrl"
		})
		.when("/received", {
			templateUrl: 	"/templates/received.html",
			controller: 	"filesCtrl"
		})
		.when("/accounts", {
			templateUrl: 	"/templates/accounts.html",
			controller: 	"accountsCtrl"
		})
	}
])
.config(["$interpolateProvider", function($interpolateProvider) {
    $interpolateProvider.startSymbol("[[");
    $interpolateProvider.endSymbol("]]");
}])
.constant('apiUrl', 'localhost:8000/')
.directive('file', function () {
    return {
        scope: {
            file: '='
        },
        link: function (scope, el, attrs) {
            el.bind('change', function (event) {
                var file = event.target.files[0];
                scope.file = file ? file : undefined;
                scope.$apply();
            });
        }
    };
});
// .config(["$qProvider", function($qProvider){
// 	 $qProvider.errorOnUnhandledRejections(false)
// }])

// Add this directive where you keep your directive
