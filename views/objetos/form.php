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
$objetos = empty($_GET['id']) ? new Objetos() : $objetosController->detail($_GET['id']);
$titulo = empty($_GET['id']) ? 'Registrar entrada' : 'Modificar entrada';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?php echo $titulo; ?></title>
</head>

<body>
    <a href="index.php?page=objetos">Volver</a>
    <div>
        <h1><?php echo $titulo; ?></h1>
        <form action="index.php?page=objetos&view=save" method="POST">
            <?php
            if (!empty($_GET['id'])) {
                echo '<input name="id" id="id" type="hidden" value="' . $objetos->get('id') . '">';
            }
            ?>

            <div>
                <label>Nombre:</label>
                <input name="nombre" id="nombre" type="text" value="<?php echo $entrada->get('nombre'); ?>" required>
            </div>
            <div>
                <label>Descripción:</label>
                <input name="descripcion" id="descripcion" type="text" value="<?php echo $entrada->get('descripcion'); ?>" required>
            </div>
            <div>
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</body>

</html>