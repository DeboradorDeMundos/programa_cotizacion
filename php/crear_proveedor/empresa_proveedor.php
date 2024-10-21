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
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Formulario Para Agregar proveedor</title> 
    <link rel="stylesheet" href="../../css/crear_proveedor/empresa_proveedor.css"> 
</head> 

<!-- TÍTULO: CAMPO PARA LA EMPRESA DEL PROVEEDOR -->
    <!-- Campo para la empresa del proveedor -->
    <div class="form-group">
        <label for="empresa_proveedor">Empresa del proveedor:</label>
        <input type="text" id="empresa_proveedor" name="empresa_proveedor" required>
    </div>

<!-- TÍTULO: CAMPO PARA EL RUT DE LA EMPRESA DEL PROVEEDOR -->
    <!-- Campo para el RUT de la empresa del proveedor -->
    <div class="form-group">
        <label for="rut_empresa_proveedor">RUT de la empresa:</label>
        <input type="text" id="rut_empresa_proveedor" name="rut_empresa_proveedor" required>
    </div>

<!-- TÍTULO: CAMPO PARA LA DIRECCIÓN DE LA EMPRESA DEL PROVEEDOR -->
    <!-- Campo para la dirección de la empresa del proveedor -->
    <div class="form-group">
        <label for="direccion_empresa_proveedor">Dirección de la empresa:</label>
        <input type="text" id="direccion_empresa_proveedor" name="direccion_empresa_proveedor" required>
    </div>

<!-- TÍTULO: CAMPO PARA EL TELÉFONO DE LA EMPRESA DEL PROVEEDOR -->
    <!-- Campo para el teléfono de la empresa del proveedor -->
    <div class="form-group">
        <label for="telefono_empresa_proveedor">Teléfono de la empresa:</label>
        <input type="text" id="telefono_empresa_proveedor" name="telefono_empresa_proveedor" required>
    </div>

<!-- TÍTULO: CAMPO PARA EL EMAIL DE LA EMPRESA DEL PROVEEDOR -->
    <!-- Campo para el email de la empresa del proveedor -->
    <div class="form-group">
        <label for="email_empresa_proveedor">Email de la empresa:</label>
        <input type="email" id="email_empresa_proveedor" name="email_empresa_proveedor" required>
    </div>

<!-- TÍTULO: CAMPO PARA LA COMUNA DE LA EMPRESA DEL PROVEEDOR -->
    <!-- Campo para la comuna de la empresa del proveedor -->
    <div class="form-group">
        <label for="comuna_empresa_proveedor">Comuna de la empresa:</label>
        <input type="text" id="comuna_empresa_proveedor" name="comuna_empresa_proveedor" required>
    </div>

<!-- TÍTULO: CAMPO PARA LA CIUDAD DE LA EMPRESA DEL PROVEEDOR -->
    <!-- Campo para la ciudad de la empresa del proveedor -->
    <div class="form-group">
        <label for="ciudad_empresa_proveedor">Ciudad de la empresa:</label>
        <input type="text" id="ciudad_empresa_proveedor" name="ciudad_empresa_proveedor" required>
    </div>

<!-- TÍTULO: CAMPO PARA EL GIRO DE LA EMPRESA DEL PROVEEDOR -->
    <!-- Campo para el giro de la empresa del proveedor -->
    <div class="form-group">
        <label for="giro_proveedor">Giro de la empresa:</label>
        <select id="giro_proveedor" name="giro_proveedor" required>
            <option value="">Seleccione...</option> <!-- Añadir opción vacía para evitar selección vacía -->
            <option value="comercial">Comercial</option>
            <option value="industrial">Industrial</option>
            <option value="servicios">Servicios</option>
            <option value="construccion">Construcción</option>
            <option value="agropecuario">Agropecuario</option>
            <option value="tecnologia">Tecnología</option>
            <option value="transporte">Transporte</option>
            <option value="turismo">Turismo</option>
            <option value="educacion">Educación</option>
            <option value="financiero">Financiero</option>
        </select>
    </div>


<script src="../../js/crear_proveedor/formulario_proveedor.js"></script> 



<?php
// Comprueba si el formulario ha sido enviado mediante el método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura los datos del formulario y realiza una validación básica
    $nombre_proveedor = $mysqli->real_escape_string($_POST['nombre_proveedor']);
    $rut_proveedor = $mysqli->real_escape_string($_POST['rut_proveedor']);
    $telefono_proveedor = $mysqli->real_escape_string($_POST['telefono_proveedor']);
    $email_proveedor = $mysqli->real_escape_string($_POST['email_proveedor']);
    $direccion_proveedor = $mysqli->real_escape_string($_POST['direccion_proveedor']);
    $cargo_proveedor = $mysqli->real_escape_string($_POST['cargo_proveedor']);
    $comuna_proveedor = $mysqli->real_escape_string($_POST['comuna_proveedor']);
    $ciudad_proveedor = $mysqli->real_escape_string($_POST['ciudad_proveedor']);
    $tipo_proveedor = $mysqli->real_escape_string($_POST['tipo_proveedor']);
    echo "<pre>";
    print_r($_POST); // Muestra los datos enviados
    echo "</pre>";
    // Empresa
    $empresa_proveedor = $mysqli->real_escape_string($_POST['empresa_proveedor']);
    $rut_empresa_proveedor = $mysqli->real_escape_string($_POST['rut_empresa_proveedor']);
    $direccion_empresa_proveedor = $mysqli->real_escape_string($_POST['direccion_empresa_proveedor']);
    $telefono_empresa_proveedor = $mysqli->real_escape_string($_POST['telefono_empresa_proveedor']);
    $email_empresa_proveedor = $mysqli->real_escape_string($_POST['email_empresa_proveedor']);
    $comuna_empresa_proveedor = $mysqli->real_escape_string($_POST['comuna_empresa_proveedor']);
    $ciudad_empresa_proveedor = $mysqli->real_escape_string($_POST['ciudad_empresa_proveedor']);
    
    // Verifica si el giro_proveedor está establecido
    $giro_proveedor = isset($_POST['giro_proveedor']) ? $mysqli->real_escape_string($_POST['giro_proveedor']) : '';

    // Muestra los datos enviados a través del formulario para debug
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    
 // Crea la consulta SQL para insertar un nuevo proveedor en la base de datos
 $sql = "INSERT INTO P_proveedor (
    nombre_proveedor, 
    rut_proveedor, 
    telefono_proveedor, 
    email_proveedor, 
    direccion_proveedor, 
    cargo_proveedor, 
    comuna_proveedor, 
    ciudad_proveedor, 
    tipo_proveedor,
    empresa_proveedor, 
    rut_empresa_proveedor,
    direccion_empresa_proveedor, 
    telefono_empresa_proveedor, 
    email_empresa_proveedor, 
    comuna_empresa_proveedor, 
    ciudad_empresa_proveedor, 
    giro_proveedor
) VALUES (
    '$nombre_proveedor', 
    '$rut_proveedor', 
    '$telefono_proveedor', 
    '$email_proveedor', 
    '$direccion_proveedor', 
    '$cargo_proveedor', 
    '$comuna_proveedor', 
    '$ciudad_proveedor', 
    '$tipo_proveedor',
    '$empresa_proveedor', 
    '$rut_empresa_proveedor',
    '$direccion_empresa_proveedor', 
    '$telefono_empresa_proveedor', 
    '$email_empresa_proveedor', 
    '$comuna_empresa_proveedor', 
    '$ciudad_empresa_proveedor', 
    '$giro_proveedor'
)";


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
