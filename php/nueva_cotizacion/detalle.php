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
    <div id="detalle-contenedor">
        <div class="seccion-detalle">
            <!-- TÍTULO: SECCIÓN PARA DETALLES DE LA COTIZACIÓN -->
            <!-- Aquí se agregarán las secciones dinámicamente -->
        </div>

        <div class="fixed-button-contenedor">
            <!-- TÍTULO: BOTÓN PARA AGREGAR UNA NUEVA SECCIÓN DE DETALLE -->
            <button type="button" onclick="AgregarSeccionDeDetalle()">Agregar un nuevo título</button>
        </div>
    </div>
</fieldset>
<script src="../../js/nueva_cotizacion/detalle.js"></script>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos desde el método POST
    $detalles_titulo = $_POST['detalle_titulo'] ?? [];
    $detalles_subtitulo = $_POST['detalle_subtitulo'] ?? [];
    $detalles_subtitulo_color = $_POST['color_subtitulo'] ?? [];
    $detalles_notas_text = $_POST['nota_texto'] ?? [];
    $detalles_notas_color = $_POST['nota_color']?? [];
    $detalles_cantidad = $_POST['detalle_cantidad'] ?? [];
    $detalles_descripcion = $_POST['detalle_descripcion'] ?? [];
    $detalles_precio_unitario = $_POST['detalle_precio_unitario'] ?? [];
    $detalles_descuento = $_POST['detalle_descuento'] ?? [];
    $detalles_tipo = $_POST['tipo_producto'] ?? [];
    $detalles_nombre_producto = $_POST['nombre_producto'] ?? [];
    $detalles_color = $_POST['color'] ?? [];

    // Array para almacenar los resultados
    $resultado_detalles = [];

    // Recorrer los títulos
    foreach ($detalles_titulo as $key => $titulo) {
        $titulo_array = [
            'titulo' => $titulo,
            'notas' => [],
            'subtitulos' => [] // Inicializamos un array para los subtítulos
        ];

        $notas  = $detalles_notas_text[$key] ?? [];
        $color_notas = $detalles_notas_color[$key]?? [];

        if (!empty($notas)) {
            foreach ($notas as $not_key => $nota) {
                $nota_array = [
                    'nota' => $nota,
                    'color' =>  $color_notas[$not_key] ?? ''
                ];

                $titulo_array['notas'][] = $nota_array; // Añadimos el detalle del subtítulo al título
            }
        }


        $subtitulos = $detalles_subtitulo[$key] ?? [];
        $color_subtitulo = $detalles_subtitulo_color[$key] ?? [];

        // Crear un array para "Sin subtítulo" inicialmente vacío
        $detalle_sin_subtitulo = [
            'subtitulo' => 'Sin subtítulo',
            'detalles' => []
        ];

        // Si hay subtítulos
        if (!empty($subtitulos)) {
            foreach ($subtitulos as $sub_key => $subtitulo) {
                $detalle_array = [
                    'subtitulo' => $subtitulo,
                    'color' =>  $color_subtitulo[$sub_key] ?? '',

                    'detalles' => []
                ];

                // Añadir detalles a cada subtítulo
                foreach ($detalles_cantidad[$key][$sub_key] ?? [] as $index => $cantidad) {
                    $precio_unitario = $detalles_precio_unitario[$key][$sub_key][$index] ?? 0;
                    $descuento = $detalles_descuento[$key][$sub_key][$index] ?? 0;

                    // Calcular el total
                    $total = ($precio_unitario * $cantidad) - (($precio_unitario * $cantidad) * ($descuento / 100));

                    $detalle_array['detalles'][] = [
                        'cantidad' => $cantidad,
                        'descripcion' => $detalles_descripcion[$key][$sub_key][$index] ?? '',
                        'precio_unitario' => $precio_unitario,
                        'descuento' => $descuento,
                        'tipo' => $detalles_tipo[$key][$sub_key][$index] ?? '',
                        'nombre_producto' => $detalles_nombre_producto[$key][$sub_key][$index] ?? '',
                        'color' => $detalles_color[$key][$sub_key][$index] ?? '',
                        'total' => round($total, 2) // Añadir el total al detalle
                    ];
                }

                $titulo_array['subtitulos'][] = $detalle_array; // Añadimos el detalle del subtítulo al título
            }
        }

        // Recoger todos los detalles y asignar los que no tienen subtítulo
        foreach ($detalles_cantidad[$key] ?? [] as $sub_key => $cantidad_array) {
            // Si hay subtítulos, solo asignar los que no están bajo ningún subtítulo
            if (isset($subtitulos[$sub_key])) {
                continue; // Si hay subtítulo, no lo añadimos aquí
            }

            foreach ($cantidad_array as $index => $cantidad) {
                $precio_unitario = $detalles_precio_unitario[$key][$sub_key][0] ?? 0;
                $descuento = $detalles_descuento[$key][$sub_key][0] ?? 0;

                // Calcular el total
                $total = ($precio_unitario * $cantidad) - (($precio_unitario * $cantidad) * ($descuento / 100));

                $detalle_sin_subtitulo['detalles'][] = [
                    'cantidad' => $cantidad,
                    'descripcion' => $detalles_descripcion[$key][$sub_key][0] ?? '',
                    'precio_unitario' => $precio_unitario,
                    'descuento' => $descuento,
                    'tipo' => $detalles_tipo[$key][$sub_key][0] ?? '',
                    'nombre_producto' => $detalles_nombre_producto[$key][$sub_key][0] ?? '',
                    'color' => $detalles_color[$key][$sub_key][0] ?? '',
                    'total' => round($total, 2) // Añadir el total al detalle
                ];
            }
        }

        // Solo añadir el array "Sin subtítulo" si tiene detalles
        if (!empty($detalle_sin_subtitulo['detalles'])) {
            $titulo_array['subtitulos'][] = $detalle_sin_subtitulo; // Añadir "Sin subtítulo" si hay detalles
        }

        // Añadir el array del título al resultado
        $resultado_detalles[] = $titulo_array;
    }

    // Mostrar el array completo en formato legible
    echo "<pre>";
    print_r($resultado_detalles);
    echo "</pre>";

    $sql_insert_titulo = "INSERT INTO C_Titulos (id_cotizacion, nombre) VALUES (?, ?) ON DUPLICATE KEY UPDATE nombre = VALUES(nombre)";
    $sql_insert_nota = "INSERT INTO C_notas (id_titulo, contenido, color) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE contenido = VALUES(contenido), color = VALUES(color)";
    $sql_insert_subtitulo = "INSERT INTO C_Subtitulos (id_titulo, nombre, color) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE nombre = VALUES(nombre)";
    $sql_insert_detalle = "INSERT INTO C_Detalles (id_titulo, id_subtitulo, tipo, nombre_producto, descripcion, cantidad, precio_unitario, descuento_porcentaje, color,  total) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt_insert_titulo = $mysqli->prepare($sql_insert_titulo);
    $stmt_insert_nota = $mysqli->prepare($sql_insert_nota);
    $stmt_insert_subtitulo = $mysqli->prepare($sql_insert_subtitulo);
    $stmt_insert_detalle = $mysqli->prepare($sql_insert_detalle);

    if (!$stmt_insert_titulo ||  !$stmt_insert_nota || !$stmt_insert_subtitulo || !$stmt_insert_detalle) {
        die("Error al preparar las consultas: " . $mysqli->error);
    }

    // Comenzar una transacción para asegurar consistencia
    $mysqli->begin_transaction();

    try {
        foreach ($resultado_detalles as $titulo_data) {
            // Insertar el título y obtener su ID
            $stmt_insert_titulo->bind_param("is", $id_cotizacion, $titulo_data['titulo']);
            if (!$stmt_insert_titulo->execute()) {
                throw new Exception("Error al insertar título: " . $stmt_insert_titulo->error);
            }
            $id_titulo = $stmt_insert_titulo->insert_id;

            $id_nota_map = [];
            foreach ($titulo_data['notas'] as $nota_data) {
                $nota = $nota_data['nota'];
                $color = $nota_data['color'];
                
                // Solo insertar subtítulos que no sean "Sin subtítulo"
                $stmt_insert_nota->bind_param("iss", $id_titulo, $nota, $color);
                if (!$stmt_insert_nota->execute()) {
                    throw new Exception("Error al insertar subtítulo: " . $stmt_insert_nota->error);
                }
            }
        
            // Insertar los subtítulos asociados y obtener su ID
            $id_subtitulo_map = [];
            foreach ($titulo_data['subtitulos'] as $subtitulo_data) {
                $subtitulo = $subtitulo_data['subtitulo'];
                $sub_color = isset($subtitulo_data['color']) ? $subtitulo_data['color'] : 'negro'; // Asignar negro por defecto
            
                // Solo insertar subtítulos que no sean "Sin subtítulo"
                if ($subtitulo !== 'Sin subtítulo') {
                    $stmt_insert_subtitulo->bind_param("iss", $id_titulo, $subtitulo, $sub_color);
                    if (!$stmt_insert_subtitulo->execute()) {
                        throw new Exception("Error al insertar subtítulo: " . $stmt_insert_subtitulo->error);
                    }
                    $id_subtitulo_map[] = $stmt_insert_subtitulo->insert_id; // Guardar IDs de subtítulos
                } else {
                    // Para "Sin subtítulo", usar un ID nulo (o un valor por defecto si es necesario)
                    $id_subtitulo_map[] = null; // Esto se usará más tarde para los detalles sin subtítulo
                }
            }
        
            // Insertar los detalles para los subtítulos existentes
            foreach ($titulo_data['subtitulos'] as $subtitulo_index => $subtitulo_data) {
                // Obtener el ID del subtítulo correspondiente
                $id_subtitulo = !empty($id_subtitulo_map[$subtitulo_index]) ? $id_subtitulo_map[$subtitulo_index] : null;
            
                // Verificar si el subtítulo es "Sin subtítulo"
                if ($subtitulo_data['subtitulo'] !== 'Sin subtítulo') {
                    foreach ($subtitulo_data['detalles'] as $detalle) {
                        // Extraer los valores
                        $tipo = $detalle['tipo'];
                        $nombre_producto = $detalle['nombre_producto'];
                        $descripcion = $detalle['descripcion'];
                        $cantidad = $detalle['cantidad'];
                        $precio_unitario = $detalle['precio_unitario'];
                        $descuento = $detalle['descuento'];
                        $det_color = $detalle['color'];
                        $total = $detalle['total'];
            
                        // Asegúrate de que todos los valores son variables
                        $tipo = (string)$tipo;
                        $nombre_producto = (string)$nombre_producto;
                        $descripcion = (string)$descripcion;
                        $cantidad = (int)$cantidad;
                        $precio_unitario = (float)$precio_unitario;
                        $descuento = (float)$descuento;
                        $det_color = (string)$det_color;
                        $total = (float)$total;
            
                        // Insertar detalle con subtítulo
                        $stmt_insert_detalle->bind_param(
                            "iisssiddsi",
                            $id_titulo,
                            $id_subtitulo,
                            $tipo,
                            $nombre_producto,
                            $descripcion,
                            $cantidad,
                            $precio_unitario,
                            $descuento,
                            $det_color,
                            $total
                        );
            
                        // Ejecutar la declaración
                        if (!$stmt_insert_detalle->execute()) {
                            throw new Exception("Error al insertar  " . $stmt_insert_detalle->error);
                        }
                    }
                }
            }
        
            // Insertar detalles sin subtítulos si existen
            foreach ($titulo_data['subtitulos'] as $subtitulo_index => $subtitulo_data) {
                if ($subtitulo_data['subtitulo'] == 'Sin subtítulo') {
                    foreach ($subtitulo_data['detalles'] as $detalle) {
                        // Extraer los valores
                        $tipo = $detalle['tipo'];
                        $nombre_producto = $detalle['nombre_producto'];
                        $descripcion = $detalle['descripcion'];
                        $cantidad = $detalle['cantidad'];
                        $precio_unitario = $detalle['precio_unitario'];
                        $descuento = $detalle['descuento'];
                        $det_color = $detalle['color'];
                        $total = $detalle['total'];
        
                        // Asegúrate de que todos los valores son variables
                        $tipo = (string)$tipo;
                        $nombre_producto = (string)$nombre_producto;
                        $descripcion = (string)$descripcion;
                        $cantidad = (int)$cantidad;
                        $precio_unitario = (float)$precio_unitario;
                        $descuento = (float)$descuento;
                        $det_color = (string)$det_color;
                        $total = (float)$total;
        
                        $id_subtitulo = null; // Usar null para detalles sin subtítulo
                        $stmt_insert_detalle->bind_param(
                            "iisssiddsi",
                            $id_titulo,
                            $id_subtitulo,
                            $tipo,
                            $nombre_producto,
                            $descripcion,
                            $cantidad,
                            $precio_unitario,
                            $descuento,
                            $det_color,
                            $total
                        );
        
                        // Ejecutar la declaración
                        if (!$stmt_insert_detalle->execute()) {
                            throw new Exception("Error al insertar detalle sin subtítulo: " . $stmt_insert_detalle->error);
                        }
                    }
                }
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
