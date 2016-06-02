var app = angular.module('fastcasualfine', []);

app.controller('TweetCtrl', ["$scope", "$http", function($scope, $http) {

  $scope.getTweets = function() {

    $http({
      method: "GET",
      url: "/lib/php/api/tweets/index.php?count=5"
    }).then($scope.loadTweets, $scope.hideCarousel);

  }

  $scope.loadTweets = function(response) {
    $scope.tweets = response.data;
  }

  $scope.hideCarousel = function() {

  }
}]);
