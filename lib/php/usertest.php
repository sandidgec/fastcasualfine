<?php
require_once("../../fastcasualfine.ini");
require_once("autoload.php");






// setup dsn and options
$dsn = 'mysql:host=' . $config["hostname"] . ';dbname=' . $config["database"];
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");


// set up pdo connection with database and set error attributes
$pdo = new PDO($dsn, $config["username"], $config["password"], $options);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$salt="3b2833ce331050deb3bca56f2e5453ac6091c0031267677993fe1ba57702c109";
$hash="5fa3df4d20b51448120c978f0124d3475e143111db7517428e9820eb1f486c02d274d9693c45d020c52c20cb6e0ccf71498fa8a312f999fb83297f56b71e9518";

/*$n = new user(null, "john", "dontknow@mail.com", "5053605662", "85613", $salt, $hash);



$n->insert($pdo);
$n->setEmail("stuff@fake.com");
$n->setName("Bob");

try{
    $n->update($pdo);
}catch(Exception $e){
    echo $e->getMessage();
}

$n->delete($pdo);*/
//$n = User::getUserByUserID($pdo, 6);

$users = user::getAllUsers($pdo);

var_dump($n);
