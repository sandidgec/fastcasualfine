<?php
require_once ("FCF.php");
require_once ("user.php");

$dsn = ' mysqli:host=' . $config["hostname"] . ';dbname=' . $config["database"];
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

$pdo = new PDO($dsn, $config["username"], $config["password"], $options);

$miss = new user(null, );

var_dump($miss);
try{
    $miss->insert($pdo)
}catch (PDOException $exception){
    echo $exception->getMessage();
}
