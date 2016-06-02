var app = angular.module('BusinessNg',[]);


/*
    controller for the movement service
*/
app.controller("businessController", function($scope,BusinessService)
{
    $scope.businesses = null;
    $scope.address = [];
    $scope.email = [];
    $scope.images = [];
    $scope.name = [];
    $scope.phone = [];
    $scope.speed = [];
    $scope.website = [];
    $scope.zip = [];


        $scope.addBusiness = function(business) {
             var newBusiness = {
                 fromBusinessId: business.fromBuisnessId,
                 toBusinessId: business.toBuisnesssId
             };
             BusinessService.addBusiness(business)
                 .then(function(reply){
                     if(reply.status === 200) {
                         $scope.getALLBusiness(0);
                     } else {
                         $scope.statusClass = "alert-danger";
                         $scope.statusMessage = reply.message;
                     }
                 });
         };

        $scope.getBusinessByBusinessId =
           function(fromBusiness) {

            BusinessService.getBusinessByBusinessId(fromBusiness)
                .then(function(reply) {
                    if(reply.status === 200) {
                        $scope.businesses = reply.data;
                    } else {
                        $scope.statusClass = "alert-danger";
                        $scope.statusMessage = reply.message;
                    }
                });
             };
        $scope.getBusinessByAddress =
            function(toAddress) {

            BusinessService.getBusinessByAddress(toAddress)
                .then(function(reply) {
                    if(reply.status === 200) {
                        $scope.businesses = reply.data;
                    } else {
                        $scope.statusClass = "alert-danger";
                        $scope.statusMessage = reply.message;
                    }
                });
             };
        $scope.getBusinessByEmail =
            function(toEmail) {

            BusinessService.getBusinessByEmail(toEmail)
                .then(function(reply) {
                    if(reply.status === 200) {
                        $scope.businesses = reply.data;
                    } else {
                        $scope.statusClass = "alert-danger";
                        $scope.statusMessage = reply.message;
                    }
                });
            };
        $scope.getBusinessByImages =
            function(toImages) {

            BusinessService.getBusinessByImages(toImages)
                .then(function(reply) {
                    if(reply.status === 200) {
                        $scope.businesses = reply.data;
                    } else {
                        $scope.statusClass = "alert-danger";
                        $scope.stautsMessage = reply.message;
                    }
                });
            };
        $scope.getBusinessByName =
            function(toName) {

            BusinessService.getBusinessByName(toName)
                .then(function(reply){
                    if(reply.status === 200) {
                        $scope.businesses = reply.data;
                    } else {
                        $scope.statusClass = "alert-danger";
                        $scope.statusMessage = reply.message;
                    }
                });
            };
        $scope.getBusinessByPhone =
            function(toPhone) {

            BusinessService.getBusinessByPhone(toPhone)
                .then(function(reply){
                    if(reply.status === 200) {
                        $scope.businesses = reply.data;
                    } else {
                        $scope.statusClass = "alert-danger";
                        $scope.statusMessage = reply.message;
                    }
                });
            };
        $scope.getBusinessBySpeed =
            function(toSpeed) {

            BusinessService.getBusinessBySpeed(toSpeed)
                .then(function(reply){
                    if(reply.status === 200) {
                        $scope.businesses = reply.data;
                    } else {
                        $scope.statusClass = "alert-danger";
                        $scope.statusMessage = reply.message;
                    }
                });
            };
        $scope.getBuisnessByWebsite =
            function(toWebsite) {

            BusinessService.getBuisnessByWebsite(toWebsite)
                .then(function(reply){
                    if(reply.status === 200) {
                        $scope.businesses = reply.data;
                    } else {
                        $scope.statusClass = "alert-danger";
                        $scope.statusMessage = reply.message;
                    }
                });
            };
        $scope.getBusinessByZip =
            function(toZip) {

            BusinessService.getBusinessByZip(toZip)
                .then(function(reply) {
                    if(reply.status === 200) {
                        $scope.businesses = reply.data;
                    } else {
                        $scope.statusClass = "alert-danger";
                        $scope.statusMessage = reply.message;
                    }
                });
            };
});

