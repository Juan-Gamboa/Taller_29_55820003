<?php

use controllers\PersonasController;
use models\Personas;

require_once dirname(__DIR__) . '/../utils/model_util.php';
require_once dirname(__DIR__) . '/../db/conexion_db.php';
require_once dirname(__DIR__) . '/../models/model.php';
require_once dirname(__DIR__) . '/../models/personas.php';
require_once dirname(__DIR__) . '/../controllers/base_controller.php';
require_once dirname(__DIR__) . '/../controllers/personas_controller.php';

$personasController = new PersonasController();

$request = [
    'tipo_identificacion' => $_POST['tipo_identificacion'],
    'numero_identificacion' => $_POST['numero_identificacion'],
    'nombres' => $_POST['nombres'],
];

$estado = empty($_POST['id']) ? $personasController->create($request) : $personasController->update($_POST['id'], $request);
$url = 'index.php?page=personas';
if ($estado != 'Registro actualizado' &&  !empty($_POST['id'])) {
    $url .= '&view=form&id=' . $_POST['id'];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro guardado</title>
</head>

<body>
    <div>
        <h1>Resultado de la operación</h1>
        <p>
            <?php echo $estado; ?>
        </p>
        <a href="<?php echo  $url; ?>">Volver</a>
    </div>
</body>

</html>