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
    ------------------------------------- INICIO ITred Spa Detalle encargado.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->


<link rel="stylesheet" href="../../css/nueva_cotizacion/detalle_encargado.css">
<fieldset class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
    <legend>Datos encargado</legend>
    <div class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
        <div class="form-group-inline">
            <div class="form-group">
                <label for="encargado_rut">RUT: </label> <!-- Etiqueta para el campo de entrada del RUT del cliente -->
                <input type="text" id="encargado-rut" name="encargado_rut" 
                    minlength="7" maxlength="12" 
                    placeholder="Ej: 12.345.678-9"
                    oninput="removeInvalidChars(this)"
                    required oninput="formatRut(this)"> <!-- Campo de texto para ingresar el RUT del cliente. También es obligatorio -->
            </div>
            <div class="form-group">
                <label for="enc_nombre">Nombre:</label> <!-- Etiqueta para el campo de entrada del nombre del encargado -->
                <input type="text" id="enc-nombre" name="enc_nombre" 
                    placeholder="Ej: Juan Pérez" 
                    required 
                    minlength="3" 
                    maxlength="50" 
                    pattern="^[a-zA-ZÀ-ÿ\s]+$" 
                    oninput="removeInvalidChars(this)"
                    title="Ingresa un nombre válido (Ej: Juan Pérez). Solo se permiten letras y espacios."> <!-- Campo de texto para ingresar el nombre del encargado. Este campo no es obligatorio -->
            </div>
        </div>
    
       
        <div class="form-group">
            <label for="enc_email">Email:</label> <!-- Etiqueta para el campo de entrada del email del encargado -->
            <input type="email" id="enc-email" name="enc_email"
                placeholder="ejemplo@gmail.com" 
                maxlength="255" 
                required 
                title="Ingresa un correo electrónico válido, como ejemplo@empresa.com" 
                oninput="removeInvalidChars(this)"
                onblur="completeEmail(this)"> <!-- Campo de correo electrónico para ingresar el email del encargado. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
        </div>
        <div class="form-group">
            <label for="enc_fono">Teléfono:</label> <!-- Etiqueta para el campo de entrada del teléfono del encargado -->
            
            <!-- Imagen de la bandera -->
            <img id="flag_encargado" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/Flag_of_None.svg/32px-Flag_of_None.svg.png" 
                alt="Bandera" style="display: none; margin-right: 10px;" width="32" height="20">

            <input type="text" id="enc-fono" name="enc_fono" 
                placeholder="+56 9 1234 1234" 
                maxlength="16" 
                required 
                title="Formato válido: +56 9 1234 1234 (código de país, seguido de número)"
                oninput="removeInvalidChars(this)"
                oninput="asegurarMasYDetectarPais2(this)"> <!-- Campo de texto para ingresar el teléfono del encargado -->
        </div>

    </div>
    <div class="box-6 data-box data-box-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "data-box-left" para estilo -->
        <div class="form-group">
            <label for="enc_celular">Celular:</label> <!-- Etiqueta para el campo de entrada del celular del encargado -->
            
            <!-- Imagen de la bandera -->
            <img id="flag_encargado_celular" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/Flag_of_None.svg/32px-Flag_of_None.svg.png" 
                alt="Bandera" style="display: none; margin-right: 10px;" width="32" height="20">

            <input type="text" id="en-_celular" name="enc_celular"
                placeholder="+56 9 1234 1234" 
                maxlength="16" 
                required 
                title="Formato válido: +56 9 1234 1234 (código de país, seguido de número)"
                oninput="removeInvalidChars(this)"
                oninput="asegurarMasYDetectarPais3(this)"> <!-- Campo de texto para ingresar el número de celular del encargado -->
        </div>

        <div class="form-group">
            <label for="enc_proyecto">Proyecto Asignado:</label> <!-- Etiqueta para el campo de entrada del proyecto asignado al encargado -->
            <input type="text" id="enc-proyecto" name="enc_proyecto" 
                placeholder="Ej: Proyecto XYZ" 
                minlength="3" 
                maxlength="100" 
                pattern="^[a-zA-ZÀ-ÿ0-9\s\-]+$" 
                oninput="removeInvalidChars(this)"
                title="Ingresa un nombre de proyecto válido (Ej: Proyecto XYZ). Solo se permiten letras, números, espacios y guiones."> <!-- Campo de texto para ingresar el nombre del proyecto asignado al encargado. No es obligatorio -->
        </div>
    </div>
</fieldset> <!-- Cierra la fila -->

<script src="../../js/nueva_cotizacion/detalle_encargado.js"></script> 

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario encargado
    $enc_rut = isset($_POST['encargado_rut']) ? trim($_POST['encargado_rut']) : null;
    $enc_nombre = isset($_POST['enc_nombre']) ? trim($_POST['enc_nombre']) : null;
    $enc_email = isset($_POST['enc_email']) ? trim($_POST['enc_email']) : null;
    $enc_fono = isset($_POST['enc_fono']) ? trim($_POST['enc_fono']) : null;
    $enc_celular = isset($_POST['enc_celular']) ? trim($_POST['enc_celular']) : null;
    $enc_proyecto = isset($_POST['enc_proyecto']) ? trim($_POST['enc_proyecto']) : null;

    // Verificación básica para campos requeridos
    if ($enc_rut && $enc_nombre) {
        // Insertar o actualizar el encargado
        $sql = "INSERT INTO C_Encargados (rut_encargado, nombre_encargado, email_encargado, fono_encargado, celular_encargado)
                VALUES (?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE 
                    nombre_encargado = VALUES(nombre_encargado), 
                    email_encargado = VALUES(email_encargado), 
                    fono_encargado = VALUES(fono_encargado), 
                    celular_encargado = VALUES(celular_encargado)";
        $stmt = $mysqli->prepare($sql);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $mysqli->error);
        }
        $stmt->bind_param("sssss", 
            $enc_rut, 
            $enc_nombre, 
            $enc_email, 
            $enc_fono, 
            $enc_celular
        );

        if (!$stmt->execute()) {
            die("Error en la ejecución de la consulta: " . $stmt->error);
        }

        // Obtener el ID del encargado después de la inserción/actualización
        $id_encargado = $stmt->insert_id;

        // Si no hay un nuevo ID, obtener el ID del encargado existente
        if ($id_encargado === 0) {
            $result = $mysqli->query("SELECT id_encargado FROM C_Encargados WHERE rut_encargado = '$enc_rut'");
            $row = $result->fetch_assoc();
            $id_encargado = $row['id_encargado'];
        }

        echo "Encargado insertado/actualizado. ID: $id_encargado<br>";
    } else {
        echo "El RUT y el nombre del encargado son obligatorios.";
    }
}
?>




     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Detalle encargado.PHP ----------------------------------------
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
