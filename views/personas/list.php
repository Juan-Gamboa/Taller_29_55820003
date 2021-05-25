<?php
require_once dirname(__DIR__) . '/../utils/model_util.php';
require_once dirname(__DIR__) . '/../db/conexion_db.php';
require_once dirname(__DIR__) . '/../models/model.php';
require_once dirname(__DIR__) . '/../models/personas.php';
require_once dirname(__DIR__) . '/../controllers/base_controller.php';
require_once dirname(__DIR__) . '/../controllers/personas_controller.php';

use controllers\PersonasController;


$personasController = new PersonasController();
?>
<!doctype HTML>
<html>

<head>
    <title>personas</title>
</head>

<body>
    <h1>Listado de personas</h1>
    <a href="index.php?page=personas&view=form">Registrar</a>
    <table>
        <thead>
            <tr>
                <th>tipo_identificación</th>
                <th>numero_identificación</th>
                <th>Nombres</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rows = $personasController->index();
            foreach ($rows as $row) {
                echo '<tr>';
                echo '  <td>', $row->get('tipo_identificacion'), '</td>';
                echo '  <td>', $row->get('numero_identificacion'),'</td>';
                echo '  <td>', $row->get('nombres'), '</td>';
            ?>
                <td>
                    <a href="index.php?page=personas&view=delete&id=<?php echo $row->get('id'); ?>">Eliminar</a>
                    <a href="index.php?page=personas&view=form&id=<?php echo $row->get('id'); ?>">Actualizar</a>
                    <button onclick="ver(<?php echo $row->get('id'); ?>)">Ver detalle</button>
                </td>
            <?php
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <select name="personas" id="personas">
        <?php
        $rows = $personasController->index();
        foreach ($rows as $row) {
            echo '<option value="' . $row->get('id') . '">' . $row->get('numero_identificacion'). $row->get('nombres') . '</option>';
        }
        ?>
    </select>
</body>

</html>