'use strict';

angular.module("controllers.homeCtrl", [])
.controller("homeCtrl", ["$rootScope", "$scope", "$window", "$location", "$http",
	function($rootScope, $scope, $window, $location, $http){
		console.log("Here in HomeCtrl");
		$http.post('home').then(function(response){
			console.log(response.data);
		});
	    $('.datepicker').datepicker();

		$http({
			'method'	: 'GET', 
			'url'		: '/js/transactions2.json',
		}).then(function(res){
			$scope.transactions = res.data;
			$scope.viewTransaction = res.data[0]
		}, function(error){
			console.log(error);
		});

		$scope.showTransaction = function(data){
			$scope.viewTransaction = data;
		}

	}
]);
