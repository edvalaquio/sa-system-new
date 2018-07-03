'use strict';

angular.module("controllers.accountsCtrl", [])
.controller("accountsCtrl", ["$rootScope", "$scope", "$window", "$location",
	function($rootScope, $scope, $window, $location){
		$('.modal').modal();
	}
]);
