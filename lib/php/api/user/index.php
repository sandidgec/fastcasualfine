<?php
require_once(dirname(dirname(__DIR__)) . "/autoload.php");
require_once(dirname(dirname(__DIR__)) . "/xsrf.php");

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
    $userId = filter_input(INPUT_GET, "userID", FILTER_VALIDATE_INT);
    // sanitize the email
    $email = filter_input(INPUT_GET, "email", FILTER_SANITIZE_EMAIL);
    // grab the mySQL connection
    $pdo = connectToEncryptedMySql("");
    // handle all RESTful calls to User today
    // get some or all Users
    if($method === "GET") {
        // set an XSRF cookie on GET requests
        setXsrfCookie("/");
        if(empty($userId) === false) {
            $reply->data = user::getUserByUserID($pdo, $userID);
        } else {
            $reply->data = user::getAllUsers($pdo);
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
        $salt = bin2hex(openssl_random_pseudo_bytes(32));
        $hash = hash_pbkdf2("sha512", $requestObject->password, $salt, 262144, 128);
        // handle optional fields
        $user = new user($userID, $requestObject->name, false,
            $requestObject->zip, $requestObject->email, $requestObject->phone, $salt, $hash);
        $user->insert($pdo);
        $_SESSION["user"] = $user;
        $reply->data = "User created OK";
        // delete an existing User
    } else if($method === "DELETE") {
        verifyXsrf();
        $user = user::getUserByUserID($pdo, $userID);
        $user->delete($pdo);
        $reply->data = "User deleted OK";
        // put to an existing User
    } else if($method === "PUT") {
        // convert PUTed JSON to an object
        verifyXsrf();
        $requestContent = file_get_contents("php://input");
        $requestObject = json_decode($requestContent);

        $salt = bin2hex(openssl_random_pseudo_bytes(32));
        $hash = hash_pbkdf2("sha512", $requestObject->password, $salt, 262144, 128);
        $user = new user($userID, $requestObject->name, $requestObject->root,
            $requestObject->zip, $requestObject->email, $requestObject->phone, $salt, $hash);
        $user->update($pdo);
        $reply->data = "User updated OK";
    }
    // create an exception to pass back to the RESTful caller
} catch(Exception $exception) {
    $reply->status = $exception->getCode();
    $reply->message = $exception->getMessage();
    unset($reply->data);
}
header("Content-type: application/json");
echo json_encode($reply);