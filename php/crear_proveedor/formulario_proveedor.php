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
    ------------------------------------- INICIO ITred Spa formulario proveedor.PHP --------------------------------------
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

<!-- TÍTULO: CAMPO PARA EL NOMBRE DEL PROVEEDOR -->
    <!-- Campo para el nombre del proveedor -->
    <div class="form-group">
        <label for="nombre_proveedor">Nombre del proveedor:</label>
        <input type="text" id="nombre_proveedor" name="nombre_proveedor" required>
        <span id="nombre_error" style="color: red; display: none;">El nombre debe comenzar con una mayúscula y solo puede contener letras y espacios.</span>
    </div>

<!-- TÍTULO: CAMPO PARA EL RUT DEL PROVEEDOR -->
    <!-- Campo para el RUT del proveedor -->
    <div class="form-group">
        <label for="rut_proveedor">RUT del proveedor:</label>
        <input type="text" id="rut_proveedor" name="rut_proveedor" required>
        <span id="rut_error" style="color: red; display: none;">El RUT debe tener hasta 9 números y terminar con un número o la letra 'K'.</span>
    </div>

<!-- TÍTULO: CAMPO PARA EL TELÉFONO DEL PROVEEDOR -->
    <!-- Campo para el teléfono del proveedor -->
    <div class="form-group">
        <label for="telefono_proveedor">Teléfono del proveedor:</label>
        <input type="tel" id="telefono_proveedor" name="telefono_proveedor" required>
        <span id="telefono_error" style="color: red; display: none;">El teléfono debe contener solo 9 números y no puede incluir letras ni caracteres especiales.</span>
    </div>

<!-- TÍTULO: CAMPO PARA EL EMAIL DEL PROVEEDOR -->
    <!-- Campo para el email del proveedor -->
    <div class="form-group">
        <label for="email_proveedor">Email del proveedor:</label>
        <input type="email" id="email_proveedor" name="email_proveedor" required>
        <span id="email_error" style="color: red; display: none;">Correo electrónico inválido. Debe contener un '@' y terminar en .cl, .com, u otra extensión válida.</span>
    </div>

<!-- TÍTULO: CAMPO PARA LA DIRECCIÓN DEL PROVEEDOR -->
    <!-- Campo para la dirección del proveedor -->
    <div class="form-group">
        <label for="direccion_proveedor">Dirección del proveedor:</label>
        <input type="text" id="direccion_proveedor" name="direccion_proveedor" required>
    </div>

<!-- TÍTULO: CAMPO PARA EL CARGO DEL PROVEEDOR -->
    <!-- Campo para el cargo del proveedor -->
    <div class="form-group">
        <label for="cargo_proveedor">Cargo del proveedor:</label>
        <input type="text" id="cargo_proveedor" name="cargo_proveedor">
    </div>

<!-- TÍTULO: CAMPO PARA LA COMUNA DEL PROVEEDOR -->
    <!-- Campo para la comuna del proveedor -->
    <div class="form-group">
        <label for="comuna_proveedor">Comuna del proveedor:</label>
        <input type="text" id="comuna_proveedor" name="comuna_proveedor">
    </div>

<!-- TÍTULO: CAMPO PARA LA CIUDAD DEL PROVEEDOR -->
    <!-- Campo para la ciudad del proveedor -->
    <div class="form-group">
        <label for="ciudad_proveedor">Ciudad del proveedor:</label>
        <input type="text" id="ciudad_proveedor" name="ciudad_proveedor">
    </div>

<!-- TÍTULO: CAMPO PARA EL TIPO DE PROVEEDOR -->
    <!-- Campo para el tipo de proveedor -->
    <div class="form-group">
        <label for="tipo_proveedor">Tipo de proveedor:</label>
        <select id="tipo_proveedor" name="tipo_proveedor">
            <option value="local">Local</option>
            <option value="internacional">Internacional</option>
        </select>
    </div>

<script src="../../js/crear_proveedor/formulario_proveedor.js"></script> 




<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa formulario proveedor .PHP ----------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
