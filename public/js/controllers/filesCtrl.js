'use strict';
var files = angular.module("controllers.filesCtrl", [])

files.controller("filesCtrl", ["$rootScope", "$scope", "$window", "$location", "$http", "apiUrl",
	function($rootScope, $scope, $window, $location, $http, apiUrl){
		$('.modal').modal();
        $('.chips').chips()

		$scope.submitTransaction = function(type){

			if(($scope.transaction.file) && (typeof $scope.transaction.file == 'object')){
				uploadFile(type);
				return;
			} 
			storeDetails(type)

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
				if(res.data == 'Failed'){
					console.log("Upload failed");
					return;
				}
				console.log(res.data);
				storeDetails(type);
			});
		}

		var storeDetails = function(type){
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
				console.log(res.data);
			}, function(err){
				console.log(err);
			});
		}
	}	
]);