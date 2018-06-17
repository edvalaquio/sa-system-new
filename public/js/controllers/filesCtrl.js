'use strict';
var files = angular.module("controllers.filesCtrl", [])

files.controller("filesCtrl", ["$rootScope", "$scope", "$window", "$location", "$http", "apiUrl",
	function($rootScope, $scope, $window, $location, $http, apiUrl){
		$('.modal').modal();
        $('.chips').chips()

		$scope.submitTransaction = function(type){
			console.log($scope.transaction);
			// console.log($scope.transaction)            method: 'POST',
			// $http({
			// 	method 	: 'POST',
			// 	url 	: '/' + type + '/create',
			// 	data 	: {
			// 		'title' 		: $scope.transaction.title,
			// 		'description' 	: $scope.transaction.description,
			// 		'recepient' 	: $scope.transaction.recepient,
			// 		'file' 			: $scope.transaction.file
			// 	}
            $http({
	            method 	: 'POST',
				url 	: '/' + type + '/create',
	            data: {
					title 			: $scope.transaction.title,
					description 	: $scope.transaction.description,
					recepient 		: $scope.transaction.recipient,
					file 			: $scope.transaction.file.name
	            }
			}).then(function(res){	
				console.log(res);
				if(res.data == "Success"){
					var fd = new FormData();
					//Take the first selected file
					fd.append("file", $scope.transaction.file);
					// console.log($scope.transaction.file);
					$http({
			            method 	: 'POST',
						url 	: '/send/createSample',
			            data 	: fd,
						headers: {'Content-Type': undefined }
					}).then(function(res){
						console.log(res);
					})
				}

			}, function(err){
				console.log(err);
			});
			// Upload.upload({
			// 	url: '/' + type + '/create',
			// 	data: {
			// 		'title' 		: $scope.transaction.title,
			// 		'description' 	: $scope.transaction.description,
			// 		'recepient' 	: $scope.transaction.recepient,
			// 		'file' 			: $scope.transaction.file
			// 	}
			// }).then(function (res) {
			// 	console.log(res);
			// }, function (res) {
			// 	console.log('Error status: ' + res.status);
			// });
		}
	}	
]);