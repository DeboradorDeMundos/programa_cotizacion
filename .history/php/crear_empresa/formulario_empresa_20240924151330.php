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
    ------------------------------------- INICIO ITred Spa Formulario Empresa.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
<link rel="stylesheet" href="../../css/crear_empresa/formulario_empresa.css">
<div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
    <div class="box-12 data-box"> <!-- Crea una caja para ingresar datos, ocupando las 12 columnas disponibles en el diseño. Esta caja contiene varios campos de entrada de datos -->

        <label for="empresa_nombre">Nombre de la Empresa:</label>
        <input type="text" id="empresa_nombre" name="empresa_nombre" required minlength="3" maxlength="100" 
            pattern="^[A-Za-zÀ-ÿ0-9\s&.-]+$" 
            title="Por favor, ingrese solo letras, números y caracteres como &,-."
            placeholder="Ejemplo: Mi Empresa S.A.">

        <label for="empresa_area">Área de la Empresa:</label>
        <input type="text" id="empresa_area" name="empresa_area" 
            minlength="2" maxlength="50" 
            pattern="^[A-Za-zÀ-ÿ\s&.-]*$" 
            title="Por favor, ingrese solo letras y espacios. Los caracteres permitidos son &, - y .."
            placeholder="Ejemplo: Tecnología">

        <label for="empresa_direccion">Dirección de la Empresa:</label>
        <input type="text" id="empresa_direccion" name="empresa_direccion" 
            minlength="5" maxlength="100" 
            pattern="^[A-Za-z0-9À-ÿ\s#,-.]*$" 
            title="Por favor, ingrese una dirección válida. Se permiten letras, números, espacios y los caracteres #, -, , y .."
            placeholder="Ejemplo: Av. Siempre Viva 742">


        <label for="empresa_telefono">Teléfono de la Empresa:</label>
        <input type="text" id="empresa_telefono" name="empresa_telefono" 
            placeholder="+56 9 1234 1234" 
            maxlength="11" 
            required 
            pattern="^\+\d{2}\s\d{1}\s\d{4}\s\d{4}$" 
            title="Formato válido: +56 9 1234 1234 (código de país, seguido de número)"
            oninput="formatPhoneNumber(this)">


        <label for="empresa_email">Email de la Empresa:</label> <!-- Etiqueta para el campo de entrada del email de la empresa -->
        <input type="email" id="empresa_email" name="empresa_email" required> <!-- Campo de correo electrónico para ingresar el email de la empresa. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
    
        <label for="fecha_creacion">Fecha de Creacion de empresa:</label> <!-- Etiqueta para el campo de entrada de la fecha de emisión -->
        <input type="date" id="fecha_creacion" name="fecha_creacion" required> <!-- Campo de fecha para seleccionar la fecha de emisión. Es obligatorio -->
        
    </div> <!-- Cierra la caja de datos -->
</div> <!-- Cierra la fila -->
<script src="../../js/crear_empresa/formulario_empresa.js"></script> 


