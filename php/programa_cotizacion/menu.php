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
    ------------------------------------- INICIO ITred Spa Menu.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->


    
     <h1>Menú Principal - Cotización ITred Spa</h1>

<!-- Sección para mostrar errores -->
<?php
$error = ''; // Variable para almacenar mensajes de error
$empresaEncontrada = false; // Variable para controlar si se ha seleccionado una empresa

// Verifica si el formulario se ha enviado, es necesario en este lugar para habilitar el menu (NAV)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_empresa = $_POST['empresa']; // Obtiene el ID de la empresa seleccionada

    // Comprueba si el ID de la empresa no está vacío
    if (!empty($id_empresa)) {
        $_SESSION['id_empresa'] = $id_empresa; // Guarda el ID de la empresa en la sesión
        $empresaEncontrada = true; // Marca que la empresa ha sido encontrada
    } else {
        $error = "Por favor, seleccione una empresa."; // Mensaje de error si no se selecciona una empresa
    }
}
?>

<!-- Muestra el mensaje de error, si existe -->
<?php if ($error): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<!-- Menú de navegación -->
<head>
<link rel="stylesheet" href="css/programa_cotizacion/menu.css">
</head>

<!-- Título: Navegación Principal -->
<nav>  
    <ul class="menu">
        <!-- Título: Enlace para Nueva Cotización -->
        <li>
            <a href="php/nueva_cotizacion/nueva_cotizacion.php?id=<?php echo isset($_SESSION['id_empresa']) ? $_SESSION['id_empresa'] : ''; ?>" class="<?php echo $empresaEncontrada ? '' : 'disabled'; ?>">
                Nueva Cotización
            </a>
        </li>
        
        <!-- Título: Enlace para Crear Cliente -->
        <li>
            <a href="php/crear_cliente/crear_cliente.php?id=<?php echo isset($_SESSION['id_empresa']) ? $_SESSION['id_empresa'] : ''; ?>" class="<?php echo $empresaEncontrada ? '' : 'disabled'; ?>">
                Crear Cliente
            </a>
        </li>
        
        <!-- Título: Enlace para Crear Producto -->
        <li>
            <a href="php/crear_producto/crear_producto.php?id=<?php echo isset($_SESSION['id_empresa']) ? $_SESSION['id_empresa'] : ''; ?>" class="<?php echo $empresaEncontrada ? '' : 'disabled'; ?>">
                Crear Producto
            </a>
        </li>
        
        <!-- Título: Enlace para Crear Proveedor -->
        <li>
            <a href="php/crear_proveedor/crear_proveedor.php" class="<?php echo $empresaEncontrada ? '' : 'disabled'; ?>">
                Crear Proveedor
            </a>
        </li>
        
        <!-- Título: Enlace para Ver Listado de Cotización -->
        <li>
            <a href="php/ver_cotizacion/ver_listado.php?id=<?php echo isset($_SESSION['id_empresa']) ? $_SESSION['id_empresa'] : ''; ?>" class="<?php echo $empresaEncontrada ? '' : 'disabled'; ?>">
                Ver listado Cotización
            </a>
        </li>
        
        <!-- Título: Enlace para Crear Nueva Empresa -->
        <li>
            <a href="php/crear_empresa/crear_empresa.php">
                Crear nueva empresa
            </a>
        </li>
    </ul>
</nav>


<script src="js/programa_cotizacion/menu.js"></script> 







     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Menu .PHP ----------------------------------------
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



