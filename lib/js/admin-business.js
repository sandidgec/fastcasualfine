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

    $scope.method = "POST";

    // If we're editing something, then we're going to populate our model with
    // whatever the business has for its values
    $scope.$on('EDIT', function() {

      $scope.method = "PUT";

      var business = businessService.business;

      $scope.businessId = business.businessId;
      $scope.businessName = business.name;
      $scope.address = business.address;
      $scope.zip = business.zip;
      $scope.phone = business.phone;
      $scope.email = business.email;
      $scope.website = business.website;
      $scope.speed = business.speed;

      $("#businessFormModal").modal('show');

    })

    $scope.sendBusiness = function() {

      $http({
        url: "/lib/php/api/business/index.php",
        method: $scope.method,
        params: {"BusinessId": $scope.businessId},
        data: {
          "name": $scope.businessName,
          "address": $scope.address,
          "zip": $scope.zip,
          "phone": $scope.phone,
          "email": $scope.email,
          "website": $scope.website,
          "speed": $scope.speed        }
      }).then($scope.refreshTable, $scope.showError);

    }

    $scope.refreshTable = function() {
      $("#businessFormModal").modal('hide');
      businessService.sendBroadcast({}, 'REFRESH');
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
      businessService.sendBroadcast({}, 'REFRESH');

    }

}]);

app.controller("BusinessTable", ["$scope", "$http", "businessService",
  function($scope, $http, businessService) {

  $scope.$on('REFRESH', function() {
    $scope.getBusinesses();
  });

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
    businessService.sendBroadcast(business, "EDIT");
  }

  $scope.deleteBusiness = function(business) {
    businessService.sendBroadcast(business, "DELETE");
  }

}]);
