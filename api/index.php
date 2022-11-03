<?php
// error_reporting(E_ALL);
// ini_set("display_errors",1);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, token, sesion");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

require './common/conn-altorouter-lib.php';
require './common/conn-bd.php';

foreach (glob("mapping/*.php") as $filename)
{
    include $filename;
}

// match current request url
$match = $router->match();

// call closure or throw 404 status
if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	// no route was matched
	print(json_encode(array('response' => 'error', 'message' => "Web service not found")));
}

?>