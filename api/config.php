<?php
require_once dirname(__DIR__) . '/utils/model_util.php';
require_once dirname(__DIR__) . '/db/conexion_db.php';
require_once dirname(__DIR__) . '/models/model.php';
require_once dirname(__DIR__) . '/controllers/base_controller.php';
require_once dirname(__DIR__) . '/api/parse_array_reponse.php';
require_once dirname(__DIR__) . '/api/response.php';

$uriRelativeApp =  '/Programacion_avanzada/Taller_29_55820003/Taller_29_55820003/';

$uriClass = [
    "entradas" => [
        'model' => 'models/entradas.php',
        'controller' => 'controllers/entradas_controller.php'
    ],
    "personas" => [
        'model' => 'models/personas.php',
        'controller' => 'controllers/personas_controller.php'
    ],
    "objetos" => [
        'model' => 'models/objetos_inv.php',
        'controller' => 'controllers/objetos_inv_controller.php'
    ],
    "salidas" => [
        'model' => 'models/salidas.php',
        'controller' => 'controllers/salidas_controller.php'
    ],
];

$controllers = [
    "entradas" => 'controllers\EntradasController',
    "personas" => 'controllers\PersonasController',
    "objetos" => 'controllers\ObjetosController',
    "salidas" => 'controllers\SalidasController'
];


$getArrayUrlCurrent = function () {
    $urlData = str_replace($GLOBALS['uriRelativeApp'], '', $_SERVER['REQUEST_URI']);
    $urlArray  =  explode('/', $urlData);
    return  $urlArray;
};

