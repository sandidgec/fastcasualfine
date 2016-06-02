<?php
require_once(dirname(dirname(__DIR__)) . "/autoload.php");
require_once(dirname(dirname(__DIR__)) . "/dbconnect.php");
require_once(dirname(dirname(__DIR__)) . "/business.php");
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
    // sanitize the userId
    $businessId = filter_input(INPUT_GET, "BusinessId", FILTER_VALIDATE_INT);

    // Grab the mySQL connection
    // NOTE: This one is only used for Nginx servers
    $pdo = establishConn("/usr/share/nginx/fcf_db.ini");
    // NOTE: This is the one you use for Apache web servers.
    //$pdo = establishConn("/etc/apache2/capstone-mysql/invtext.ini");

    if($method === "GET") {

        // set an XSRF cookie on GET requests
        //setXsrfCookie("/");
        if(empty($businessId) === false) {
            $reply->data = Business::getBusinessByBusinessId($pdo, $userId);
        } else {
            $reply->data = Business::getAllBusiness($pdo);
        }
        // post to a new User

    } else if($method === "POST") {

        // convert POSTed JSON to an object
        //verifyXsrf();

        $requestContent = file_get_contents("php://input");
        $requestObject = json_decode($requestContent);

        $business = new Business(
          $businessId,
          $requestObject->name,
          $requestObject->address,
          $requestObject->zip,
          $requestObject->phone,
          $requestObject->email,
          $requestObject->website,
          $requestObject->speed,
          "" // Leaving Images Blank for now
        );

        $business->insert($pdo);
        $_SESSION["business"] = $business;
        $reply->data = "Business created OK";
        // delete an existing User

    } else if($method === "DELETE") {

        //verifyXsrf();
        $business = Business::getBusinessByBusinessId($pdo, $businessId);
        $business->delete($pdo);
        $reply->data = "Business deleted OK";

        // put to an existing User
    } else if($method === "PUT") {

        // convert PUTed JSON to an object
        //verifyXsrf();
        $requestContent = file_get_contents("php://input");
        $requestObject = json_decode($requestContent);

        $business = new Business(
          $businessId,
          $requestObject->name,
          $requestObject->address,
          $requestObject->zip,
          $requestObject->phone,
          $requestObject->email,
          $requestObject->website,
          $requestObject->speed,
          "" // Leaving Images Blank for now
        );
        
        $business->update($pdo);
        $reply->data = "Business updated OK";

    }
    // create an exception to pass back to the RESTful caller
} catch(Exception $exception) {
    $reply->status = $exception->getCode();
    $reply->message = $exception->getMessage();
    unset($reply->data);
}
header("Content-type: application/json");
echo json_encode($reply);
