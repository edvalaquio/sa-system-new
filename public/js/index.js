'use strict';

angular.module("indexApp",
	["ngRoute",
	"controllers.accountsCtrl",
	"controllers.homeCtrl",
	"controllers.filesCtrl",
	"controllers.transactionCtrl"])
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
		.when("/transaction", {
			templateUrl:	"/templates/transaction.html",
			controller: 	"transactionCtrl"
		})
	}
])
.service("getUserID", function($http){

})
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
