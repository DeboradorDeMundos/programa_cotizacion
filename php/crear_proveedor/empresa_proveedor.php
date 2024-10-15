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
    ------------------------------------- INICIO ITred Spa crear proveedor.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
    <head> 
    <!-- Define la codificación de caracteres como UTF-8 para asegurar la correcta visualización de caracteres especiales y diversos idiomas -->
    <meta charset="UTF-8"> 
    <!-- Configura la vista en dispositivos móviles. width=device-width asegura que el ancho de la página se ajuste al ancho de la pantalla del dispositivo, y initial-scale=1.0 establece el nivel de zoom inicial -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <!-- Define el título de la página que se muestra en la pestaña del navegador -->
    <title>Formulario Para Agregar proveedor</title> 
    <!-- Enlaza una hoja de estilo externa que se encuentra en la ruta especificada para estilizar el contenido de la página -->
    <link rel="stylesheet" href="../../css/crear_proveedor/formulario_proveedor.css"> 
    <!-- Cierra el elemento de cabecera -->
</head> 

<!-- Campo para la empresa del proveedor -->
<div class="form-group">
    <label for="empresa_proveedor">Empresa del proveedor:</label>
    <input type="text" id="empresa_proveedor" name="empresa_proveedor">
</div>

<!-- Campo para el teléfono del proveedor -->
<div class="form-group">
    <label for="telefono_proveedor">Teléfono del proveedor:</label>
    <input type="text" id="telefono_proveedor" name="telefono_proveedor">
</div>

<!-- Campo para el giro del proveedor -->
<div class="form-group">
    <label for="giro_proveedor">Giro del proveedor:</label>
    <input type="text" id="giro_proveedor" name="giro_proveedor">
</div>

<!-- Campo para la comuna del proveedor -->
<div class="form-group">
    <label for="comuna_proveedor">Comuna del proveedor:</label>
    <input type="text" id="comuna_proveedor" name="comuna_proveedor">
</div>

<!-- Campo para la ciudad del proveedor -->
<div class="form-group">
    <label for="ciudad_proveedor">Ciudad del proveedor:</label>
    <input type="text" id="ciudad_proveedor" name="ciudad_proveedor">
</div>

<!-- Campo para el tipo del proveedor -->
<div class="form-group">
    <label for="tipo_proveedor">Tipo del proveedor:</label>
    <input type="text" id="tipo_proveedor" name="tipo_proveedor">
</div>

<script src="../../js/crear_proveedor/formulario_proveedor.js"></script> 

<?php
// Comprueba si el formulario ha sido enviado mediante el método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura los datos del formulario y realiza una validación básica
    $nombre_proveedor = $mysqli->real_escape_string($_POST['nombre_proveedor']);
    $empresa_proveedor = $mysqli->real_escape_string($_POST['empresa_proveedor']);
    $rut_proveedor = $mysqli->real_escape_string($_POST['rut_proveedor']);
    $direccion_proveedor = $mysqli->real_escape_string($_POST['direccion_proveedor']);
    $lugar_proveedor = $mysqli->real_escape_string($_POST['lugar_proveedor']);
    $telefono_proveedor = $mysqli->real_escape_string($_POST['telefono_proveedor']);
    $email_proveedor = $mysqli->real_escape_string($_POST['email_proveedor']);
    $cargo_proveedor = $mysqli->real_escape_string($_POST['cargo_proveedor']);
    $giro_proveedor = $mysqli->real_escape_string($_POST['giro_proveedor']);
    $comuna_proveedor = $mysqli->real_escape_string($_POST['comuna_proveedor']);
    $ciudad_proveedor = $mysqli->real_escape_string($_POST['ciudad_proveedor']);
    $tipo_proveedor = $mysqli->real_escape_string($_POST['tipo_proveedor']);
    echo "<pre>";
    print_r($_POST); // Muestra todos los datos enviados a través del formulario
    echo "</pre>";

    // Crea la consulta SQL para insertar un nuevo proveedor en la base de datos
    $sql = "INSERT INTO P_proveedor (nombre_proveedor, empresa_proveedor, rut_proveedor,
              direccion_proveedor, lugar_proveedor, telefono_proveedor, email_proveedor, cargo_proveedor, giro_proveedor, comuna_proveedor, ciudad_proveedor, tipo_proveedor)
            VALUES ('$nombre_proveedor', '$empresa_proveedor', '$rut_proveedor',
             '$direccion_proveedor', '$lugar_proveedor', '$telefono_proveedor', '$email_proveedor', '$cargo_proveedor', '$giro_proveedor', '$comuna_proveedor', '$ciudad_proveedor', '$tipo_proveedor')";

    // Ejecuta la consulta y verifica si se insertó correctamente
    if ($mysqli->query($sql) === TRUE) {
        echo "proveedor creado exitosamente.";
    } else {
        echo "Error al crear el proveedor: " . $mysqli->error;
    }
}
?>

 
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa crear proveedor .PHP ----------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
