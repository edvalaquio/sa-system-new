'use strict';

angular.module("controllers.accountsCtrl", [])
.controller("accountsCtrl", ["$rootScope", "$scope", "$window", "$location", "$http",
	function($rootScope, $scope, $window, $location, $http){
		$('.modal').modal();
		function updateInterface(){
			$http({
				method	:	'GET',
				url		:	'/getAdmins'
			}).then(function(res){
				$scope.admins = res.data;
			});
			$http({
				method	: 	'GET',
				url		:	'/getStaffs'
			}).then(function(res){
				$scope.staffs = res.data;
			});
		}
		updateInterface();
		$('#register-form').change(checkFields);
		function checkFields(){
			if($('#username').val() && $('#name').val() && $('#email').val() && $('#password').val() && $('#password-confirm').val()){
				$('#register').removeClass("disabled");
				console.log("remove disabled");
			}else{
				$('#register').addClass('disabled');
				console.log("add disabled");
			}

		}

		// $scope.checkType = function(){
		// 	console.log($('input[name="type"]').val());
		// 	if($('input[name="type"]').val() == 'staff'){
		// 		console.log('slideUp');
		// 	}else{
		// 		$('#group-field').slideDown(150);
		// 	}
		// }
		$scope.staffClicked = function(){
			$('#group-field').slideUp(150);
		}

		$scope.adminClicked = function(){
			$('#group-field').slideDown(150);
		}

		$scope.registerUser = function(){
			$('#register-form')[0].reset();
			$http({
				method	:	'POST',
				url		:	'/account/createAccount',
				data	:	{
					username	:	$scope.username,
					name		:	$scope.name,
					email		: 	$scope.email,
					gender		: 	$scope.gender,
					type		:	$scope.type,
					group 		:	$scope.gender,
					password	:	$scope.password
				}
			}).then(function(res){
				console.log(res);
				console.log('success');
				updateInterface();
			},function(error){
				console.log(error);
			});
		}
	}
]);
