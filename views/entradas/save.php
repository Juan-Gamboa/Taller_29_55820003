<?php

use controllers\EntradasController;
use models\Entradas;

require_once dirname(__DIR__) . '/../utils/model_util.php';
require_once dirname(__DIR__) . '/../db/conexion_db.php';
require_once dirname(__DIR__) . '/../models/model.php';
require_once dirname(__DIR__) . '/../models/entradas.php';
require_once dirname(__DIR__) . '/../controllers/base_controller.php';
require_once dirname(__DIR__) . '/../controllers/entradas_controller.php';

$entradasController = new EntradasController();

$request = [
    'fecha' => $_POST['fecha'],
    'cantidad' => $_POST['cantidad'],
    'persona_id' => $_POST['persona_id'],
    'objecto_inventario_id' => $_POST['objecto_inventario_id'],
];

$estado = empty($_POST['id']) ? $entradasController->create($request) : $entradasController->update($_POST['id'], $request);
$url = 'index.php?page=entradas';
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