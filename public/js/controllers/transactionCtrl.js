'use strict';

angular.module("controllers.transactionCtrl", [])
.controller("transactionCtrl", ["$rootScope", "$scope", "$window", "$location", "$http",
	function($rootScope, $scope, $window, $location, $http){
		console.log("Here in accountsCtrl");
		$('.modal').modal();
		var $transactionID = $location.search().id;
		if($transactionID){
			$http({
				method	:	'GET',
				url		: '/transaction/' + $transactionID
			}).then(function(res){
				$scope.transaction = res.data[0];
				$scope.transaction.date = new Date($scope.transaction.date);
				$scope.transactions = res.data;
				console.log($scope.transaction);
				$scope.transactions.forEach(function(item, index){
					item.date = new Date(item.date);
					if(item.note.startsWith('Sent')){
						$scope.transactions[index].type = "Sent";
					} else {
						$scope.transactions[index].type = "Received";
					}
				});
			}, function(error){
				console.log(error);
			});
		}

		// $scope.autocompleteRecipient = function(){
		// 	if($scope.recipient > 3){
		// 		$http({
		// 			method	:	'POST',
		// 			url		:	'/autocompleteRecipient',
		// 			data	:	$scope.recipient
		// 		})
		// 	}
		// }
	}
]);
