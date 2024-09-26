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
        <input type="email" id="empresa_email" name="empresa_email"
            placeholder="ejemplo@empresa.com" 
            maxlength="255" 
            required 
            title="Ingresa un correo electrónico válido, como ejemplo@empresa.com" 
            onblur="completeEmail(this)"> <!-- Campo de correo electrónico para ingresar el email de la empresa. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
    
        <label for="fecha_creacion">Fecha de Creacion de empresa:</label> <!-- Etiqueta para el campo de entrada de la fecha de emisión -->
        <input type="date" id="fecha_creacion" name="fecha_creacion" required> <!-- Campo de fecha para seleccionar la fecha de emisión. Es obligatorio -->
        
    </div> <!-- Cierra la caja de datos -->
</div> <!-- Cierra la fila -->
<script src="../../js/crear_empresa/formulario_empresa.js"></script> 


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mensaje = ""; // Inicializa el mensaje

    // Obtener el tipo de firma seleccionado
    $tipo_firma = isset($_POST['signature-option']) ? $_POST['signature-option'] : null;

    if (isset($_POST['empresa_nombre'])) {
        // Obtener datos del formulario de empresa
        $rut_empresa = isset($_POST['empresa_rut']) ? trim($_POST['empresa_rut']) : null;
        $nombre_empresa = isset($_POST['empresa_nombre']) ? trim($_POST['empresa_nombre']) : null;
        $area_empresa = isset($_POST['empresa_area']) ? trim($_POST['empresa_area']) : null;
        $direccion_empresa = isset($_POST['empresa_direccion']) ? trim($_POST['empresa_direccion']) : null;
        $telefono_empresa = isset($_POST['empresa_telefono']) ? trim($_POST['empresa_telefono']) : null;
        $email_empresa = isset($_POST['empresa_email']) ? trim($_POST['empresa_email']) : null;
        $fecha_creacion = isset($_POST['fecha_creacion']) ? trim($_POST['fecha_creacion']) : null;
        $dias_validez = isset($_POST['validez_cotizacion']) ? (int)$_POST['validez_cotizacion'] : null;

        // Obtener el id del tipo de firma basado en la opción seleccionada
        $id_tipo_firma = null;
        switch ($tipo_firma) {
            case 'automatic':
                $id_tipo_firma = 1; // Asigna el ID correspondiente a la firma automática
                break;
            case 'manual':
                $id_tipo_firma = 2; // Asigna el ID correspondiente a la firma manual
                break;
            case 'image':
                $id_tipo_firma = 3; // Asigna el ID correspondiente a la firma por imagen
                break;
            case 'digital':
                $id_tipo_firma = 4; // Asigna el ID correspondiente a la firma digital
                break;
            default:
                $mensaje = "Por favor seleccione un tipo de firma.";
                break;
        }

        // Verificar que la fecha está bien formada antes de intentar insertarla
        if ($fecha_creacion && preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_creacion)) {
            // Inserta la empresa incluyendo el id del tipo de firma
            $sql_empresa = "INSERT INTO E_Empresa (id_foto, rut_empresa, nombre_empresa, area_empresa, direccion_empresa, telefono_empresa, email_empresa, fecha_creacion, dias_validez, id_tipo_firma)
                            VALUES ($id_foto, '$rut_empresa', '$nombre_empresa', '$area_empresa', '$direccion_empresa', '$telefono_empresa', '$email_empresa', '$fecha_creacion', $dias_validez, $id_tipo_firma)";
            
            if ($mysqli->query($sql_empresa) === TRUE) {
                // Obtener el ID de la empresa recién insertada
                $id_empresa = $mysqli->insert_id;

                // Ahora, procesar la cotización si se han proporcionado los datos
                if (isset($_POST['numero_cotizacion']) && isset($_POST['validez_cotizacion'])) {
                    $numero_cotizacion = $_POST['numero_cotizacion'];
                    $validez_cotizacion = (int)$_POST['validez_cotizacion'];

                    // Insertar la cotización
                    $sql_cotizacion = "INSERT INTO c_cotizaciones (numero_cotizacion, fecha_emision, fecha_validez, id_empresa)
                                       VALUES ('$numero_cotizacion', CURDATE(), DATE_ADD(CURDATE(), INTERVAL $validez_cotizacion DAY), $id_empresa)";
                    
                    if ($mysqli->query($sql_cotizacion) === TRUE) {
                        $mensaje = "Empresa creada correctamente, se redirije al home.";
                    } else {
                        $mensaje = "Error al insertar la cotización: " . $mysqli->error;
                    }
                } else {
                    $mensaje = "Empresa creada correctamente, pero no se proporcionó la cotización.";
                }
            } else {
                $mensaje = "Error al insertar la empresa: " . $mysqli->error;
            }
        } else {
            $mensaje = "Error: Fecha de creación no válida o no se recibió correctamente.";
        }
    } else {
        $mensaje = "Error: No se envió el nombre de la empresa.";
    }

    // Mostrar el mensaje y redirigir
    echo "<script>
            alert('$mensaje');
            window.location.href='../../programa_cotizacion.php';
          </script>";
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