<<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Verifica si el nombre de la empresa está establecido
    if (isset($_POST['empresa_nombre'])) {
        
        // Depurar datos recibidos del formulario
        echo "<pre>";
        echo "Datos recibidos del formulario:\n";
        var_dump($_POST);
        echo "</pre>";

        // Obtener datos del formulario de empresa
        $rut_empresa = isset($_POST['empresa_rut']) ? trim($_POST['empresa_rut']) : null;
        $nombre_empresa = isset($_POST['empresa_nombre']) ? trim($_POST['empresa_nombre']) : null;
        $area_empresa = isset($_POST['empresa_area']) ? trim($_POST['empresa_area']) : null;
        $direccion_empresa = isset($_POST['empresa_direccion']) ? trim($_POST['empresa_direccion']) : null;
        $telefono_empresa = isset($_POST['empresa_telefono']) ? trim($_POST['empresa_telefono']) : null;
        $email_empresa = isset($_POST['empresa_email']) ? trim($_POST['empresa_email']) : null;
        $fecha_creacion = isset($_POST['fecha_creacion']) ? trim($_POST['fecha_creacion']) : null;
        $dias_validez = isset($_POST['validez_cotizacion']) ? (int)$_POST['validez_cotizacion'] : null;
        $fecha_creacion = '2024-1'
        // Validar la fecha de creación
        if ($fecha_creacion && preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_creacion)) {
            echo "Fecha de creación válida: $fecha_creacion<br>";
        } else {
            echo "Error: Fecha de creación no válida o no se recibió.<br>";
            var_dump($fecha_creacion); // Para ver qué está recibiendo realmente
            die(); // Detenemos aquí si la fecha no es válida para depuración
        }

        // Verificar que todos los campos requeridos tienen datos válidos antes de ejecutar el query
        if ($nombre_empresa && $rut_empresa && $fecha_creacion) {
            // Preparar el query SQL
            $sql_empresa = "INSERT INTO E_Empresa (id_foto, rut_empresa, nombre_empresa, area_empresa, direccion_empresa, telefono_empresa, email_empresa, fecha_creacion, dias_validez)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            // Depurar la consulta SQL y los valores
            echo "<pre>";
            echo "Consulta SQL generada:\n";
            echo $sql_empresa . "\n";
            echo "Valores:\n";
            echo "id_foto: $id_foto\n";
            echo "rut_empresa: $rut_empresa\n";
            echo "nombre_empresa: $nombre_empresa\n";
            echo "area_empresa: $area_empresa\n";
            echo "direccion_empresa: $direccion_empresa\n";
            echo "telefono_empresa: $telefono_empresa\n";
            echo "email_empresa: $email_empresa\n";
            echo "fecha_creacion: $fecha_creacion\n";
            echo "dias_validez: $dias_validez\n";
            echo "</pre>";

            $stmt_empresa = $mysqli->prepare($sql_empresa);

            if ($stmt_empresa === false) {
                die("Error en la preparación de la consulta SQL: " . $mysqli->error);
            }

            // Vincular parámetros y ejecutar
            $stmt_empresa->bind_param("issssssis", $id_foto, $rut_empresa, $nombre_empresa, $area_empresa, $direccion_empresa, $telefono_empresa, $email_empresa, $fecha_creacion, $dias_validez);
            
            if ($stmt_empresa->execute()) {
                // Obtener el ID de la empresa recién insertada
                $id_empresa = $stmt_empresa->insert_id;
                echo "Empresa insertada correctamente. ID de la empresa: " . $id_empresa . "<br>";

                // Ahora, procesar la cotización si se han proporcionado los datos
                if (isset($_POST['numero_cotizacion']) && isset($_POST['validez_cotizacion'])) {
                    $numero_cotizacion = $_POST['numero_cotizacion'];
                    $validez_cotizacion = (int)$_POST['validez_cotizacion'];

                    // Insertar la cotización
                    $sql_cotizacion = "INSERT INTO c_cotizaciones (numero_cotizacion, fecha_emision, fecha_validez, id_empresa)
                                       VALUES (?, CURDATE(), DATE_ADD(CURDATE(), INTERVAL ? DAY), ?)";
                    $stmt_cotizacion = $mysqli->prepare($sql_cotizacion);

                    if ($stmt_cotizacion === false) {
                        die("Error en la preparación del query de cotización: " . $mysqli->error);
                    }

                    $stmt_cotizacion->bind_param("sii", $numero_cotizacion, $validez_cotizacion, $id_empresa);

                    if ($stmt_cotizacion->execute()) {
                        echo "Cotización creada correctamente con el ID: " . $stmt_cotizacion->insert_id . "<br>";
                    } else {
                        die("Error al insertar la cotización: " . $stmt_cotizacion->error);
                    }
                    $stmt_cotizacion->close();
                }
            } else {
                die("Error al insertar la empresa: " . $stmt_empresa->error);
            }
            $stmt_empresa->close();
        } else {
            echo "Error: Faltan datos obligatorios. Verifica nombre de empresa, RUT y fecha de creación.<br>";
        }
    } else {
        echo "Error: No se envió el nombre de la empresa.<br>";
    }
}
?>


<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Formulario Empresa .PHP ----------------------------------------
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
