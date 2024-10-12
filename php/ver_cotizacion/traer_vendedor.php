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
    ------------------------------------- INICIO ITred Spa Traer vendedores .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<?php
// Inicializa las variables con valores por defecto
$vendedor_rut = $vendedor_nombre = $vendedor_email = $vendedor_telefono = $vendedor_celular = '';

// Verificar si se ha enviado un ID de vendedor
if (isset($_GET['id']) && intval($_GET['id']) > 0) {
    $id_vendedor = intval($_GET['id']);
    // Consulta para obtener los datos del vendedor basado en el ID
    $sql_vendedor = "SELECT 
        rut_vendedor,
        nombre_vendedor,
        email_vendedor,
        fono_vendedor,
        celular_vendedor
    FROM C_Vendedores
    WHERE id_vendedor = ?";

    if ($stmt_vendedor = $mysqli->prepare($sql_vendedor)) {
        $stmt_vendedor->bind_param("i", $id_vendedor);
        $stmt_vendedor->execute();
        $result_vendedor = $stmt_vendedor->get_result();
        
        if ($result_vendedor->num_rows === 1) {
            $row = $result_vendedor->fetch_assoc();
            // Asignar los valores a las variables
            $vendedor_rut = $row['rut_vendedor'];
            $vendedor_nombre = $row['nombre_vendedor'];
            $vendedor_email = $row['email_vendedor'];
            $vendedor_telefono = $row['fono_vendedor'];
            $vendedor_celular = $row['celular_vendedor'];
        } else {
            echo "<p>No se encontró el vendedor para el ID especificado.</p>";
        }

        $stmt_vendedor->close();
    } else {
        echo "<p>Error al preparar la consulta del vendedor: " . $mysqli->error . "</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario vendedor
    $vendedor_rut = isset($_POST['vendedor_rut']) ? trim($_POST['vendedor_rut']) : null;
    $vendedor_nombre = isset($_POST['vendedor_nombre']) ? trim($_POST['vendedor_nombre']) : null;
    $vendedor_email = isset($_POST['vendedor_email']) ? trim($_POST['vendedor_email']) : null;
    $vendedor_telefono = isset($_POST['vendedor_telefono']) ? trim($_POST['vendedor_telefono']) : null;
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
            $vendedor_telefono, 
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
<fieldset class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
    <legend>Detalle vendedor</legend>
    <div class="box-6 cuadro-datos"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
        <div class="form-group-inline">
            <div class="form-group">
                <label for="vendedor_rut">RUT: </label> <!-- Etiqueta para el campo de entrada del RUT del vendedor -->
                <input type="text" id="vendedor_rut" name="vendedor_rut" 
                    minlength="7" maxlength="12" 
                    placeholder="Ej: 12.345.678-9"
                    value="<?php echo htmlspecialchars($vendedor_rut); ?>" 
                    required 
                    oninput="FormatearRut(this)"
                    oninput="QuitarCaracteresInvalidos(this)"> <!-- Campo de texto para ingresar el RUT del vendedor. También es obligatorio -->
            </div>
            <div class="form-group">
                <label for="vendedor_nombre">Nombre:</label> <!-- Etiqueta para el campo de entrada del nombre del vendedor -->
                <input type="text" id="vendedor_nombre" name="vendedor_nombre" 
                    value="<?php echo htmlspecialchars($vendedor_nombre); ?>" 
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
                value="<?php echo htmlspecialchars($vendedor_email); ?>" 
                placeholder="ejemplo@gmail.com" 
                maxlength="255" 
                required 
                title="Ingresa un correo electrónico válido, como ejemplo@empresa.com" 
                oninput="QuitarCaracteresInvalidos(this)"
                onblur="CompletarEmail(this)"> <!-- Campo de correo electrónico para ingresar el email del vendedor. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico. También es obligatorio -->
        </div>
    </div>
    <div class="box-6 cuadro-datos cuadro-datos-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "cuadro-datos-left" para estilo -->
        <div class="form-group">
            <label for="vendedor_telefono">Teléfono:</label> <!-- Etiqueta para el campo de entrada del teléfono del vendedor -->
            <input type="text" id="vendedor_telefono" name="vendedor_telefono" 
                value="<?php echo htmlspecialchars($vendedor_telefono); ?>" 
                placeholder="+56 9 1234 1234" 
                maxlength="16" 
                title="Formato válido: +56 9 1234 1234 (código de país, seguido de número)"
                oninput="asegurarMasYDetectarPais4(this)"> <!-- Campo de texto para ingresar el teléfono del vendedor -->
        </div>
        <div class="form-group">
            <label for="vendedor_celular">Celular:</label> <!-- Etiqueta para el campo de entrada del celular del vendedor -->
            <input type="text" id="vendedor_celular" name="vendedor_celular" 
                value="<?php echo htmlspecialchars($vendedor_celular); ?>" 
                placeholder="+56 9 1234 1234" 
                maxlength="16" 
                title="Formato válido: +56 9 1234 1234 (código de país, seguido de número)"
                oninput="asegurarMasYDetectarPais5(this)"> <!-- Campo de texto para ingresar el número de celular del vendedor -->
        </div>
    </div>
</fieldset>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Traer vendedores .PHP ----------------------------------------
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
