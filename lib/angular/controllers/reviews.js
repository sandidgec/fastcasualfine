

app.controller("reviewController", function($scope)
{
    $scope.reviewID = null;
    $scope.businessID = [];
    $scope.userID = [];
    $scope.rating = [];
    $scope.date = [];
    
        $scope.addReview = functions(review) 
    {       var newReview = {}

    };
        $scope.getReviewByReviewId =
           function(fromReview) {

               ReviewService.getReviewByReviewId(fromReview)
                   .then(function(reply) {
                       if(reply.status === 200) {
                           $scope.review = reply.data;
                       } else {
                           $scope.statusClass = "alert-danger";
                           $scope.statusMessage = reply.message;
                       }
                   });
                };
        $scope.getreviewByBusinessId =
            function(fromReview) {
                ReviewService.getreviewByBusinessId(fromReview)
                    .then(function(reply){
                        if(reply.status === 200) {
                            
                        }
                    })
            }

});