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
    ------------------------------------- INICIO ITred Spa detalle .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->
<?php
// Consulta para obtener los títulos, detalles y subtítulos relacionados con la cotización
$query_titulos = "
    SELECT 
        t.id_titulo AS titulo_id,
        t.nombre,
        d.id_detalle AS detalle_id,
        d.nombre_producto,
        d.descripcion,
        d.cantidad,
        d.precio_unitario,
        d.descuento_porcentaje,
        d.total,
        s.nombre AS subtitulo_nombre
    FROM C_Cotizaciones c
    JOIN C_Titulos t ON t.id_cotizacion = c.id_cotizacion
    JOIN C_Detalles d ON d.id_titulo = t.id_titulo
    LEFT JOIN C_Subtitulos s ON s.id_subtitulo = d.id_subtitulo
    WHERE c.id_cotizacion = ?
";

// Preparar y ejecutar la consulta
$stmt_titulos = $mysqli->prepare($query_titulos);
$stmt_titulos->bind_param("i", $id_cotizacion);
$stmt_titulos->execute();
$result_titulos = $stmt_titulos->get_result();

// Estructura para almacenar los datos
$titulos = [];
while ($row = $result_titulos->fetch_assoc()) {
    $titulo_id = $row['titulo_id'];

    // Si el título no existe aún en el array, lo agregamos
    if (!isset($titulos[$titulo_id])) {
        $titulos[$titulo_id] = [
            'nombre' => $row['nombre'],
            'detalles' => []
        ];
    }

    // Añadir detalles y subtítulos
    $titulos[$titulo_id]['detalles'][$row['detalle_id']]['nombre_producto'] = $row['nombre_producto'];
    $titulos[$titulo_id]['detalles'][$row['detalle_id']]['descripcion'] = $row['descripcion'];
    $titulos[$titulo_id]['detalles'][$row['detalle_id']]['cantidad'] = $row['cantidad'];
    $titulos[$titulo_id]['detalles'][$row['detalle_id']]['precio_unitario'] = $row['precio_unitario'];
    $titulos[$titulo_id]['detalles'][$row['detalle_id']]['descuento_porcentaje'] = $row['descuento_porcentaje'];
    $titulos[$titulo_id]['detalles'][$row['detalle_id']]['total'] = $row['total'];
    
    if (!empty($row['subtitulo_nombre'])) {
        $titulos[$titulo_id]['detalles'][$row['detalle_id']]['subtitulos'][] = $row['subtitulo_nombre'];
    }
}

// Cerrar la conexión de la consulta de títulos
$stmt_titulos->close();

foreach ($titulos as $titulo_id => $titulo): ?>
    <table border="1">
        <tr>
            <th>nombre_producto</th>
            <th>descripcion</th>
            <th>cantidad</th>
            <th>precio_unitario</th>
            <th>descuento_porcentaje</th>
            <th>total</th>
        </tr>
        <tr>
            <th colspan="6" class="titulo">
                <?php echo $titulo['nombre']; ?>
            </th>
        </tr>

        <?php 
        $subtitulos_mostrados = []; // Array para rastrear subtítulos mostrados
        $detalles_sin_subtitulo = []; // Array para almacenar detalles sin subtítulo

        // Imprimir los detalles
        foreach ($titulo['detalles'] as $detalle) {
            // Verificar si el detalle tiene subtítulos
            if (!empty($detalle['subtitulos'])) {
                foreach ($detalle['subtitulos'] as $subtitulo) {
                    // Imprimir subtítulo si no se ha mostrado aún
                    if (!in_array($subtitulo, $subtitulos_mostrados)) {
                        echo "<tr><td colspan='6' class='subtitle'>{$subtitulo}</td></tr>";
                        $subtitulos_mostrados[] = $subtitulo; // Marcar el subtítulo como mostrado
                    }
                }
                // Imprimir los datos del detalle después del subtítulo
                echo "<tr>";
                echo "<td>{$detalle['nombre_producto']}</td>";
                echo "<td>{$detalle['descripcion']}</td>";
                echo "<td>{$detalle['cantidad']}</td>";
                echo "<td>{$detalle['precio_unitario']}</td>";
                echo "<td>{$detalle['descuento_porcentaje']}</td>";
                echo "<td>{$detalle['total']}</td>";
                echo "</tr>";
            } else {
                // Si no hay subtítulo, almacenar el detalle para imprimir más tarde
                $detalles_sin_subtitulo[] = $detalle;
            }
        }

        // Imprimir detalles sin subtítulos después de los subtítulos
        if (!empty($detalles_sin_subtitulo)) {
            // Solo imprimir un salto de línea si hay detalles sin subtítulo
            echo "<tr><td colspan='6'>&nbsp;</td></tr>"; // Fila vacía para salto de línea

            foreach ($detalles_sin_subtitulo as $detalle) {
                echo "<tr>";
                echo "<td>{$detalle['nombre_producto']}</td>";
                echo "<td>{$detalle['descripcion']}</td>";
                echo "<td>{$detalle['cantidad']}</td>";
                echo "<td>{$detalle['precio_unitario']}</td>";
                echo "<td>{$detalle['descuento_porcentaje']}</td>";
                echo "<td>{$detalle['total']}</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
<?php endforeach; ?>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa  detalle .PHP -----------------------------------
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
