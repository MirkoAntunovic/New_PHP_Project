<?php
require('../vendor/autoload.php');

$openapi = \OpenApi\Generator::scan([$_SERVER['DOCUMENT_ROOT'].'/src']);

header('Content-Type: application/json');
echo $openapi->toJSON();