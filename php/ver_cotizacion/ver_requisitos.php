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
    ------------------------------------- INICIO ITred Ver requisitos .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<?php
    $query_requisitos = "
    SELECT r.id_requisitos,r.indice, r.descripcion_condiciones
    FROM e_requisitos_basicos AS r
    JOIN c_cotizaciones_requisitos AS cr ON r.id_requisitos = cr.id_requisitos
    WHERE cr.id_cotizacion = ?
    ";

    // Preparar y ejecutar la consulta para obtener requisitos
    $stmt_requisitos = $mysqli->prepare($query_requisitos);
    $stmt_requisitos->bind_param("i", $id_cotizacion);
    $stmt_requisitos->execute();
    $result_requisitos = $stmt_requisitos->get_result();

    // Verificar si hay resultados de requisitos
    $requisitos = [];
    if ($result_requisitos->num_rows > 0) {
    while ($row = $result_requisitos->fetch_assoc()) {
        $requisitos[] = $row; // Guardar los requisitos en el array
    }
    } else {
    echo "No se encontraron requisitos seleccionados para esta cotización.";
    }

    // Cerrar la conexión de la consulta de requisitos
    $stmt_requisitos->close();
?>

<?php if (!empty($requisitos)): ?>
    <!-- TÍTULO: REQUISITOS -->
    <strong>Requisitos:</strong><br><br>
    <?php foreach ($requisitos as $requisito): ?>
        <!-- TÍTULO: DESCRIPCIÓN DE REQUISITOS -->
        <?php echo htmlspecialchars($requisito['descripcion_condiciones']); ?><br>
    <?php endforeach; ?>
<?php else: ?>
    <!-- TÍTULO: MENSAJE CUANDO NO HAY REQUISITOS DISPONIBLES -->
    No hay requisitos disponibles.
<?php endif; ?>
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Ver requisitos .PHP -----------------------------------
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
