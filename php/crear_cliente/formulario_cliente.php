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
    ------------------------------------- INICIO ITred Spa crear cliente.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
<head> 
    <!-- Define la codificación de caracteres como UTF-8 para asegurar la correcta visualización de caracteres especiales y diversos idiomas -->
    <meta charset="UTF-8"> 
    <!-- Configura la vista en dispositivos móviles. width=device-width asegura que el ancho de la página se ajuste al ancho de la pantalla del dispositivo, y initial-scale=1.0 establece el nivel de zoom inicial -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <!-- Define el título de la página que se muestra en la pestaña del navegador -->
    <title>Formulario Para Agregar Cliente</title> 
    <!-- Enlaza una hoja de estilo externa que se encuentra en la ruta especificada para estilizar el contenido de la página -->
    <link rel="stylesheet" href="../../css/crear_cliente/formulario_cliente.css"> 
    <!-- Cierra el elemento de cabecera -->
</head> 


<!-- Campo para el nombre del cliente -->
<div class="form-group">
    <label for="nombre_cliente">Nombre del Cliente:</label>
    <input type="text" id="nombre_cliente" name="nombre_cliente" required>
</div>

<!-- Campo para la empresa del cliente -->
<div class="form-group">
    <label for="empresa_cliente">Empresa del Cliente:</label>
    <input type="text" id="empresa_cliente" name="empresa_cliente">
</div>

<!-- Campo para el RUT del cliente -->
<div class="form-group">
    <label for="rut_cliente">RUT del Cliente:</label>
    <input type="text" id="rut_cliente" name="rut_cliente" required>
</div>

<!-- Campo para la dirección del cliente -->
<div class="form-group">
    <label for="direccion_cliente">Dirección del Cliente:</label>
    <input type="text" id="direccion_cliente" name="direccion_cliente">
</div>

<!-- Campo para el lugar del cliente -->
<div class="form-group">
    <label for="lugar_cliente">Lugar del Cliente:</label>
    <input type="text" id="lugar_cliente" name="lugar_cliente">
</div>

<!-- Campo para el teléfono del cliente -->
<div class="form-group">
    <label for="telefono_cliente">Teléfono del Cliente:</label>
    <input type="text" id="telefono_cliente" name="telefono_cliente">
</div>

<!-- Campo para el email del cliente -->
<div class="form-group">
    <label for="email_cliente">Email del Cliente:</label>
    <input type="email" id="email_cliente" name="email_cliente">
</div>

<!-- Campo para el cargo del cliente -->
<div class="form-group">
    <label for="cargo_cliente">Cargo del Cliente:</label>
    <input type="text" id="cargo_cliente" name="cargo_cliente">
</div>

<!-- Campo para el giro del cliente -->
<div class="form-group">
    <label for="giro_cliente">Giro del Cliente:</label>
    <input type="text" id="giro_cliente" name="giro_cliente">
</div>

<!-- Campo para la comuna del cliente -->
<div class="form-group">
    <label for="comuna_cliente">Comuna del Cliente:</label>
    <input type="text" id="comuna_cliente" name="comuna_cliente">
</div>

<!-- Campo para la ciudad del cliente -->
<div class="form-group">
    <label for="ciudad_cliente">Ciudad del Cliente:</label>
    <input type="text" id="ciudad_cliente" name="ciudad_cliente">
</div>

<!-- Campo para el tipo del cliente -->
<div class="form-group">
    <label for="tipo_cliente">Tipo del Cliente:</label>
    <input type="text" id="tipo_cliente" name="tipo_cliente">
</div>

<script src="../../js/crear_cliente/formulario_cliente.js"></script> 

<?php
// Comprueba si el formulario ha sido enviado mediante el método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura los datos del formulario y realiza una validación básica
    $nombre_cliente = $mysqli->real_escape_string($_POST['nombre_cliente']);
    $empresa_cliente = $mysqli->real_escape_string($_POST['empresa_cliente']);
    $rut_cliente = $mysqli->real_escape_string($_POST['rut_cliente']);
    $direccion_cliente = $mysqli->real_escape_string($_POST['direccion_cliente']);
    $lugar_cliente = $mysqli->real_escape_string($_POST['lugar_cliente']);
    $telefono_cliente = $mysqli->real_escape_string($_POST['telefono_cliente']);
    $email_cliente = $mysqli->real_escape_string($_POST['email_cliente']);
    $cargo_cliente = $mysqli->real_escape_string($_POST['cargo_cliente']);
    $giro_cliente = $mysqli->real_escape_string($_POST['giro_cliente']);
    $comuna_cliente = $mysqli->real_escape_string($_POST['comuna_cliente']);
    $ciudad_cliente = $mysqli->real_escape_string($_POST['ciudad_cliente']);
    $tipo_cliente = $mysqli->real_escape_string($_POST['tipo_cliente']);

    // Crea la consulta SQL para insertar un nuevo cliente en la base de datos
    $sql = "INSERT INTO C_Clientes (nombre_cliente, empresa_cliente, rut_cliente, direccion_cliente, lugar_cliente, telefono_cliente, email_cliente, cargo_cliente, giro_cliente, comuna_cliente, ciudad_cliente, tipo_cliente)
            VALUES ('$nombre_cliente', '$empresa_cliente', '$rut_cliente', '$direccion_cliente', '$lugar_cliente', '$telefono_cliente', '$email_cliente', '$cargo_cliente', '$giro_cliente', '$comuna_cliente', '$ciudad_cliente', '$tipo_cliente')";

    // Ejecuta la consulta y verifica si se insertó correctamente
    if ($mysqli->query($sql) === TRUE) {
        echo "Cliente creado exitosamente.";
    } else {
        echo "Error al crear el cliente: " . $mysqli->error;
    }
}
?>

 
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa crear cliente .PHP ----------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
