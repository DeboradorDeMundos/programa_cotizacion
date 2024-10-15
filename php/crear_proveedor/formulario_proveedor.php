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


<!-- Campo para el nombre del proveedor -->
<div class="form-group">
    <label for="nombre_proveedor">Nombre del proveedor:</label>
    <input type="text" id="nombre_proveedor" name="nombre_proveedor" required>
</div>

<!-- Campo para el RUT del proveedor -->
<div class="form-group">
    <label for="rut_proveedor">RUT del proveedor:</label>
    <input type="text" id="rut_proveedor" name="rut_proveedor" required>
</div>

<!-- Campo para la dirección del proveedor -->
<div class="form-group">
    <label for="direccion_proveedor">Dirección del proveedor:</label>
    <input type="text" id="direccion_proveedor" name="direccion_proveedor">
</div>

<!-- Campo para el lugar del proveedor -->
<div class="form-group">
    <label for="lugar_proveedor">Lugar del proveedor:</label>
    <input type="text" id="lugar_proveedor" name="lugar_proveedor">
</div>

<!-- Campo para el email del proveedor -->
<div class="form-group">
    <label for="email_proveedor">Email del proveedor:</label>
    <input type="email" id="email_proveedor" name="email_proveedor">
</div>

<!-- Campo para el cargo del proveedor -->
<div class="form-group">
    <label for="cargo_proveedor">Cargo del proveedor:</label>
    <input type="text" id="cargo_proveedor" name="cargo_proveedor">
</div>
<script src="../../js/crear_proveedor/formulario_proveedor.js"></script> 
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa crear proveedor .PHP ----------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
