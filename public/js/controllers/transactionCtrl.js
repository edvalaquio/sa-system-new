'use strict';

angular.module("controllers.transactionCtrl", [])
.controller("transactionCtrl", ["$rootScope", "$scope", "$window", "$location", "$http",
	function($rootScope, $scope, $window, $location, $http){
		console.log("Here in accountsCtrl");
		var $transactionID = $location.search().id;
		if($transactionID){
			$http({
				method	:	'GET',
				url		: '/transaction/' + $transactionID
			}).then(function(res){
				$scope.transaction = res.data[0];
				console.log($scope.transaction);
			}, function(error){
				console.log(error);
			});
		}
	}
]);
