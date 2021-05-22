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
$salida = empty($_GET['id']) ? new Salidas() : $salidasController->detail($_GET['id']);
$titulo = empty($_GET['id']) ? 'Registrar salida' : 'Modificar salida';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?php echo $titulo; ?></title>
</head>

<body>
    <a href="index.php?page=salidas">Volver</a>
    <div>
        <h1><?php echo $titulo; ?></h1>
        <form action="index.php?page=salidas&view=save" method="POST">
            <?php
            if (!empty($_GET['id'])) {
                echo '<input name="id" id="id" type="hidden" value="' . $salida->get('id') . '">';
            }
            ?>

            <div>
                <label>Fecha:</label>
                <input name="fecha" id="fecha" type="text" value="<?php echo $salida->get('fecha'); ?>" required>
            </div>
            <div>
                <label>Cantidad:</label>
                <input name="cantidad" id="cantidad" type="text" value="<?php echo $salida->get('cantidad'); ?>" required>
            </div>
            <div>
                <label>Persona_id:</label>
                <input name="persona_id" id="Persona_id" type="text" value="<?php echo $salida->get('persona_id'); ?>" required>
            </div>
            <div>
                <label>objecto_inventario_id:</label>
                <input name="objecto_inventario_id" id="objecto_inventario_id" type="number" value="<?php echo $salida->get('objecto_inventario_id'); ?>" required>
            </div>
            <div>
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</body>

</html>