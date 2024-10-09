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
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');

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
