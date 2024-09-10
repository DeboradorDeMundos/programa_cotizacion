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
    ------------------------------------- INICIO ITred Spa Programa Cotizacion .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

     <?php
// Establecer la conexión a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');

// Variables para mensajes y estado de autenticación
$error = '';
$empresaEncontrada = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rut_empresa = $_POST['rut_empresa'];
    $nombre_empresa = $_POST['nombre_empresa'];

    // Consulta para verificar si la empresa existe
    $sql = "SELECT id_empresa FROM Empresa WHERE rut_empresa = ? AND nombre_empresa = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $rut_empresa, $nombre_empresa);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_empresa);
        $stmt->fetch();
        $_SESSION['id_empresa'] = $id_empresa; // Guardar el ID de la empresa en la sesión
        $empresaEncontrada = true;
    } else {
        $error = "Empresa no encontrada. Por favor, verifica los datos o crea una nueva empresa.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal - Cotización ITred Spa</title>
    <link rel="stylesheet" href="css/programa_cotizacion/programa_cotizacion.css">
    
</head>
<body>
    <h1>Menú Principal - Cotización ITred Spa</h1>

    <!-- Mostrar un mensaje de error si la empresa no se encuentra -->
    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <!-- Menú de navegación -->
    <nav>
        <ul class="menu">
            <li><a href="php/formulario_cotizacion/formulario_cotizacion.php?id=<?php echo $id_empresa; ?>" class="<?php echo $empresaEncontrada ? '' : 'disabled'; ?>">Nueva Cotización</a></li>
            <li><a href="php/crear_producto/crear_producto.php?id=<?php echo $id_empresa; ?>" class="<?php echo $empresaEncontrada ? '' : 'disabled'; ?>">Crear Producto</a></li>
            <li><a href="php/crear_proveedor/crear_proveedor.php" class="<?php echo $empresaEncontrada ? '' : 'disabled'; ?>">Crear Proveedor</a></li>
            <li><a href="php/ver_listado/ver_listado.php" class="<?php echo $empresaEncontrada ? '' : 'disabled'; ?>">Ver listado Cotización</a></li>
            <li><a href="php/crear_empresa/crear_empresa.php">Crear nueva empresa</a></li>
        </ul>
    </nav>

    <!-- Formulario para ingresar RUT y Nombre de la Empresa -->
    <form method="POST" action="">
        <label for="rut_empresa">RUT de la Empresa:</label>
        <input type="text" id="rut_empresa" name="rut_empresa" required>
        
        <label for="nombre_empresa">Nombre de la Empresa:</label>
        <input type="text" id="nombre_empresa" name="nombre_empresa" required>

        <button type="submit">Ingresar</button>
    </form>
    <script src="js/programa_cotizacion/obtener_rut_empresa.js"></script>

</body>
</html>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Programa Cotizacion .PHP ----------------------------------------
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
