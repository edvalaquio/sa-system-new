'use strict';
var files = angular.module("controllers.filesCtrl", [])

files.controller("filesCtrl", ["$rootScope", "$scope", "$window", "$location", "$http", "apiUrl",
	function($rootScope, $scope, $window, $location, $http, apiUrl){
		$('.modal').modal();
        $('.chips').chips();
		var tags = {};
		$http({
			method	:	'GET',
			url		:	'/getTags'
		}).then(function(res){
			$.each(res.data, function(index, value){
				tags[value.name] = null;
			});
		});
		$('.chips-autocomplete').chips({
			autocompleteOptions: {
				data: tags,
				limit: Infinity,
				minLength: 1
			}
		});
		$('.chip > input').change(function(){
			console.log("change");
		})
        $scope.uploading = false;

		// check if either sent or received
		$http({
			'method'	:	'GET',
			'url'		:	$location.path()
		}).then(function(res){
			$scope.transactions = res.data;
			$scope.transactions.forEach(function(item, index){
				item.date = new Date(item.date);
			});
			console.log(res.data);
		}, function(error){
			console.log(error);
		});

		$scope.searchTransaction = function(type){
			$http({
	            method 	: 'POST',
				url 	: '/' + type + '/search',
	            data 	: {
	            	keyword 	: $scope.keyword
	            }
			}).then(function(res){
				$scope.transactions = res.data;
				$scope.transactions.forEach(function(item, index){
					item.date = new Date(item.date);
				});
			});
		}


		$scope.submitTransaction = function(type){
			$scope.uploading = true;
			if(($scope.transaction.file) && (typeof $scope.transaction.file == 'object')){
				uploadFile(type);
				return;
			}
			storeDetails(type, false);
		}
		var uploadFile = function(type){
			var fd = new FormData();
			fd.append("file", $scope.transaction.file);
			$http({
	            method 	: 'POST',
				url 	: '/' + type + '/upload',
	            data 	: fd,
				headers: {'Content-Type': undefined }
			}).then(function(res){
				if(res.data == 'Fail'){
					console.log("Upload failed");
					$scope.uploading = false;
					return;
				}
				console.log(res);
				storeDetails(type, true);
			});
		}


		var storeDetails = function(type, hasFile){
			var tempData = {
				title 			: $scope.transaction.title,
				description 	: $scope.transaction.description,
				recipient 		: $scope.transaction.recipient
			}

			if(hasFile){
				tempData.file = $scope.transaction.file.name;
			} else {
				tempData.file = null;
			}

            $http({
	            method 	: 'POST',
				url 	: '/' + type + '/create',
	            data 	: tempData
			}).then(function(res){
				console.log(res);
				$('.modal').modal('close');
				$scope.uploading = false;
				$scope.transactions.push(res.data)
			}, function(err){
				console.log(err);
			});
		}

		$scope.viewTransaction = function(data){
			$location.path('/transaction').search({id : data});
		}

		$scope.fillAutocomplete = function(){
			if($scope.transaction.recipient.length > 2){
				$http({
					method	:	'POST',
					url		:	'/getUsersInGroup',
					data	:	{
						keyword		:	$scope.transaction.recipient
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
	}
]);
