<?php
//require_once(dirname(dirname(__DIR__)) . "/classes/autoload.php");
//require_once(dirname(dirname(__DIR__)) . "/lib/xsrf.php");
//require_once("/etc/apache2/data-design/encrypted-config.php");
// start the session and create a XSRF token
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
// prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;
try {
    // determine which HTTP method was used
    $method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];
    // sanitize the Id's
    $reviewId = filter_input(INPUT_GET, "reviewId", FILTER_VALIDATE_INT);

    $businessId = filter_input(INPUT_GET, "businessId", FILTER_VALIDATE_INT);

    $userId = filter_input(INPUT_GET, "userId", FILTER_VALIDATE_INT);

    // grab the mySQL connection
    //$pdo = connectToEncryptedMySql("/etc/apache2/capstone-mysql/invtext.ini");
    // handle all RESTful calls to User today
    // get some or all Users
    if($method === "GET") {
        // set an XSRF cookie on GET requests
        setXsrfCookie("/");
        if (empty($reviewId) === false) {
            $reply->data = Review::getReviewByReviewId($pdo, $reviewId);
        } else if (empty($buisnessId) === false) {
            $reply->data = Review::getReviewByBusinessId($pdo, $businessId);
        } else if (empty($userId) === false){
            $reply->data = Review::getReviewByUserId($pdo, $userId);
        } else {
            $reply->data = Review::getAllReview ($pdo);
        }
        // post to a new User
    } else if($method === "POST") {
        // convert POSTed JSON to an object
        verifyXsrf();
        $requestContent = file_get_contents("php://input");
        $requestObject = json_decode($requestContent);
        if($requestObject->password !== $requestObject->passwordConfirm) {
            throw(new InvalidArgumentException("passwords do not match", 400));
        }


        // handle optional fields
        $businessId = (empty($requestObject->businessId) === true ? null : $requestObject->businessId);
        $userId = (empty($requestObject->userId) === true ? null : $requestObject->userId);
        $rating = (empty($requestObject->rating) === true ? null : $requestObject->rating);
        $time = (empty($requestObject->time) === true ? null : $requestObject->time);

        $review = new Review($reviewId, $requestObject->businessID, $requestObject->userId, $requestObject->rating,
            $requestObject->time);
        $review->insert($pdo);
        $_SESSION["review"] = $review;
        $reply->data = "Review created OK";
        // delete an existing User
    } else if($method === "DELETE") {
        verifyXsrf();
        $review = Review::getReviewByReviewId($pdo, $reviewId);
        $review->delete($pdo);
        $reply->data = "User deleted OK";
        // put to an existing User
    } else if($method === "PUT") {
        // convert PUTed JSON to an object
        verifyXsrf();
        $requestContent = file_get_contents("php://input");
        $requestObject = json_decode($requestContent);

        $review = new Review($reviewId, $requestObject->businessID, $requestObject->userId, $requestObject->rating,
            $requestObject->time);

        $review->update($pdo);

        $reply->data = "Review updated OK";
    }
    // create an exception to pass back to the RESTful caller
} catch(Exception $exception) {
    $reply->status = $exception->getCode();
    $reply->message = $exception->getMessage();
    unset($reply->data);
}
header("Content-type: application/json");
echo json_encode($reply);