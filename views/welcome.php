<?php

require_once dirname(__DIR__) . '/utils/model_util.php';
require_once dirname(__DIR__) . '/db/conexion_db.php';
require_once  dirname(__DIR__) . '/models/model.php';
require_once dirname(__DIR__) . '/models/entradas.php';
require_once dirname(__DIR__) . '/models/personas.php';
require_once dirname(__DIR__) . '/models/objetos_inv.php';
require_once dirname(__DIR__) . '/models/salidas.php';
require_once dirname(__DIR__) . '/controllers/base_controller.php';
require_once dirname(__DIR__) . '/controllers/entradas_controller.php';
require_once dirname(__DIR__) . '/controllers/personas_controller.php';
require_once dirname(__DIR__) . '/controllers/objetos_inv_controller.php';
require_once dirname(__DIR__) . '/controllers/salidas_controller.php';

use controllers\EntradasController;
use controllers\PersonasController;
use controllers\ObjetosController;
use controllers\SalidasController;

/*$personasController = new PersonasController();
$status = $personasController->create([
     'tipo_identificacion' => 'CC',
     'numero_identificacion' => '12345',
    'nombres' => 'Juan Esteban'
]);
echo '<br>', $status, '<br>';*/

/*$objetosController = new ObjetosController();
$status = $objetosController->create([
     'nombre' => 'Papitas',
     'descripcion' => 'de pollo',
]);
echo '<br>', $status, '<br>';*/

/*$entradaController = new EntradasController();
$status = $entradaController->create([
         'fecha' => '22/05/2021',
         'cantidad' => 10,
        'persona_id' => 3,
         'objecto_inventario_id' => 1
     ]);
     echo '<br>', $status, '<br>';*/
/*$entradaController = new EntradasController();
$entradas =  $entradaController->index();
foreach ($entradas as $item) {
    echo  $item->get('fecha'), ' ', $item->get('id'), '<br/>';
}

// $status = $entradaController->create([
//     'fecha' => '22/05/2021',
//     'cantidad' => 'Test 2',
//     'persona_id' => 26,
//     'objecto_inventario_id' => '9999'
// ]);

// echo '<br>', $status, '<br>';

// $estudiante =  $estudianteController->detail(6);
// echo '<br/>', $estudiante->get('nombres'), '<br/>';

// $status = $estudianteController->create([
//     'nombres' => 'Test',
//     'apellidos' => 'Test 2',
//     'edad' => 26,
//     'codigo' => '9999'
// ]);

// echo '<br>', $status, '<br>';




/*$status = $estudianteController->update(29, [
    'nombres' => 'Test',
    'apellidos' => 'Test 2',
    'edad' => 30,
    'codigo' => '9999'
]);

echo '<br>', $status, '<br>';

$status = $estudianteController->delete(29);

echo '<br>', $status, '<br>';*/


// require_once('models/estudiante.php');

// $estudiante = new Estudiante();

// $estudiantes =  $estudiante->all();

// foreach ($estudiantes as $item) {
//     echo  $item->get('codigo'), ' ', $item->get('nombres'), '<br/>';
// }

// $rowEstudiante = new Estudiante();
// $result = $rowEstudiante->find(14);
// echo $result->get('apellidos'), '<br/>';


// $estudiante = new Estudiante();
// $estudiantes =  $estudiante->where([
//     ['nombres', 'like', '%J%'],
//     ['edad', '>', 18],
// ], 'or');

// foreach ($estudiantes as $item) {
//     echo  $item->get('codigo'), ' ', $item->get('nombres'), '<br/>';
// }

// echo empty($estudiantes) ? 'No hay datos' : '';


// $estudiante = new Estudiante();
// $estudiante->set('nombres', 'Maria');
// $estudiante->set('apellidos', 'Perez');
// $estudiante->set('edad', 25);
// $estudiante->set('codigo', '5555');
// $status = $estudiante->save();
// echo $status ? 'Datos registrados' : 'No hay datos registrados';

// $estudiante = new Estudiante();
// $estudiante->set('id', 28);
// $estudiante->set('nombres', 'Maria Test');
// $estudiante->set('apellidos', 'Perez');
// $estudiante->set('edad', 22);
// $estudiante->set('codigo', '11111');
// $status = $estudiante->update();
// echo $status ? 'Datos actualizados' : 'No hay datos actualizados';

// $estudiante = new Estudiante();
// $estudiante->set('id', 28);
// $status = $estudiante->delete();
// echo $status ? 'Datos eliminados' : 'No hay datos eliminados';
