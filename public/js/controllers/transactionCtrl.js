'use strict';

angular.module("controllers.transactionCtrl", [])
.controller("transactionCtrl", ["$rootScope", "$scope", "$window", "$location", "$http",
	function($rootScope, $scope, $window, $location, $http){
		console.log("Here in accountsCtrl");
		$('.modal').modal();
		var transactID = $location.search().id;
		function updateInterface(){
			if(transactID){
				$http({
					method	:	'GET',
					url		: '/transaction/' + transactID
				}).then(function(res){
					$scope.transactions = res.data;
					$scope.transactions.forEach(function(item, index){
						item.date = new Date(item.date);
						console.log(item);
						if(item.id == transactID){
							$scope.transaction = item;
						}
					});
					$scope.transaction.date = new Date($scope.transaction.date);
					console.log($scope.transaction);
				}, function(error){
					console.log(error);
				});
			}
		}
		updateInterface();

		$scope.fillAutocomplete = function(){
			if($scope.recipient.length > 2){
				$http({
					method	:	'POST',
					url		:	'/getUsersInGroup',
					data	:	{
						keyword		:	$scope.recipient
					}
				}).then(function(res){
					console.log(res.data);
					if($scope.autocomplete != undefined && $scope.autocomplete.length != res.data.length){
						$scope.autocomplete = res.data;
					}
					if($scope.autocomplete == undefined){
						$scope.autocomplete = res.data;
					}
				}, function(error){
					console.log(error);
				});
			}
		}

		$scope.submitTransaction = function(){
			$http({
				method	:	'POST',
				url		:	'/send/send',
				data	:	{
					transact_id		:	transactID,
					note 			:	$scope.note,
					recipient		:	$scope.recipient

				}
			}).then(function(res){
				$('#forward-form')[0].reset();
				$('.modal').modal('close');
				updateInterface();
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
