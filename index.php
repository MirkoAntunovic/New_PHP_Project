<?php

declare (strict_types=1);



spl_autoload_register(function ($class){

	require __DIR__.  "/src/$class.php";



});




$parts = explode("/", $_SERVER["REQUEST_URI"]);

if ($parts[1] != "start"){

	http_response_code(404);
	exit;

}
header('Content-Type:application/json');


$endpoint = $parts[2] ?? null;

$Database = new Database("localhost","db_task","root","");

$gateway=new taskGateway($Database);


$controller = new taskController($gateway);
$controller->processRequest($_SERVER["REQUEST_METHOD"], $endpoint);



?>