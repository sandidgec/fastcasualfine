var app = angular.module('tweetwall', []);

app.controller('TweetCtrl', ["$scope", "$http", function($scope, $http) {

  $scope.getTweets = function() {

    $http({
      method: "GET"
      url: "/lib/php/api/tweets/index.php?count=5"
    });

  }
}]);
