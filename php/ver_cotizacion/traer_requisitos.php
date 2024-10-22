<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->

<!-- ------------------------------------------------------------------------------------------------------------
    ------------------------------------- INICIO ITred Spa Traer requisitos .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
    <?php
// Variable para almacenar mensajes de error y éxito
$mensaje_error = '';
$mensaje_exito = '';

// Verificar si $items no es nulo antes de realizar la consulta
if ($items !== null) {
    // Consulta para obtener los requisitos básicos
    $query_requisitos = "SELECT er.id_requisitos, er.indice, er.descripcion_condiciones 
                            FROM C_Cotizaciones cot
                            JOIN em_Requisitos_Basicos er ON er.id_empresa = cot.id_empresa
                            WHERE cot.id_cotizacion = ?";
    
    if ($stmt_req = $mysqli->prepare($query_requisitos)) {
        // Vincular el parámetro de la consulta
        $stmt_req->bind_param('i', $id_cotizacion);
        // Ejecutar la consulta
        if ($stmt_req->execute()) {
            // Obtener el resultado de la consulta
            $result_req = $stmt_req->get_result();
            // Obtener todos los requisitos como un arreglo asociativo
            $requisitos = $result_req->fetch_all(MYSQLI_ASSOC);
            // Cerrar la declaración
            $stmt_req->close();

            if (empty($requisitos)) {
                $mensaje_error = "<p>No hay requisitos básicos disponibles para esta cotización.</p>";
            }
        } else {
            // Mostrar error si la consulta falla
            $mensaje_error = "<p>Error al ejecutar la consulta de requisitos: " . $stmt_req->error . "</p>";
        }
    } else {
        // Mostrar error si no se pudo preparar la consulta
        $mensaje_error = "<p>Error al preparar la consulta de requisitos: " . $mysqli->error . "</p>";
    }
} else {
    // Mostrar mensaje si no se encontró la empresa
    $mensaje_error = "<p>No se encontró la empresa con el ID proporcionado.</p>";
}

// Consulta para obtener los requisitos seleccionados
$query_requisitos_seleccionados = "
    SELECT r.id_requisitos, r.indice, r.descripcion_condiciones
    FROM em_Requisitos_Basicos AS r
    JOIN c_cotizaciones_requisitos AS cr ON r.id_requisitos = cr.id_requisitos
    WHERE cr.id_cotizacion = ?
";

// Preparar y ejecutar la consulta para obtener requisitos seleccionados
if ($stmt_requisitos_seleccionados = $mysqli->prepare($query_requisitos_seleccionados)) {
    $stmt_requisitos_seleccionados->bind_param("i", $id_cotizacion);
    $stmt_requisitos_seleccionados->execute();
    $result_requisitos_seleccionados = $stmt_requisitos_seleccionados->get_result();

    // Verificar si hay resultados de requisitos seleccionados
    $requisitos_seleccionados = [];
    if ($result_requisitos_seleccionados->num_rows > 0) {
        while ($row = $result_requisitos_seleccionados->fetch_assoc()) {
            $requisitos_seleccionados[] = $row; // Guardar los requisitos en el array
        }
    } else {
        $mensaje_error .= "<p>No se encontraron requisitos seleccionados para esta cotización.</p>";
    }

    // Cerrar la conexión de la consulta de requisitos seleccionados
    $stmt_requisitos_seleccionados->close();
}
?>

<link rel="stylesheet" href="../../css/ver_cotizacion/traer_requisitos.css">
<!-- Mostrar mensajes de error o éxito -->
<?php if (!empty($mensaje_error)): ?>
    <div class="error-message"><?php echo $mensaje_error; ?></div>
<?php endif; ?>

<?php if (!empty($mensaje_exito)): ?>
    <div class="success-message"><?php echo $mensaje_exito; ?></div>
<?php endif; ?>

<!-- TÍTULO: CHECKBOX PARA MOSTRAR/OCULTAR REQUISITOS GENERALES -->
<label>
    <input type="checkbox" id="toggle-requisitos" onclick="toggleRequisitos()"> Mostrar requisitos generales
</label>

<!-- TÍTULO: TABLA PARA LOS REQUISITOS GENERALES -->
<table id="requisitos-table" style="display: none;">
    <tr>
        <th style="background-color:lightgray" colspan="2">REQUISITOS GENERALES</th>
    </tr>
    <?php if (!empty($requisitos)): ?>
        <?php foreach ($requisitos as $requisito): ?>
            <tr>
                <td>
                    <!-- TÍTULO: DESCRIPCIÓN DEL REQUISITO -->
                    <?php echo htmlspecialchars($requisito['indice']) . '.- ' . htmlspecialchars($requisito['descripcion_condiciones']); ?>
                </td>
                <td>
                    <!-- TÍTULO: CHECKBOX DEL REQUISITO -->
                    <input type="checkbox" name="requisito_check[]" value="<?php echo htmlspecialchars($requisito['id_requisitos']); ?>"
                        <?php echo in_array($requisito['id_requisitos'], array_column($requisitos_seleccionados, 'id_requisitos')) ? 'checked' : ''; ?> />
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="2">No hay requisitos generales disponibles.</td>
        </tr>
    <?php endif; ?>
</table>

<script src="../../js/ver_cotizacion/traer_requisitos.js"></script>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Manejar los requisitos seleccionados
    if (!empty($_POST['requisito_check'])) {
        $requisitos_seleccionados = $_POST['requisito_check']; // Requisitos marcados
        
        // Eliminar cualquier requisito previamente almacenado para esta cotización en la tabla c_cotizacion_requisitos
        $sql_delete = "DELETE FROM c_cotizacion_requisitos WHERE id_cotizacion = ?";
        $stmt_delete = $mysqli->prepare($sql_delete);
        $stmt_delete->bind_param('i', $id_cotizacion);
        $stmt_delete->execute();

        // Insertar los nuevos requisitos seleccionados en c_cotizacion_requisitos
        $sql_insert = "INSERT INTO c_cotizacion_requisitos (id_cotizacion, id_requisitos) VALUES (?, ?)";
        $stmt_insert = $mysqli->prepare($sql_insert);

        foreach ($requisitos_seleccionados as $id_requisito) {
            $stmt_insert->bind_param('ii', $id_cotizacion, $id_requisito);
            $stmt_insert->execute();
        }

        $stmt_insert->close();
    }
    
    echo "Cotización y requisitos generales guardados correctamente.";
}
?>


     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Traer requisitos .PHP ----------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->
