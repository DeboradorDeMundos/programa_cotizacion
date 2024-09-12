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



<fieldset class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
    <legend>Detalle encargado</legend>
    <div class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
        <div class="form-group-inline">
            <div class="form-group">
                <label for="encargado_rut">RUT: </label> <!-- Etiqueta para el campo de entrada del RUT del cliente -->
                <input type="text" id="encargado-rut" name="encargado_rut" 
                    minlength="7" maxlength="12" 
                    placeholder="x.xxx.xxx-x"
                    required oninput="formatRut(this)"> <!-- Campo de texto para ingresar el RUT del cliente. También es obligatorio -->
            </div>
            <div class="form-group">
                <label for="enc_nombre">Nombre:</label> <!-- Etiqueta para el campo de entrada del nombre del encargado -->
                <input type="text" id="enc_nombre" name="enc_nombre"> <!-- Campo de texto para ingresar el nombre del encargado. Este campo no es obligatorio -->
            </div>
        </div>
    
       
        <div class="form-group">
            <label for="enc_email">Email:</label> <!-- Etiqueta para el campo de entrada del email del encargado -->
            <input type="email" id="enc_email" name="enc_email"> <!-- Campo de correo electrónico para ingresar el email del encargado. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
        </div>
        <div class="form-group">
        <label for="enc_fono">Teléfono:</label> <!-- Etiqueta para el campo de entrada del teléfono del encargado -->
        <input type="text" id="enc_fono" name="enc_fono" pattern="\+?\d{7,15}" placeholder="+1234567890"> <!-- Campo de texto para ingresar el teléfono del encargado. Este campo no es obligatorio -->
        </div>
    </div>
    <div class="box-6 data-box data-box-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "data-box-left" para estilo -->
        <div class="form-group">
            <label for="enc_celular">Celular:</label> <!-- Etiqueta para el campo de entrada del celular del encargado -->
            <input type="text" id="enc_celular" name="enc_celular" pattern="\+?\d{7,15}" placeholder="+1234567890"> <!-- Campo de texto para ingresar el número de celular del encargado. Este campo no es obligatorio -->
        </div>
        <div class="form-group">
            <label for="enc_proyecto">Proyecto Asignado:</label> <!-- Etiqueta para el campo de entrada del proyecto asignado al encargado -->
            <input type="text" id="enc_proyecto" name="enc_proyecto"> <!-- Campo de texto para ingresar el nombre del proyecto asignado al encargado. No es obligatorio -->
        </div>
    </div>
</fieldset> <!-- Cierra la fila -->


<?php
$mysqli = new mysqli('localhost', 'root', '', 'ITredSpa_bd');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario encargado
    $enc_rut = isset($_POST['enc_rut']) ? trim($_POST['enc_rut']) : null;
    $enc_nombre = isset($_POST['enc_nombre']) ? trim($_POST['enc_nombre']) : null;
    $enc_email = isset($_POST['enc_email']) ? trim($_POST['enc_email']) : null;
    $enc_fono = isset($_POST['enc_fono']) ? trim($_POST['enc_fono']) : null;
    $enc_celular = isset($_POST['enc_celular']) ? trim($_POST['enc_celular']) : null;
    $enc_proyecto = isset($_POST['enc_proyecto']) ? trim($_POST['enc_proyecto']) : null;

    // Verificación básica para campos requeridos
    if ($enc_rut && $enc_nombre) {
        // Insertar o actualizar el encargado
        $sql = "INSERT INTO C_Encargados (rut_encargado, nombre_encargado, email_encargado, fono_encargado, celular_encargado, proyecto_encargado)
                VALUES (?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE 
                    nombre_encargado = VALUES(nombre_encargado), 
                    email_encargado = VALUES(email_encargado), 
                    fono_encargado = VALUES(fono_encargado), 
                    celular_encargado = VALUES(celular_encargado), 
                    proyecto_encargado = VALUES(proyecto_encargado)";
        $stmt = $mysqli->prepare($sql);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $mysqli->error);
        }
        $stmt->bind_param("ssssss", 
            $enc_rut, 
            $enc_nombre, 
            $enc_email, 
            $enc_fono, 
            $enc_celular, 
            $enc_proyecto
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
