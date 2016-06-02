<?php
require_once("../../fastcasualfine.ini");
require_once("autoload.php");
require_once ("buisness.php");





// setup dsn and options
$dsn = 'mysql:host=' . $config["hostname"] . ';dbname=' . $config["database"];
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");


// set up pdo connection with database and set error attributes
$pdo = new PDO($dsn, $config["username"], $config["password"], $options);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


/*$bus = new Business(null,"5757 runnermill ne", "run@mill.com", null, "RunningMan", "878-9999", "fast", "www.running.com", 77777);

$bus->insert($pdo);
$bus->setEmail("LAME@mill.com");
$bus->setName("LAME Man");

try {
    $bus->update($pdo);
}catch (Exception $e) {
    echo $e->getMessage();
}*/


//$bus->delete($pdo);


//$bus = Business::getBusinessByBusinessId($pdo, 7);

//$businesses = Business::getAllBusiness($pdo);

//var_dump($businesses);
