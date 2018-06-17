'use strict';

angular.module("controllers.homeCtrl", [])
.controller("homeCtrl", ["$rootScope", "$scope", "$window", "$location", "$http",
	function($rootScope, $scope, $window, $location, $http){
		console.log("Here in HomeCtrl");
	    $('.datepicker').datepicker();
		
		// $http.post('home').then(function(response){
		// 	console.log(response.data);
		// });

		$http({
			'method'	: 'GET', 
			'url'		: '/home'
		}).then(function(res){
			$scope.transactions = res.data;
			$scope.transactions.forEach(function(item, index){
				if(item.note.startsWith('Sent')){
					$scope.transactions[index].type = "Sent";
				} else {
					$scope.transactions[index].type = "Received";
				}
			});
			console.log($scope.transactions);
			$scope.viewTransaction = $scope.transactions[0];
		}, function(error){
			console.log(error);
		});

		$scope.showTransaction = function(data){
			$scope.viewTransaction = data;
		}

	}
]);
