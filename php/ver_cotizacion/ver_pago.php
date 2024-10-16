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
    ------------------------------------- INICIO ITred Spa Ver .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

    <?php
$query_pagos = "
    SELECT numero_pago, descripcion, porcentaje_pago, monto_pago, fecha_pago, forma_pago
    FROM C_pago
    WHERE id_cotizacion = ?
";

// Preparar y ejecutar la consulta para obtener los pagos
$stmt_pagos = $mysqli->prepare($query_pagos);
$stmt_pagos->bind_param("i", $id_cotizacion); // $id_cotizacion debería contener el ID de la cotización
$stmt_pagos->execute();
$result_pagos = $stmt_pagos->get_result();

// Verificar si hay resultados de pagos
$pagos = [];
if ($result_pagos->num_rows > 0) {
    while ($row = $result_pagos->fetch_assoc()) {
        $pagos[] = $row; // Guardar los pagos en el array
    }
} else {
    echo "No se encontraron pagos para esta cotización.";
}

// Cerrar la conexión de la consulta de pagos
$stmt_pagos->close();
?>

<?php if (!empty($pagos)): ?>
    <strong>Pagos relacionados: </strong><br><br>
    <table>
        <thead>
            <tr>
                <th>Número de Pago</th>
                <th>Descripción</th>
                <th>Porcentaje</th>
                <th>Monto</th>
                <th>Fecha de Pago</th>
                <th>Forma de Pago</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($pagos as $pago): ?>
            <tr>
                <td><?php echo htmlspecialchars($pago['numero_pago']); ?></td>
                <td><?php echo htmlspecialchars($pago['descripcion']); ?></td>
                <td><?php echo htmlspecialchars($pago['porcentaje_pago']); ?>%</td>
                <td><?php echo htmlspecialchars($pago['monto_pago']); ?></td>
                <td><?php echo htmlspecialchars($pago['fecha_pago']); ?></td>
                <td><?php echo htmlspecialchars($pago['forma_pago']); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    No hay pagos disponibles para esta cotización.
<?php endif; ?>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa  Ver .PHP -----------------------------------
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
