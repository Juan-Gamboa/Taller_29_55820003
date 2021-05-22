<?php
require_once dirname(__DIR__) . '/../utils/model_util.php';
require_once dirname(__DIR__) . '/../db/conexion_db.php';
require_once dirname(__DIR__) . '/../models/model.php';
require_once dirname(__DIR__) . '/../models/objetos_inv.php';
require_once dirname(__DIR__) . '/../controllers/base_controller.php';
require_once dirname(__DIR__) . '/../controllers/objetos_inv_controller.php';

use controllers\ObjetosController;


$objetosController = new ObjetosController();
?>
<!doctype HTML>
<html>

<head>
    <title>objetos</title>
</head>

<body>
    <h1>Listado de objetos</h1>
    <a href="index.php?page=objetos&view=form">Registrar</a>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rows = $objetosController->index();
            foreach ($rows as $row) {
                echo '<tr>';
                echo '  <td>', $row->get('nombre'), '</td>';
                echo '  <td>', $row->get('descripcion'),'</td>';
            ?>
                <td>
                    <a href="index.php?page=objetos&view=delete&id=<?php echo $row->get('id'); ?>">Eliminar</a>
                    <a href="index.php?page=objetos&view=form&id=<?php echo $row->get('id'); ?>">Actualizar</a>
                    <button onclick="ver(<?php echo $row->get('id'); ?>)">Ver detalle</button>
                </td>
            <?php
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <select name="objetos" id="objetos">
        <?php
        $rows = $objetosController->index();
        foreach ($rows as $row) {
            echo '<option value="' . $row->get('id') . '">' . $row->get('nombre'). $row->get('descripcion') . '</option>';
        }
        ?>
    </select>
</body>

</html>