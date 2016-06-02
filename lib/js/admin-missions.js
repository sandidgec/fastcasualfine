/**
 * JS for handling the missions part of the dashboard.
 * * * * */

var app = angular.module('FCFBusiness', []);

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

}]);
