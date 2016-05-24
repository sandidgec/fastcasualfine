<?php
/**
* automatically loads the class on demand
*
* @param string $className class name to load
* @return bool true if the class loaded correctly, false if not
**/
function loadClass($user) {
$user[0] = strtolower($user[0]);
$user = preg_replace_callback("/([A-Z])/", function($matches) {
return("-" . strtolower($matches[0]));
}, $user);
$classFile = __DIR__ . "/" . $user . ".php";
if(is_readable($classFile) === true && require_once($classFile)) {
return(true);
} else {
return(false);
}
}