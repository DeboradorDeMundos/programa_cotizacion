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
    // Consulta para obtener los requisitos básicos
    $query_requisitos = "SELECT id_requisitos, indice, descripcion_condiciones FROM E_Requisitos_Basicos WHERE id_empresa = ?";
    if ($stmt_req = $mysqli->prepare($query_requisitos)) {
        $stmt_req->bind_param('i', $id);
        $stmt_req->execute();
        $result_req = $stmt_req->get_result();
        $requisitos = $result_req->fetch_all(MYSQLI_ASSOC);
        $stmt_req->close();
    } else {
        echo "<p>Error al preparar la consulta de requisitos: " . $mysqli->error . "</p>";
    }
?> 

    <link rel="stylesheet" href="../../css/ver_cotizacion/traer_requisitos.css">
<!-- Checkbox para mostrar/ocultar requisitos generales -->
<label>
    <input type="checkbox" id="toggle-requisitos" onclick="toggleRequisitos()"> Mostrar requisitos generales
</label>

<!-- Tabla para los requisitos generales -->
<table id="requisitos-table" style="display: none;">
    <tr>
        <th style="background-color:lightgray" colspan="2">REQUISITOS GENERALES</th>
    </tr>
    <?php if (!empty($requisitos)): ?>
        <?php foreach ($requisitos as $requisito): ?>
            <tr>
                <td>
                    <?php echo htmlspecialchars($requisito['indice']) . '.- ' . htmlspecialchars($requisito['descripcion_condiciones']); ?>
                </td>
                <td>
                    <input type="checkbox" name="requisito_check[]" value="<?php echo $requisito['id_requisitos']; ?>"/>
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

    // Manejo de los requisitos seleccionados
    if (!empty($_POST['requisito_check'])) {
        $requisitos_seleccionados = $_POST['requisito_check']; // Requisitos marcados
        
        // Elimina cualquier requisito previamente almacenado para esta cotización en la tabla c_cotizaciones_requisitos
        $sql_delete = "DELETE FROM c_cotizaciones_requisitos WHERE id_cotizacion = ?";
        $stmt_delete = $mysqli->prepare($sql_delete);
        $stmt_delete->bind_param('i', $id_cotizacion);
        $stmt_delete->execute();

        // Inserta los nuevos requisitos seleccionados en c_cotizaciones_requisitos
        $sql_insert = "INSERT INTO c_cotizaciones_requisitos (id_cotizacion, id_requisitos) VALUES (?, ?)";
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
