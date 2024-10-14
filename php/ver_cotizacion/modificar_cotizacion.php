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
    ------------------------------------- INICIO ITred Spa Modificar cotizacion .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

     <?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'ITredSpa_bd');
?>
<!-- ---------------------
// FIN CONEXION BD --
// --------------------- -->

<?php

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_cotizacion = (int) $_GET['id'];
    // Ejecutar consulta SQL con el ID recibido
} else {
    die("Error: ID de cotización no válida.");
}


// Consulta para obtener los datos de la empresa, cliente y detalles de la cotización
$query = "
    SELECT 
        cot.id_empresa,
        cot.numero_cotizacion,
        e.nombre_empresa,
        e.area_empresa,
        e.direccion_empresa,
        e.telefono_empresa,
        e.email_empresa,
        e.web_empresa,
        e.rut_empresa,
        e.id_foto,
        c.nombre_cliente,
        c.rut_cliente,
        c.direccion_cliente,
        c.giro_cliente,
        c.comuna_cliente,
        c.ciudad_cliente,
        c.telefono_cliente,
        cot.fecha_emision,
        cot.fecha_validez,
        enc.nombre_encargado,
        enc.rut_encargado,
        enc.email_encargado,
        enc.fono_encargado,
        enc.celular_encargado,
        ven.nombre_vendedor,
        ven.rut_vendedor,
        ven.email_vendedor,
        ven.fono_vendedor,
        ven.celular_vendedor
    FROM C_Cotizaciones cot
    JOIN C_Clientes c ON cot.id_cliente = c.id_cliente
    JOIN E_Empresa e ON cot.id_empresa = e.id_empresa
    JOIN C_Encargados enc ON cot.id_encargado = enc.id_encargado 
    JOIN C_Vendedores ven ON cot.id_vendedor = ven.id_vendedor 
    WHERE cot.id_cotizacion = ?
";

// Preparar la consulta
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id_cotizacion);

// Ejecutar la consulta
$stmt->execute();

// Obtener los resultados
$result = $stmt->get_result();

// Verificar si hay resultados
if ($result->num_rows > 0) {
    $items = $result->fetch_all(MYSQLI_ASSOC);
    $id_empresa = $items[0]['id_empresa']; // Guardar id_empresa para la siguiente consulta
    $id_foto = $items[0]['id_foto']; // Guardar id_foto para cargar la imagen

    $query_foto = "SELECT ruta_foto FROM e_fotosperfil WHERE id_foto = ?";
    $stmt_foto = $mysqli->prepare($query_foto);
    $stmt_foto->bind_param("i", $id_foto);
    
    // Ejecutar la consulta para la foto
    $stmt_foto->execute();
    $result_foto = $stmt_foto->get_result();
    
    // Verificar si se encontró la foto
    if ($result_foto->num_rows > 0) {
        $foto = $result_foto->fetch_assoc();
        $ruta_foto = $foto['ruta_foto']; // Obtener la ruta de la foto
    } else {
        $ruta_foto = null; // No se encontró la foto
    }
} else {
    echo "No se encontró la cotización o la empresa relacionada.";
}

$sql_firma = "
    SELECT 
        f.id_firma,
        f.id_empresa,
        f.titulo_firma, 
        f.nombre_encargado_firma, 
        f.cargo_encargado_firma, 
        f.telefono_encargado_firma,
        f.nombre_empresa_firma, 
        f.area_empresa_firma,
        f.telefono_empresa_firma, 
        f.firma_digital,
        f.email_firma, 
        f.direccion_firma, 
        f.ciudad_firma,
        f.pais_firma,
        f.rut_firma,
        f.web_firma,
        e.id_tipo_firma AS tipo_firma
    FROM E_Firmas f
    JOIN e_empresa e ON f.id_empresa = e.id_empresa
    WHERE f.id_empresa = ? 
    LIMIT 1";

if ($stmt_firma = $mysqli->prepare($sql_firma)) {
    $stmt_firma->bind_param("i", $id_empresa);
    $stmt_firma->execute();
    $result_firma = $stmt_firma->get_result();

    if ($result_firma->num_rows == 1) {
        $firma = $result_firma->fetch_assoc();
        
        $tipo_firma = $firma['tipo_firma'];
    } else {
        $firma = null; // No hay firma manual
    }

    $stmt_firma->close();
} else {
    echo "<p>Error al preparar la consulta de la firma: " . $mysqli->error . "</p>";
}
?>

