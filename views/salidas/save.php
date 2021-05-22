<?php

use controllers\SalidasController;
use models\Salidas;

require_once dirname(__DIR__) . '/../utils/model_util.php';
require_once dirname(__DIR__) . '/../db/conexion_db.php';
require_once dirname(__DIR__) . '/../models/model.php';
require_once dirname(__DIR__) . '/../models/salidas.php';
require_once dirname(__DIR__) . '/../controllers/base_controller.php';
require_once dirname(__DIR__) . '/../controllers/salidas_controller.php';

$salidasController = new SalidasController();

$request = [
    'fecha' => $_POST['fecha'],
    'cantidad' => $_POST['cantidad'],
    'persona_id' => $_POST['persona_id'],
    'objecto_inventario_id' => $_POST['objecto_inventario_id'],
];

$estado = empty($_POST['id']) ? $salidasController->create($request) : $salidasController->update($_POST['id'], $request);
$url = 'index.php?page=salidas';
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