'use strict';
var files = angular.module("controllers.filesCtrl", [])

files.controller("filesCtrl", ["$rootScope", "$scope", "$window", "$location", "$http", "apiUrl",
	function($rootScope, $scope, $window, $location, $http, apiUrl){
		$('.modal').modal();
        $('.chips').chips();
        $scope.uploading = false;


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
				console.log(res.data);
				storeDetails(type, true);
			});
		}

		var storeDetails = function(type, hasFile){
			var tempData = {
				title 			: $scope.transaction.title,
				description 	: $scope.transaction.description,
				recepient 		: $scope.transaction.recipient
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
				console.log(res.data);
			}, function(err){
				console.log(err);
			});
			$scope.uploading = false;
		}
	}	
]);