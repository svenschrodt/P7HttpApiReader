<?php 

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// var_dump($_SERVER);
$method = $_SERVER['REQUEST_METHOD'];
echo '<h1>' . $method . '</h1>';
print_r($_REQUEST);

/* PUT Daten kommen in den stdin Stream */
if ('PUT' === $method) {
    $foo = file_get_contents('php://input');
    parse_str($foo, $me);
    var_dump($me); //$_PUT contains put fields
    
    var_dump($_SERVER['QUERY_STRING']);
}