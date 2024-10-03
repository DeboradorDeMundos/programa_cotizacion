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

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    // Recibir datos del formulario
    $detalles_titulo = $_POST['detalle_titulo'] ?? [];
    $detalles_subtitulo = $_POST['detalle_subtitulo'] ?? [];
    $detalles_cantidad = $_POST['detalle_cantidad'] ?? [];
    $detalles_descripcion = $_POST['detalle_descripcion'] ?? [];
    $detalles_precio_unitario = $_POST['detalle_precio_unitario'] ?? [];
    $detalles_descuento = $_POST['detalle_descuento'] ?? [];
    $detalles_tipo = $_POST['tipo_producto'] ?? [];
    $detalles_nombre_producto = $_POST['nombre_producto'] ?? [];


    

    // Estructurar los datos en arrays anidados
    $estructura_datos = [];

    foreach ($detalles_titulo as $titulo_index => $titulo) {
        $estructura_datos[$titulo_index] = [
            'titulo' => $titulo,
            'subtitulos' => [],
            'detalles' => [],
        ];

        // Asignar subtítulos correspondientes a cada título
        foreach ($detalles_subtitulo[$titulo_index] ?? [] as $subtitulo) {
            // Asegurarse de que el subtitulo sea un string
            if (is_array($subtitulo)) {
                $estructura_datos[$titulo_index]['subtitulos'][] = implode(", ", $subtitulo); // Convertir a string
            } else {
                $estructura_datos[$titulo_index]['subtitulos'][] = $subtitulo; // Ya es un string
            }
        }

        // Asignar detalles correspondientes a cada título
        foreach ($detalles_cantidad[$titulo_index] ?? [] as $detalle_index => $cantidad) {
            // Asegúrate de que las variables se obtienen correctamente
            $tipo = $detalles_tipo[$titulo_index][$detalle_index] ?? ''; // Debe ser una cadena
            $nombre_producto = $detalles_nombre_producto[$titulo_index][$detalle_index] ?? ''; // Debe ser una cadena
            $descripcion = $detalles_descripcion[$titulo_index][$detalle_index] ?? ''; // Debe ser una cadena
            $precio_unitario = floatval($detalles_precio_unitario[$titulo_index][$detalle_index] ?? 0);
            $descuento = floatval($detalles_descuento[$titulo_index][$detalle_index] ?? 0);
            $cantidad = intval($cantidad); // Asegúrate de que esto sea un entero
        
            // Calcular el total
            $total = ($precio_unitario * $cantidad) - (($precio_unitario * $cantidad) * ($descuento / 100));
        
            // Verifica que no estás intentando usar un array aquí
            $estructura_datos[$titulo_index]['detalles'][] = [
                'tipo' => $tipo, // Verifica que esto sea un string
                'nombre_producto' => $nombre_producto, // Verifica que esto sea un string
                'descripcion' => $descripcion, // Verifica que esto sea un string
                'cantidad' => $cantidad,
                'precio_unitario' => $precio_unitario,
                'descuento' => $descuento,
                'total' => round($total, 2),
            ];
        }
    }

    // Preparar las consultas de inserción
    $sql_insert_titulo = "INSERT INTO C_Titulos (id_cotizacion, nombre) VALUES (?, ?) ON DUPLICATE KEY UPDATE nombre = VALUES(nombre)";
    $sql_insert_subtitulo = "INSERT INTO C_Subtitulos (id_titulo, nombre) VALUES (?, ?) ON DUPLICATE KEY UPDATE nombre = VALUES(nombre)";
    $sql_insert_detalle = "INSERT INTO C_Detalles (id_titulo, id_subtitulo, tipo, nombre_producto, descripcion, cantidad, precio_unitario, descuento_porcentaje, total) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    echo $sql; // Para ver la consulta que se ejecutará 
    $stmt_insert_titulo = $mysqli->prepare($sql_insert_titulo);
    $stmt_insert_subtitulo = $mysqli->prepare($sql_insert_subtitulo);
    $stmt_insert_detalle = $mysqli->prepare($sql_insert_detalle);

    if (!$stmt_insert_titulo || !$stmt_insert_subtitulo || !$stmt_insert_detalle) {
        die("Error al preparar las consultas: " . $mysqli->error);
    }

    // Comenzar una transacción para asegurar consistencia
    $mysqli->begin_transaction();

    try {
        foreach ($estructura_datos as $titulo_index => $data) {
            // Insertar el título y obtener su ID
            $stmt_insert_titulo->bind_param("is", $id_cotizacion, $data['titulo']);
            if (!$stmt_insert_titulo->execute()) {
                throw new Exception("Error al insertar título: " . $stmt_insert_titulo->error);
            }
            $id_titulo = $stmt_insert_titulo->insert_id;

            // Insertar los subtítulos asociados y obtener su ID
            $id_subtitulo_map = [];
            foreach ($data['subtitulos'] as $subtitulo) {
                // Verificar que el subtitulo sea un string
                if (is_array($subtitulo)) {
                    $subtitulo = implode(", ", $subtitulo); // Convertir a string si es un array
                }

                $stmt_insert_subtitulo->bind_param("is", $id_titulo, $subtitulo);
                if (!$stmt_insert_subtitulo->execute()) {
                    throw new Exception("Error al insertar subtítulo: " . $stmt_insert_subtitulo->error);
                }
                $id_subtitulo_map[] = $stmt_insert_subtitulo->insert_id; // Guardar IDs de subtítulos
            }

         // Insertar los detalles
foreach ($data['detalles'] as $detalle) {
    // Usar un índice para recorrer los subtítulos en el orden correcto
    static $subtitulo_index = 0;
    $id_subtitulo = !empty($id_subtitulo_map[$subtitulo_index]) ? $id_subtitulo_map[$subtitulo_index] : null;
    
    // Iterar sobre cada detalle
    foreach ($detalle['tipo'] as $index => $tipo) {
        $nombre_producto = isset($detalle['nombre_producto'][$index]) ? $detalle['nombre_producto'][$index] : '';
        $descripcion = isset($detalle['descripcion'][$index]) ? $detalle['descripcion'][$index] : '';
        
        // Asumir que cantidad, precio_unitario, descuento, y total son valores únicos
        $cantidad = $detalle['cantidad'];
        $precio_unitario = $detalle['precio_unitario'];
        $descuento = $detalle['descuento'];
        $total = $detalle['total'];

        // Asegúrate de que todos los valores son variables
        $tipo = (string)$tipo;
        $nombre_producto = (string)$nombre_producto;
        $descripcion = (string)$descripcion;
        $cantidad = (int)$cantidad;
        $precio_unitario = (float)$precio_unitario;
        $descuento = (float)$descuento;
        $total = (float)$total;

        // Ahora, bind_param debe funcionar correctamente
        $stmt_insert_detalle->bind_param(
            "iisssiddi",
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

        // Ejecutar la declaración
        if (!$stmt_insert_detalle->execute()) {
            throw new Exception("Error al insertar detalle: " . $stmt_insert_detalle->error);
        }
    }

    // Incrementar el índice del subtítulo para el siguiente grupo de detalles
    $subtitulo_index++;
}

        }

        // Confirmar la transacción
        $mysqli->commit();
        echo "Datos insertados correctamente";

    } catch (Exception $e) {
        // En caso de error, deshacer la transacción
        $mysqli->rollback();
        echo "Error al insertar los datos: " . $e->getMessage();
    }

    // Cerrar las consultas preparadas
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
