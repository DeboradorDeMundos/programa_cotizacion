<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Agui Cerda - Santiago - Chile
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
?>
<?php foreach ($titulos as $titulo_id => $titulo): ?>
    <table border="1">
        <tr>
            <th rowspan="15" class="vertical-text">T<br>i<br>t<br>u<br>l<br>o<br><br><?php echo $titulo['nombre']; ?></th>
            <th>nombre_producto</th>
            <th>descripcion</th>
            <th>cantidad</th>
            <th>precio_unitario</th>
            <th>descuento_porcentaje</th>
            <th>total</th>
        </tr>

        <tr>
            <?php 
            $codigos = [];
            $descripciones = [];
            $cantidades = [];
            $precios = [];
            $descuentos = [];
            $totales_detalle = [];

            foreach ($titulo['detalles'] as $detalle) {
                $codigos[] = $detalle['nombre_producto'];
                $descripciones[] = $detalle['descripcion'];
                $cantidades[] = $detalle['cantidad'];
                $precios[] = $detalle['precio_unitario'];
                $descuentos[] = $detalle['descuento_porcentaje'];
                $totales_detalle[] = $detalle['total'];
            }

            // Imprimir los datos en las filas correspondientes
            ?>
            <td><?php echo implode('<br>', $codigos); ?></td>
            <td><?php echo implode('<br>', $descripciones); ?></td>
            <td><?php echo implode('<br>', $cantidades); ?></td>
            <td><?php echo implode('<br>', $precios); ?></td>
            <td><?php echo implode('<br>', $descuentos); ?></td>
            <td><?php echo implode('<br>', $totales_detalle); ?></td>
        </tr>

        <?php 
        // Imprimir los subtítulos si existen
        foreach ($titulo['detalles'] as $detalle) {
            if (!empty($detalle['subtitulos'])) {
                foreach ($detalle['subtitulos'] as $subtitulo) {
                    echo "<tr><td colspan='6' class='subtitle'>{$subtitulo}</td></tr>";
                }
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
Pedro Agui Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->
