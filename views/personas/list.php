<?php
require_once dirname(__DIR__) . '/../utils/model_util.php';
require_once dirname(__DIR__) . '/../db/conexion_db.php';
require_once dirname(__DIR__) . '/../models/model.php';
require_once dirname(__DIR__) . '/../models/entradas.php';
require_once dirname(__DIR__) . '/../controllers/base_controller.php';
require_once dirname(__DIR__) . '/../controllers/entradas_controller.php';

use controllers\EntradasController;


$entradasController = new EntradasController();
?>
<!doctype HTML>
<html>

<head>
    <title>Entradas</title>
</head>

<body>
    <h1>Listado de entradas</h1>
    <a href="index.php?page=entradas&view=form">Registrar</a>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Cantidad</th>
                <th>Persona_id</th>
                <th>objecto_inventario_id</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rows = $entradasController->index();
            foreach ($rows as $row) {
                echo '<tr>';
                echo '  <td>', $row->get('fecha'), '</td>';
                echo '  <td>', $row->get('cantidad'),'</td>';
                echo '  <td>', $row->get('persona_id'), '</td>';
                echo '  <td>', $row->get('objecto_inventario_id'), '</td>';
            ?>
                <td>
                    <a href="index.php?page=entradas&view=delete&id=<?php echo $row->get('id'); ?>">Eliminar</a>
                    <a href="index.php?page=entradas&view=form&id=<?php echo $row->get('id'); ?>">Actualizar</a>
                    <button onclick="ver(<?php echo $row->get('id'); ?>)">Ver detalle</button>
                </td>
            <?php
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <select name="entradas" id="entradas">
        <?php
        $rows = $entradasController->index();
        foreach ($rows as $row) {
            echo '<option value="' . $row->get('id') . '">' . $row->get('cantidad'). $row->get('objecto_inventario_id') . '</option>';
        }
        ?>
    </select>
</body>

</html>