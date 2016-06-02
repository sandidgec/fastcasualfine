<?php
/**
 * Pretty simple.  Contains a single function that can be reused for
 * establishing a database connection via ini file.
 * * * * */

function establishConn($iniFile) {

  if (!array_key_exists('dbConn', $GLOBALS)) {

    $db = parse_ini_file($iniFile);

    $user = $db['user'];
    $pass = $db['pass'];
    $name = $db['name'];
    $host = $db['host'];
    $type = $db['type'];

    // NOTE: Make sure you close this by making dbConn = null anytime you
    // expect the server to crash / shut down for whatever reason.
    $GLOBALS['dbConn'] = new PDO($type . ":host=" . $host . ";dbname=" . $name,
      $user, $pass, array(PDO::ATTR_PERSISTENT => true));

  }

  return $GLOBALS['dbConn'];

}

?>
