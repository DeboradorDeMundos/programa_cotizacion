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
    ------------------------------------- INICIO ITred Spa Traer encargado .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<?php
// Inicializa las variables con valores por defecto
$enc_rut = $enc_nombre = $enc_email = $enc_fono = $enc_celular = '';

// Verificar si se ha enviado un ID de encargado
if (isset($_GET['id']) && intval($_GET['id']) > 0) {
    $id_encargado = intval($_GET['id']);
    // Consulta para obtener los datos del encargado basado en el ID
    $sql_encargado = "SELECT 
        e.rut_encargado,
        e.nombre_encargado,
        e.email_encargado,
        e.fono_encargado,
        e.celular_encargado
    FROM C_Cotizaciones cot
    JOIN  C_Encargados e on e.id_encargado = cot.id_encargado
    WHERE cot.id_cotizacion = ?";

    if ($stmt_encargado = $mysqli->prepare($sql_encargado)) {
        $stmt_encargado->bind_param("i", $id_encargado);
        $stmt_encargado->execute();
        $result_encargado = $stmt_encargado->get_result();
        
        if ($result_encargado->num_rows === 1) {
            $row = $result_encargado->fetch_assoc();
            // Asignar los valores a las variables
            $enc_rut = $row['rut_encargado'];
            $enc_nombre = $row['nombre_encargado'];
            $enc_email = $row['email_encargado'];
            $enc_fono = $row['fono_encargado'];
            $enc_celular = $row['celular_encargado'];
        } else {
            echo "<p>No se encontró el encargado para el ID especificado.</p>";
        }

        $stmt_encargado->close();
    } else {
        echo "<p>Error al preparar la consulta del encargado: " . $mysqli->error . "</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario encargado
    $enc_rut = isset($_POST['encargado_rut']) ? trim($_POST['encargado_rut']) : null;
    $enc_nombre = isset($_POST['enc_nombre']) ? trim($_POST['enc_nombre']) : null;
    $enc_email = isset($_POST['enc_email']) ? trim($_POST['enc_email']) : null;
    $enc_fono = isset($_POST['enc_fono']) ? trim($_POST['enc_fono']) : null;
    $enc_celular = isset($_POST['enc_celular']) ? trim($_POST['enc_celular']) : null;

    // Verificación básica para campos requeridos
    if ($enc_rut && $enc_nombre) {
        // Insertar o actualizar el encargado
        $sql = "INSERT INTO C_Encargados (rut_encargado, nombre_encargado, email_encargado, fono_encargado, celular_encargado, proyecto_asignado)
                VALUES (?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE 
                    nombre_encargado = VALUES(nombre_encargado), 
                    email_encargado = VALUES(email_encargado), 
                    fono_encargado = VALUES(fono_encargado), 
                    celular_encargado = VALUES(celular_encargado),
                    proyecto_asignado = VALUES(proyecto_asignado)";
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
<!-- TÍTULO: FILA PARA MODIFICAR DATOS DEL ENCARGADO -->
<fieldset class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
    <legend>Modificar Datos Encargado</legend>
    <!-- TÍTULO: CAJA PARA INGRESAR DATOS DEL ENCARGADO (6 COLUMNAS) -->
    <div class="box-6 cuadro-datos"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
        <div class="form-group-inline">
            <!-- TÍTULO: GRUPO DE FORMULARIO PARA RUT Y NOMBRE -->
            <div class="form-group">
                <!-- TÍTULO: ETIQUETA PARA EL CAMPO DE ENTRADA DEL RUT DEL ENCARGADO -->
                <label for="encargado_rut">RUT: </label>
                <!-- TÍTULO: CAMPO DE TEXTO PARA INGRESAR EL RUT DEL ENCARGADO -->
                <input type="text" id="encargado_rut" name="encargado_rut" 
                    minlength="7" maxlength="12" 
                    placeholder="Ej: 12.345.678-9" 
                    value="<?php echo htmlspecialchars($enc_rut); ?>" 
                    required oninput="FormatearRut(this)"> <!-- También es obligatorio -->
            </div>
            <!-- TÍTULO: GRUPO DE FORMULARIO PARA NOMBRE -->
            <div class="form-group">
                <!-- TÍTULO: ETIQUETA PARA EL CAMPO DE ENTRADA DEL NOMBRE DEL ENCARGADO -->
                <label for="enc_nombre">Nombre:</label> 
                <!-- TÍTULO: CAMPO DE TEXTO PARA INGRESAR EL NOMBRE DEL ENCARGADO -->
                <input type="text" id="enc_nombre" name="enc_nombre" 
                    placeholder="Ej: Juan Pérez" 
                    value="<?php echo htmlspecialchars($enc_nombre); ?>" 
                    required 
                    minlength="3" 
                    maxlength="50" 
                    pattern="^[a-zA-ZÀ-ÿ\s]+$" 
                    title="Ingresa un nombre válido (Ej: Juan Pérez). Solo se permiten letras y espacios."> <!-- Este campo es obligatorio -->
            </div>
        </div>

        <!-- TÍTULO: GRUPO DE FORMULARIO PARA EMAIL -->
        <div class="form-group">
            <!-- TÍTULO: ETIQUETA PARA EL CAMPO DE ENTRADA DEL EMAIL DEL ENCARGADO -->
            <label for="enc_email">Email:</label> 
            <!-- TÍTULO: CAMPO DE CORREO ELECTRÓNICO PARA INGRESAR EL EMAIL DEL ENCARGADO -->
            <input type="email" id="enc_email" name="enc_email" 
                placeholder="ejemplo@gmail.com" 
                maxlength="255" 
                value="<?php echo htmlspecialchars($enc_email); ?>" 
                required 
                title="Ingresa un correo electrónico válido, como ejemplo@empresa.com"> <!-- El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
        </div>
        <!-- TÍTULO: GRUPO DE FORMULARIO PARA TELÉFONO -->
        <div class="form-group">
            <!-- TÍTULO: ETIQUETA PARA EL CAMPO DE ENTRADA DEL TELÉFONO DEL ENCARGADO -->
            <label for="enc_fono">Teléfono:</label> 
            <!-- TÍTULO: CAMPO DE TEXTO PARA INGRESAR EL TELÉFONO DEL ENCARGADO -->
            <input type="text" id="enc_fono" name="enc_fono" 
                pattern="\+?\d{7,15}" 
                placeholder="+56 9 1234 1234" 
                value="<?php echo htmlspecialchars($enc_fono); ?>" 
                required 
                title="Formato válido: +56 9 1234 1234 (código de país, seguido de número)"> 
        </div>
    </div>
    <!-- TÍTULO: CAJA PARA INGRESAR DATOS ADICIONALES DEL ENCARGADO (6 COLUMNAS) -->
    <div class="box-6 cuadro-datos cuadro-datos-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "cuadro-datos-left" para estilo -->
        <!-- TÍTULO: GRUPO DE FORMULARIO PARA CELULAR -->
        <div class="form-group">
            <!-- TÍTULO: ETIQUETA PARA EL CAMPO DE ENTRADA DEL CELULAR DEL ENCARGADO -->
            <label for="enc_celular">Celular:</label> 
            <!-- TÍTULO: CAMPO DE TEXTO PARA INGRESAR EL NÚMERO DE CELULAR DEL ENCARGADO -->
            <input type="text" id="enc_celular" name="enc_celular" 
                pattern="\+?\d{7,15}" 
                placeholder="+56 9 1234 1234" 
                value="<?php echo htmlspecialchars($enc_celular); ?>"> <!-- Este campo no es obligatorio -->
        </div>
        <!-- TÍTULO: GRUPO DE FORMULARIO PARA PROYECTO ASIGNADO -->
        <div class="form-group">
            <!-- TÍTULO: ETIQUETA PARA EL CAMPO DE ENTRADA DEL PROYECTO ASIGNADO AL ENCARGADO -->
            <label for="enc_proyecto">Proyecto Asignado:</label> 
            <!-- TÍTULO: CAMPO DE TEXTO PARA INGRESAR EL NOMBRE DEL PROYECTO ASIGNADO AL ENCARGADO -->
            <input type="text" id="enc_proyecto" name="enc_proyecto" 
                placeholder="Ej: Proyecto XYZ" 
                value="<?php echo htmlspecialchars($enc_proyecto); ?>" 
                minlength="3" 
                maxlength="100" 
                pattern="^[a-zA-ZÀ-ÿ0-9\s\-]+$" 
                title="Ingresa un nombre de proyecto válido (Ej: Proyecto XYZ). Solo se permiten letras, números, espacios y guiones."> <!-- No es obligatorio -->
        </div>
    </div>
</fieldset> <!-- Cierra la fila -->

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Traer encargado .PHP ----------------------------------------
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
