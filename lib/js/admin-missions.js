/**
 * JS for handling the missions part of the dashboard.
 * * * * */

var app = angular.module('FCFBusiness', []);
app.factory('BusinessService', function($rootScope) {

  var businessComm = {
    business: {},
    message: ''
  }

  businessComm.sendBroadcast = function(business, msg) {
    this.business = business;
    this.message = msg;
    $rootScope.$broadcast(this.message);
  }

  return businessComm;

});

app.controller('BusinessFormCtrl', ["$scope", "$http",
  function($scope, $http) {

    $scope.sendBusiness = function() {

      $http({
        url: "/lib/php/api/business/index.php",
        method: "POST",
        data: {
          "name": $scope.businessName,
          "address": $scope.address,
          "zipCode": $scope.zip,
          "phone": $scope.phone,
          "email": $scope.email,
          "website": $scope.website,
          "speed": $scope.speed        }
      }).then($scope.refreshTable, $scope.showError);

    }

    $scope.refreshTable = function() {
      alert("It Worked");
    }

    $scope.showError = function() {

    }

    $scope.populateEdit = function() {

    }

}]);

app.controller("DeleteBizCtrl", ["$scope", "$http", function($scope, $http) {

}]);

app.controller("BusinessTable", ["$scope", "$http", function($scope, $http) {

  $scope.getBusinesses = function() {
    $http({
      url: "/lib/php/api/business/index.php",
      method: "GET"
    }).then(function(response) {

      $scope.businesses = response.data.data;

    }, $scope.showError);
  }

  $scope.showError = function() {

  }

  $scope.editBusiness = function(business) {

  }

  $scope.deleteBusiness = function(business) {


  }

}]);
