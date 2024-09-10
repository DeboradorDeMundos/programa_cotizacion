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
// Conexión a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');

$error = '';
$empresaEncontrada = false;

// Definir la ruta manual para la prueba
$rutaPrueba = 'imagenes/programa_cotizacion/Captura de pantalla 2024-08-27 141315.png'; // Ruta manual para probar

// Función para ajustar la ruta de la imagen
function ajustarRuta($ruta) {
    // Elimina los primeros niveles "../" y añade la ruta base
    return preg_replace('/^(\.\.\/)+/', '', $ruta);
}

// Consulta SQL para obtener empresas y sus respectivas imágenes
$sql = "
    SELECT E_Empresa.id_empresa, E_Empresa.rut_empresa, E_Empresa.nombre_empresa, E_FotosPerfil.ruta_foto
    FROM E_Empresa
    LEFT JOIN E_FotosPerfil ON E_Empresa.id_foto = E_FotosPerfil.id_foto
";
$result = $mysqli->query($sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_empresa = $_POST['empresa'];

    if (!empty($id_empresa)) {
        $_SESSION['id_empresa'] = $id_empresa;
        $empresaEncontrada = true;
    } else {
        $error = "Por favor, seleccione una empresa.";
    }
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

    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <nav>
        <ul class="menu">
            <li><a href="php/nueva_cotizacion/nueva_cotizacion.php?id=<?php echo $id_empresa; ?>" class="<?php echo $empresaEncontrada ? '' : 'disabled'; ?>">Nueva Cotización</a></li>
            <li><a href="php/crear_producto/crear_producto.php?id=<?php echo $id_empresa; ?>" class="<?php echo $empresaEncontrada ? '' : 'disabled'; ?>">Crear Producto</a></li>
            <li><a href="php/crear_proveedor/crear_proveedor.php" class="<?php echo $empresaEncontrada ? '' : 'disabled'; ?>">Crear Proveedor</a></li>
            <li><a href="php/programa_cotizacion/ver_listado.php" class="<?php echo $empresaEncontrada ? '' : 'disabled'; ?>">Ver listado Cotización</a></li>
            <li><a href="php/crear_empresa/crear_empresa.php">Crear nueva empresa</a></li>
        </ul>
    </nav>

    <!-- Formulario para seleccionar la Empresa -->
    <form method="POST" action="">
        <label for="empresa">Seleccione la Empresa:</label>
        <div class="custom-select">
            <div class="selected-option">Seleccione una empresa</div>
            <select id="empresa" name="empresa" required>
                <option value="">Seleccione</option>
                <?php
                // Reposición del puntero del resultado al principio para volver a recorrerlo
                $result->data_seek(0); 
                while ($row = $result->fetch_assoc()): 
                    $rutaAjustada = ajustarRuta($row['ruta_foto']);
                ?>
                    <option value="<?php echo $row['id_empresa']; ?>" data-image="<?php echo $rutaAjustada; ?>">
                        <?php echo $row['rut_empresa'] . " - " . $row['nombre_empresa']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <div class="option-list" id="option-list">
                <?php
                // Reposición del puntero del resultado al principio para volver a recorrerlo
                $result->data_seek(0); 
                while ($row = $result->fetch_assoc()): 
                    $rutaAjustada = ajustarRuta($row['ruta_foto']);
                ?>
                    <div data-value="<?php echo $row['id_empresa']; ?>" data-image="<?php echo $rutaAjustada; ?>">
                        <img src="<?php echo $rutaAjustada; ?>" alt="Foto de <?php echo $row['nombre_empresa']; ?>">
                        <?php echo $row['rut_empresa'] . " - " . $row['nombre_empresa']; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <input type="hidden" id="selected-empresa" name="empresa" />
        <button type="submit">Seleccionar</button>
    </form>
    <script src="js/programa_cotizacion/programa_cotizacion.js"></script> 
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
