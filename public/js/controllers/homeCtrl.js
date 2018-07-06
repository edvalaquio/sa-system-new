'use strict';

angular.module("controllers.homeCtrl", [])
.controller("homeCtrl", ["$rootScope", "$scope", "$window", "$location", "$http", 'getUserID',
	function($rootScope, $scope, $window, $location, $http, getUserID){
		console.log("Here in HomeCtrl");
		console.log(getUserID);
		// this function will format the date to fit the requirement for the database
		var formatDate = function(date) {
		    var d = new Date(date),
		        month = '' + (d.getMonth() + 1),
		        day = '' + d.getDate(),
		        year = d.getFullYear();

		    if (month.length < 2) month = '0' + month;
		    if (day.length < 2) day = '0' + day;

		    return [year, month, day].join('-');
		}

		var queryDate = function(date){
			$http({
				'method'	: 'GET',
				'url'		: '/home/' + date
			}).then(function(res){
				$scope.transactions = res.data;
				$scope.transactions.forEach(function(item, index){
					item.date = new Date(item.date);
				});
				$scope.viewTransaction = $scope.transactions[0];
				console.log(res.data);
			}, function(error){
				console.log(error);
			});
		}

	    $('.datepicker').datepicker();
		$('.datepicker').change(function(){
			console.log(new Date($('.datepicker').val()));
			queryDate(formatDate(new Date($('.datepicker').val())));
		});
		// $http.post('home').then(function(response){
		// 	console.log(response.data);
		// });
		var mDate = formatDate(new Date());
		queryDate(mDate);

		$scope.showTransaction = function(data){
			$scope.viewTransaction = data;
		};

		$scope.changeDate = function(data){
			var mDate = new Date();
			if(data == 'yesterday'){
				var yesterday = new Date(mDate);
				yesterday.setDate(mDate.getDate() - 1);
				mDate = yesterday;
			}
			queryDate(formatDate(mDate));
		};

	}
]);