<link rel="stylesheet" href="../../css/ver_cotizacion/cargar_logo_empresa.css">
<div class="box-6 caja-logo">
<?php
// Procesar la subida de la imagen cuando se envía el formulario
$upload_dir = '../../imagenes/cotizacion/'; // Ruta relativa desde el archivo PHP
$empresa_id_foto = null;

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha cargado una imagen sin errores
    if (isset($_FILES['logo_upload']) && $_FILES['logo_upload']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['logo_upload']['tmp_name'];
        $name = basename($_FILES['logo_upload']['name']);

        // Validar el tipo de archivo permitido
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['logo_upload']['type'], $allowed_types)) {
            die("Error: Tipo de archivo no permitido."); // Terminar si el tipo de archivo no es permitido
        }

        $upload_file = $upload_dir . $name; // Ruta del archivo a cargar

        // Mover el archivo cargado al directorio de destino
        if (move_uploaded_file($tmp_name, $upload_file)) {
            echo "Imagen subida correctamente."; // Mensaje de éxito

            // Insertar la ruta de la foto en la tabla FotosPerfil
            $sql_foto = "INSERT INTO C_FotosPerfil (ruta_foto) VALUES (?)";
            $stmt_foto = $mysqli->prepare($sql_foto);
            $stmt_foto->bind_param("s", $upload_file);
            // Ejecutar la inserción
            if ($stmt_foto->execute()) {
                echo "Foto del perfil insertada correctamente."; // Mensaje de éxito
                $empresa_id_foto = $mysqli->insert_id; // Obtener el ID de la foto insertada
            } else {
                die("Error al insertar la foto del perfil: " . $stmt_foto->error); // Mensaje de error
            }
            // Cerrar la consulta
            $stmt_foto->close();
        } else {
            die("."); // Mensaje de error si la subida falla
        }
    } else {
        echo "."; // Mensaje de error si no se subió una imagen
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Cotización</title>
    <link rel="stylesheet" href="../../css/ver_cotizacion/modificar_cotizacion.css">
</head>
<body>
    <?php echo isset($mensaje) ? $mensaje : ''; ?>
    
    <?php if (isset($items)): ?>
    <form method="POST" action="procesar_modificacion.php" enctype="multipart/form-data">
        <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
            <?php include 'cargar_logo_empresa.php'; ?>

            <?php include 'cuadro_rojo_cotizacion.php'; ?>

            <fieldset class="box-6 data-box"> 
                <label for="fecha_emision">Fecha de Emisión:</label> <!-- Etiqueta para el campo de entrada de la fecha de emisión -->
                <input type="date" id="fecha_emision" name="fecha_emision" required> <!-- Campo de fecha para seleccionar la fecha de emisión. Es obligatorio --> 
            </fieldset>
        </div> <!-- Cierra la fila -->

        <!-- Fila 2 -->
        <?php include 'datos_empresa.php'; ?>

        <!-- Fila 3 -->
        <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
            <?php include 'traer_proyecto.php'; ?>
        </div> <!-- Cierra la fila -->

        <!-- Fila 4 -->
         <?php include 'traer_cliente.php'; ?>

        <!-- Fila 5 -->
         <?php include 'traer_encargado.php'; ?>

        <!-- Fila 6 -->
         <?php include 'traer_vendedor.php'; ?>

            
        <!-- sección para Detalle de Cotización -->
         <?php include 'traer_detalle.php'; ?>

        <!-- Sección para los cálculos finales -->
         <?php include 'traer_totales.php'; ?>

         <?php include 'observaciones.php'; ?>

         <?php include 'traer_pago.php'; ?>

        <?php include 'traer_condiciones.php'; ?>

        <?php include 'traer_requisitos.php'; ?>

        <?php include 'obligaciones_cliente.php'; ?>

        <button type="submit" class="submit">Guardar cambios</button> <!-- Botón para enviar el formulario y generar la cotización -->
        
        </form> <!-- Cierra el formulario -->
        </div> <!-- Cierra el contenedor principal -->

        <?php include 'traer_datos_bancarios.php'; ?>

        <table>
        <tr>
            
            <td>
                <?php include 'posicionar_firma.php'; ?>

            </td>
        </tr>
        </table>
    <?php endif; ?>

    <ul>
        <li><a href="../ver_cotizacion/ver_cotizacion.php?id=<?php echo $id; ?>">Ver Cotización</a></li>
        <li><a href="../ver_listado/ver_listado.php">Volver al Listado</a></li>
    </ul>
          
    <script src="../../js/nueva_cotizacion/nueva_cotizacion.js"></script> <!-- Enlaza nuevamente el archivo JavaScript para manejar la lógica del formulario de cotización -->
    <script src="../../js/crear_empresa/upload_logo.js"></script>
    <script src="../../js/nueva_cotizacion/cargar_logo_empresa.js"></script> 
    <script src="../../js/nueva_cotizacion/cuadro_rojo_cotizacion.js"></script> 
    <script src="../../js/nueva_cotizacion/pago.js"></script> 


</body>
</html>


<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Modificar Cotizacion .PHP ----------------------------------------
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
