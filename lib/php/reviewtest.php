<?php
require_once("../../fastcasualfine.ini");
require_once("autoload.php");


// setup dsn and options
$dsn = 'mysql:host=' . $config["hostname"] . ';dbname=' . $config["database"];
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");


// set up pdo connection with database and set error attributes
$pdo = new PDO($dsn, $config["username"], $config["password"], $options);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*
$r = new review(null, 1, 1, "fast", null);
try {
    $r->insert($pdo);
}catch(Exception $e){
    echo $e->getMessage();
}

$r->setRating("casual");
try {
    $r->update($pdo);
}catch(Exception $e){
    echo $e->getMessage();
}

//$r->delete($pdo);
*/

//$r = review::getReviewByReviewID($pdo, 19);

//$rList = review::getAllReviews($pdo);
//var_dump($rList);