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
    ------------------------------------- INICIO ITred Spa Detalle.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->



<link rel="stylesheet" href="../../css/nueva_cotizacion/detalle.css">
<fieldset>
    <legend>Detalle de la Cotización</legend>
    <div id="detalle-container">
        <div class="detalle-section">
            <!-- Aquí se agregarán las secciones dinámicamente -->
        </div>

        <div class="fixed-button-container">
            <button type="button" onclick="addDetailSection()">Agregar un nuevo título</button>
        </div>
    </div>
</fieldset>




<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $detalles_titulo = $_POST['detalle_titulo'] ?? [];
    $detalles_subtitulo = $_POST['detalle_subtitulo'] ?? [];
    $detalles_cantidad = $_POST['detalle_cantidad'] ?? [];
    $detalles_descripcion = $_POST['detalle_descripcion'] ?? [];
    $detalles_precio_unitario = $_POST['detalle_precio_unitario'] ?? [];
    $detalles_descuento = $_POST['detalle_descuento'] ?? [];
    $detalles_tipo = $_POST['tipo_producto'] ?? [];
    $detalles_nombre_producto = $_POST['nombre_producto'] ?? [];
    
    $id_cotizacion = $_POST['id_cotizacion']; // Asegúrate de que esta variable tiene el valor correcto

    // Validar que hay al menos un título
    if (empty($detalles_titulo)) {
        die("No se recibieron títulos.");
    }

    // Consultas de inserción
    $sql_insert_titulo = "INSERT INTO C_Titulos (id_cotizacion, nombre) VALUES (?, ?) ON DUPLICATE KEY UPDATE nombre = VALUES(nombre)";
    $sql_insert_subtitulo = "INSERT INTO C_Subtitulos (id_titulo, nombre) VALUES (?, ?) ON DUPLICATE KEY UPDATE nombre = VALUES(nombre)";
    $sql_insert_detalle = "INSERT INTO C_Detalles (id_titulo, id_subtitulo, tipo, nombre_producto, descripcion, cantidad, precio_unitario, descuento_porcentaje, total) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar las sentencias
    $stmt_insert_titulo = $mysqli->prepare($sql_insert_titulo);
    $stmt_insert_subtitulo = $mysqli->prepare($sql_insert_subtitulo);
    $stmt_insert_detalle = $mysqli->prepare($sql_insert_detalle);

    if (!$stmt_insert_titulo || !$stmt_insert_subtitulo || !$stmt_insert_detalle) {
        die("Error al preparar las consultas: " . $mysqli->error);
    }

    // Iniciar la transacción
    $mysqli->begin_transaction();

    try {
        foreach ($detalles_titulo as $titulo_index => $titulo) {
            // Validar título
            if (empty($titulo)) {
                throw new Exception("Título vacío en el índice $titulo_index.");
            }

            // Insertar el título y obtener su ID
            $stmt_insert_titulo->bind_param("is", $id_cotizacion, $titulo);
            if (!$stmt_insert_titulo->execute()) {
                throw new Exception("Error al insertar título: " . $stmt_insert_titulo->error);
            }
            $id_titulo = $stmt_insert_titulo->insert_id;

            // Revisar subtítulos asociados
            if (isset($detalles_subtitulo[$titulo_index]) && is_array($detalles_subtitulo[$titulo_index])) {
                foreach ($detalles_subtitulo[$titulo_index] as $subtitulo_index => $subtitulo) {
                    // Validar subtítulo
                    if (empty($subtitulo)) {
                        throw new Exception("Subtítulo vacío en el índice $subtitulo_index del título $titulo_index.");
                    }

                    // Insertar el subtítulo y obtener su ID
                    $stmt_insert_subtitulo->bind_param("is", $id_titulo, $subtitulo);
                    if (!$stmt_insert_subtitulo->execute()) {
                        throw new Exception("Error al insertar subtítulo: " . $stmt_insert_subtitulo->error);
                    }
                    $id_subtitulo = $stmt_insert_subtitulo->insert_id;

                    // Insertar detalles asociados al subtítulo
                    if (isset($detalles_cantidad[$titulo_index][$subtitulo_index])) {
                        foreach ($detalles_cantidad[$titulo_index][$subtitulo_index] as $detalle_index => $cantidad) {
                            // Obtener los detalles restantes
                            $precio_unitario = floatval($detalles_precio_unitario[$titulo_index][$subtitulo_index][$detalle_index] ?? 0);
                            $descuento = floatval($detalles_descuento[$titulo_index][$subtitulo_index][$detalle_index] ?? 0);
                            $total = ($precio_unitario * $cantidad) - (($precio_unitario * $cantidad) * ($descuento / 100));
                            $tipo = $detalles_tipo[$titulo_index][$subtitulo_index][$detalle_index] ?? '';
                            $nombre_producto = $detalles_nombre_producto[$titulo_index][$subtitulo_index][$detalle_index] ?? '';
                            $descripcion = $detalles_descripcion[$titulo_index][$subtitulo_index][$detalle_index] ?? '';

                            // Validar datos del detalle
                            if (empty($nombre_producto) || empty($cantidad)) {
                                throw new Exception("Nombre del producto o cantidad vacíos en el detalle $detalle_index del subtítulo $subtitulo_index.");
                            }

                            // Insertar el detalle
                            $stmt_insert_detalle->bind_param(
                                "iisssidd",
                                $id_titulo,
                                $id_subtitulo,
                                $tipo,
                                $nombre_producto,
                                $descripcion,
                                $cantidad,
                                $precio_unitario,
                                $descuento,
                                $total
                            );
                            if (!$stmt_insert_detalle->execute()) {
                                throw new Exception("Error al insertar detalle: " . $stmt_insert_detalle->error);
                            }
                        }
                    }
                }
            } else {
                // Si no hay subtítulos, insertar los detalles directamente bajo el título
                foreach ($detalles_cantidad[$titulo_index][0] as $detalle_index => $cantidad) {
                    $precio_unitario = floatval($detalles_precio_unitario[$titulo_index][0][$detalle_index] ?? 0);
                    $descuento = floatval($detalles_descuento[$titulo_index][0][$detalle_index] ?? 0);
                    $total = ($precio_unitario * $cantidad) - (($precio_unitario * $cantidad) * ($descuento / 100));
                    $tipo = $detalles_tipo[$titulo_index][0][$detalle_index] ?? '';
                    $nombre_producto = $detalles_nombre_producto[$titulo_index][0][$detalle_index] ?? '';
                    $descripcion = $detalles_descripcion[$titulo_index][0][$detalle_index] ?? '';

                    // Validar datos del detalle
                    if (empty($nombre_producto) || empty($cantidad)) {
                        throw new Exception("Nombre del producto o cantidad vacíos en el detalle $detalle_index del título $titulo_index.");
                    }

                    // Insertar el detalle
                    $stmt_insert_detalle->bind_param(
                        "iisssidd",
                        $id_titulo,
                        null, // id_subtitulo es null
                        $tipo,
                        $nombre_producto,
                        $descripcion,
                        $cantidad,
                        $precio_unitario,
                        $descuento,
                        $total
                    );
                    if (!$stmt_insert_detalle->execute()) {
                        throw new Exception("Error al insertar detalle sin subtítulo: " . $stmt_insert_detalle->error);
                    }
                }
            }
        }

        // Confirmar la transacción
        $mysqli->commit();
        echo "Datos insertados correctamente";

    } catch (Exception $e) {
        $mysqli->rollback();
        echo "Error al insertar los datos: " . $e->getMessage();
    }

    // Cerrar los statements
    $stmt_insert_titulo->close();
    $stmt_insert_subtitulo->close();
    $stmt_insert_detalle->close();
}
?>





     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Detalle.PHP ----------------------------------------
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
