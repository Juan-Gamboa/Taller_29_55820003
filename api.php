<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

use api\Routers;

require_once dirname(__DIR__) . '/Taller_29_55820003/api/routers.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
} else {
    Routers::response($method);
}
