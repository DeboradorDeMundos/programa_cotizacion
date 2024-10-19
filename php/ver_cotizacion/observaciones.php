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
    ------------------------------------- INICIO ITred Spa observaciones.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
    <?php
    // Consulta para obtener la observación (solo una)
    $query_observacion = "
    SELECT o.id_observacion, o.observacion
    FROM C_Observaciones AS o
    WHERE o.id_cotizacion = ?
    LIMIT 1"; // Limitamos a un solo resultado

    // Preparar la consulta
    if ($stmt_observacion = $mysqli->prepare($query_observacion)) {
        // Vincular parámetros
        $stmt_observacion->bind_param("i", $id_cotizacion);

        // Ejecutar la consulta
        if ($stmt_observacion->execute()) {
            // Obtener el resultado de la consulta
            $result_observacion = $stmt_observacion->get_result();

            // Verificar si hay resultados de observación
            if ($result_observacion->num_rows > 0) {
                // Obtener la observación (solo una)
                $observacion = $result_observacion->fetch_assoc();
            } else {
                // Si no hay observación, definirla como una cadena vacía
                $observacion['observacion'] = '';
            }
        } else {
            echo "Error al ejecutar la consulta: " . $stmt_observacion->error;
        }

        // Cerrar la consulta
        $stmt_observacion->close();
    } else {
        echo "Error al preparar la consulta: " . $mysqli->error;
    }
?>


<link rel="stylesheet" href="../../css/ver_cotizacion/observaciones.css">
<!-- Título: Campo de observación -->
<fieldset class="observaciones-box">
    <legend>OBSERVACIONES</legend> <!-- Título: Encabezado del fieldset -->
    <div class="form-group">
        <!-- Título: Etiqueta del campo de texto -->
        <label for="observacion">Observación:</label>
        <!-- Título: Área de texto para la observación -->
        <textarea id="observacion" name="observacion"
            rows="4" cols="50" 
            placeholder="Agrega cualquier comentario adicional (OPCIONAL)...">
            <?php echo htmlspecialchars($observacion['observacion'] ?? ''); ?>
        </textarea>
    </div>        
</fieldset>

<script src="../../js/ver_cotizacion/observaciones.js"></script> 



     <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $observacion = $_POST['observacion'] ?? '';

    // Asegúrate de que no esté vacío
    if (!empty($observacion)) {
        $sql_insert_observacion = "INSERT INTO C_Observaciones (id_cotizacion, observacion) VALUES (?, ?)";
        $stmt_insert_observacion = $mysqli->prepare($sql_insert_observacion);

        if (!$stmt_insert_observacion) {
            die("Error al preparar la consulta: " . $mysqli->error);
        }

        // Asocia la ID de la cotización y la observación
        $stmt_insert_observacion->bind_param("is", $id_cotizacion, $observacion);
        
        if ($stmt_insert_observacion->execute()) {
            echo "Observación guardada correctamente.";
        } else {
            echo "Error al guardar la observación: " . $stmt_insert_observacion->error;
        }

        // Cerrar la consulta
        $stmt_insert_observacion->close();
    } else {
        echo "La observación no puede estar vacía.";
    }
}

?>





     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa observaciones .PHP ----------------------------------------
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
