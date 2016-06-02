/**
 * JS for handling the missions part of the dashboard.
 * * * * */

var app = angular.module('FCFBusiness', []);
app.factory('businessService', function($rootScope) {

  var businessService = {
    business: {},
    message: ''
  }

  businessService.sendBroadcast = function(business, msg) {
    this.business = business;
    this.message = msg;
    $rootScope.$broadcast(this.message);
  }

  return businessService;

});

app.controller('BusinessFormCtrl', ["$scope", "$http", "businessService",
  function($scope, $http, businessService) {

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

app.controller("DeleteBizCtrl", ["$scope", "$http", "businessService",
  function($scope, $http, businessService) {

    $scope.$on('DELETE', function() {

      $scope.business = businessService.business;
      $("#deleteBusinessModal").modal('show');

    });

    $scope.delete = function() {

      $http({
        url: "/lib/php/api/business/index.php",
        method: "DELETE",
        params: {"BusinessId": $scope.business.businessId}
      }).then($scope.deleteSuccess, $scope.deleteFail);

    }

    $scope.deleteSuccess = function() {

      $("#deleteBusinessModal").modal('hide');

    }

}]);

app.controller("BusinessTable", ["$scope", "$http", "businessService",
  function($scope, $http, businessService) {

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

    businessService.sendBroadcast(business, "DELETE");

  }

}]);
