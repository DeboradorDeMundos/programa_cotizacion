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
    ------------------------------------- INICIO ITred Spa Detalle vendedor.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<link rel="stylesheet" href="../../css/nueva_cotizacion/detalle_vendedor.css">
<fieldset class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
    <legend>Datos vendedor</legend>
    <div class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
        <div class="form-group-inline">
            <div class="form-group">
                <label for="vendedor_rut">RUT: </label> <!-- Etiqueta para el campo de entrada del RUT del cliente -->
                <input type="text" id="vendedor_rut" name="vendedor_rut" 
                    minlength="7" maxlength="12" 
                    placeholder="Ej: 12.345.678-9"
                    oninput="FormatearRut(this)"
                    oninput="QuitarCaracteresInvalidos(this)"
                    required> <!-- Campo de texto para ingresar el RUT del cliente. También es obligatorio -->
            </div>
            <div class="form-group">
                <label for="vendedor_nombre">Nombre:</label> <!-- Etiqueta para el campo de entrada del nombre del vendedor -->
                <input type="text" id="vendedor_nombre" name="vendedor_nombre" 
                    placeholder="Ej: María López" 
                    required 
                    minlength="3" 
                    maxlength="50" 
                    pattern="^[a-zA-ZÀ-ÿ\s]+$" 
                    oninput="QuitarCaracteresInvalidos(this)"
                    title="Ingresa un nombre válido (Ej: María López). Solo se permiten letras y espacios."> <!-- Campo de texto para ingresar el nombre del vendedor. El atributo "required" hace que el campo sea obligatorio -->
            </div>
        </div>
        
        <div class="form-group">
            <label for="vendedor_email">Email:</label> <!-- Etiqueta para el campo de entrada del email del vendedor -->
            <input type="email" id="vendedor_email" name="vendedor_email"
                placeholder="ejemplo@gmail.com" 
                maxlength="255" 
                required 
                title="Ingresa un correo electrónico válido, como ejemplo@empresa.com" 
                oninput="QuitarCaracteresInvalidos(this)"
                onblur="CompletarEmail(this)"> <!-- Campo de correo electrónico para ingresar el email del vendedor. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico. También es obligatorio -->
        </div>
    </div>
    <div class="box-6 data-box data-box-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "data-box-left" para estilo -->
        <div class="form-group">
            <label for="vendedor_telefono">Teléfono:</label> <!-- Etiqueta para el campo de entrada del teléfono del vendedor -->
            
            <!-- Imagen de la bandera -->
            <img id="flag_vendedor_telefono" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/Flag_of_None.svg/32px-Flag_of_None.svg.png" 
                alt="Bandera" style="display: none; margin-right: 10px;" width="32" height="20">

            <input type="text" id="vendedor_telefono" name="vendedor_telefono"
                placeholder="+56 9 1234 1234" 
                maxlength="16" 
                required 
                title="Formato válido: +56 9 1234 1234 (código de país, seguido de número)"
                oninput="asegurarMasYDetectarPais4(this)"> <!-- Campo de texto para ingresar el teléfono del vendedor -->
        </div>

        <div class="form-group">
    <label for="vendedor_celular">Celular:</label> <!-- Etiqueta para el campo de entrada del celular del vendedor -->
    
    <!-- Imagen de la bandera -->
    <img id="flag_vendedor_celular" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/Flag_of_None.svg/32px-Flag_of_None.svg.png" 
         alt="Bandera" style="display: none; margin-right: 10px;" width="32" height="20">

    <input type="text" id="vendedor_celular" name="vendedor_celular"
        placeholder="+56 9 1234 1234" 
        maxlength="16" 
        required 
        title="Formato válido: +56 9 1234 1234 (código de país, seguido de número)"
        oninput="asegurarMasYDetectarPais5(this)"> <!-- Campo de texto para ingresar el número de celular del vendedor -->
</div>

    </div>
</fieldset> <!-- Cierra la fila -->

<script src="../../js/nueva_cotizacion/detalle_vendedor.js"></script> 

<?php
// Verifica si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario vendedor
    $vendedor_rut = isset($_POST['vendedor_rut']) ? trim($_POST['vendedor_rut']) : null;
    $vendedor_nombre = isset($_POST['vendedor_nombre']) ? trim($_POST['vendedor_nombre']) : null;
    $vendedor_email = isset($_POST['vendedor_email']) ? trim($_POST['vendedor_email']) : null;
    $vendedor_fono = isset($_POST['vendedor_telefono']) ? trim($_POST['vendedor_telefono']) : null;
    $vendedor_celular = isset($_POST['vendedor_celular']) ? trim($_POST['vendedor_celular']) : null;

    // Verificación básica para campos requeridos
    if ($vendedor_rut && $vendedor_nombre) {
        // Insertar o actualizar el vendedor
        $sql = "INSERT INTO C_Vendedores (rut_vendedor, nombre_vendedor, email_vendedor, fono_vendedor, celular_vendedor)
                VALUES (?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE 
                    nombre_vendedor = VALUES(nombre_vendedor), 
                    email_vendedor = VALUES(email_vendedor), 
                    fono_vendedor = VALUES(fono_vendedor), 
                    celular_vendedor = VALUES(celular_vendedor)";
        $stmt = $mysqli->prepare($sql);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $mysqli->error);
        }
        $stmt->bind_param("sssss", 
            $vendedor_rut, 
            $vendedor_nombre, 
            $vendedor_email, 
            $vendedor_fono, 
            $vendedor_celular
        );

        if (!$stmt->execute()) {
            die("Error en la ejecución de la consulta: " . $stmt->error);
        }

        // Obtener el ID del vendedor después de la inserción/actualización
        $id_vendedor = $stmt->insert_id;

        // Si no hay un nuevo ID, obtener el ID del vendedor existente
        if ($id_vendedor === 0) {
            $result = $mysqli->query("SELECT id_vendedor FROM C_Vendedores WHERE rut_vendedor = '$vendedor_rut'");
            $row = $result->fetch_assoc();
            $id_vendedor = $row['id_vendedor'];
        }

        echo "Vendedor insertado/actualizado. ID: $id_vendedor<br>";
    } else {
        echo "El RUT y el nombre del vendedor son obligatorios.";
    }
}
?>


     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Detalle vendedor.PHP ----------------------------------------
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
