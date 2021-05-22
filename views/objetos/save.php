<?php

use controllers\ObjetosController;
use models\Objetos;

require_once dirname(__DIR__) . '/../utils/model_util.php';
require_once dirname(__DIR__) . '/../db/conexion_db.php';
require_once dirname(__DIR__) . '/../models/model.php';
require_once dirname(__DIR__) . '/../models/objetos_inv.php';
require_once dirname(__DIR__) . '/../controllers/base_controller.php';
require_once dirname(__DIR__) . '/../controllers/objetos_inv_controller.php';

$objetosController = new ObjetosController();

$request = [
    'nombre' => $_POST['nombre'],
    'descripcion' => $_POST['descripcion'],
];

$estado = empty($_POST['id']) ? $objetosController->create($request) : $objetosController->update($_POST['id'], $request);
$url = 'index.php?page=objetos';
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