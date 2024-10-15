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
        d.color,
        d.total,
        s.nombre AS subtitulo_nombre,
        s.color AS subtitulo_color,
        n.contenido,
        n.color AS color_nota
    FROM C_Cotizaciones c
    JOIN C_Titulos t ON t.id_cotizacion = c.id_cotizacion
    JOIN C_Detalles d ON d.id_titulo = t.id_titulo
    LEFT JOIN C_Subtitulos s ON s.id_subtitulo = d.id_subtitulo
    LEFT JOIN c_notas n ON n.id_titulo = t.id_titulo
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
            'notas' => [],
            'detalles' => []
        ];
    }

    // Añadir detalles y subtítulos
    $titulos[$titulo_id]['detalles'][$row['detalle_id']]['nombre_producto'] = $row['nombre_producto'];
    $titulos[$titulo_id]['detalles'][$row['detalle_id']]['descripcion'] = $row['descripcion'];
    $titulos[$titulo_id]['detalles'][$row['detalle_id']]['cantidad'] = $row['cantidad'];
    $titulos[$titulo_id]['detalles'][$row['detalle_id']]['precio_unitario'] = $row['precio_unitario'];
    $titulos[$titulo_id]['detalles'][$row['detalle_id']]['descuento_porcentaje'] = $row['descuento_porcentaje'];
    $titulos[$titulo_id]['detalles'][$row['detalle_id']]['color_detalle'] = $row['color'];
    $titulos[$titulo_id]['detalles'][$row['detalle_id']]['total'] = $row['total'];
    
    if (!empty($row['subtitulo_nombre'])) {
        $titulos[$titulo_id]['detalles'][$row['detalle_id']]['subtitulos'][] = [
            'subtitulo' => $row['subtitulo_nombre'], 
            'color_subtitulo' => $row['subtitulo_color']
        ];
    }

    if(!empty($row['contenido'])) {
        $titulos[$titulo_id]['notas'][] = [
            'contenido' => $row['contenido'],
            'color' => $row['color_nota']
        ];
    }
}

// Cerrar la conexión de la consulta de títulos
$stmt_titulos->close();

foreach ($titulos as $titulo_id => $titulo): ?>
    <table border="1">

        <?php
        // Arreglo de mapeo de colores en español a códigos hexadecimales
        $colores = [
            'negro' => '#000000',
            'rojo' => '#FF0000',
            'naranjo' => '#FFA500', // El equivalente a "naranjo" es "naranja" en CSS
            'verde' => '#00FF00'
        ];

        echo "<tr><td colspan='6'>";

        // Array para rastrear notas mostradas
        $notas_mostradas = [];

        foreach ($titulo['notas'] as $detalle_n) {
            // Verificar si la nota ya fue mostrada
            if (!empty($detalle_n['contenido']) && !in_array($detalle_n['contenido'], $notas_mostradas)) {
                // Obtener el color en español y convertirlo a código hexadecimal
                $color_espanol = strtolower($detalle_n['color']);
                $color_hex = isset($colores[$color_espanol]) ? $colores[$color_espanol] : '#000000'; // Negro por defecto
                
                // Aplicar el color al contenido
                echo "<span style='color: {$color_hex};'>{$detalle_n['contenido']}</span><br>";
                
                // Agregar la nota al array de notas mostradas
                $notas_mostradas[] = $detalle_n['contenido'];
            }
        }

        echo "</td></tr>";
        ?>
        <tr>
            <th>nombre_producto</th>
            <th>descripcion</th>
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
            $color_detalle = strtolower($detalle['color_detalle']); // Obtener el color del detalle en español
            $color_texto = isset($colores[$color_detalle]) ? $colores[$color_detalle] : '#000000'; // Negro por defecto si no hay color definido

            // Verificar si el detalle tiene subtítulos
            if (!empty($detalle['subtitulos'])) {
                foreach ($detalle['subtitulos'] as $subtitulo_info) {
                    $subtitulo = $subtitulo_info['subtitulo'];
                    $color_subtitulo = strtolower($subtitulo_info['color_subtitulo']);
                    
                    // Verifica si ya se ha mostrado este subtítulo
                    if (!in_array($subtitulo, $subtitulos_mostrados)) {
                        // Mapea el color del subtítulo si está en español
                        $color_hex = isset($colores[$color_subtitulo]) ? $colores[$color_subtitulo] : '#000000'; // Negro por defecto
                        
                        // No aplicar color de fondo si el subtítulo es negro
                        $background_style = $color_hex !== '#000000' ? "background-color: {$color_hex};" : '';

                        // Imprimir subtítulo con el color de fondo correspondiente (si no es negro)
                        echo "<tr><td colspan='6' class='subtitle' style='{$background_style}'>{$subtitulo}</td></tr>";
                        
                        // Marcar el subtítulo como mostrado
                        $subtitulos_mostrados[] = $subtitulo;
                    }
                    
                }

                // Imprimir los datos del detalle con el color de fondo del subtítulo si no es negro
                // Si el subtítulo es negro, aplicar el color del detalle al texto
                $background_style = $color_hex !== '#000000' ? "background-color: {$color_hex};" : '';
                $text_color_style = $color_hex === '#000000' ? "color: {$color_texto};" : ''; // Solo aplicar color de texto si el subtítulo es negro
                
                echo "<tr style='{$background_style} {$text_color_style}'>";
                echo "<td>{$detalle['nombre_producto']}</td>";
                echo "<td>{$detalle['descripcion']}</td>";
                echo "<td>{$detalle['descuento_porcentaje']}</td>";
                echo "<td>$ " . (int)$detalle['total'] . "</td>"; // Muestra sin decimales
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
                // Aplicar color de texto en detalles sin subtítulo
                $text_color_style = "color: {$color_texto};";

                echo "<tr style='{$text_color_style}'>";
                echo "<td>{$detalle['nombre_producto']}</td>";
                echo "<td>{$detalle['descripcion']}</td>";
                echo "<td>{$detalle['descuento_porcentaje']}</td>";
                echo "<td>$ " . (int)$detalle['total'] . "</td>"; // Muestra sin decimales
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
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->