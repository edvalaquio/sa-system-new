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
				console.log(res.data);
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

		$scope.registerUser = function(){
			var formdata = $('#register-form').serialize();
			$http({
				method	:	'POST',
				url		:	'/account/createAccount',
				data	:	formdata,
			}).then(function(res){
				console.log(res);
				console.log('success');
				updateInterface();
			},function(error){
				console.log("error");
			});
		}
	}
]);
