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


        <label for="empresa_email">Email de la Empresa:</label>
        <input type="email" id="empresa_email" name="empresa_email" 
            placeholder="ejemplo@empresa.com" 
            maxlength="255" 
            required 
            title="Ingresa un correo electrónico válido, como ejemplo@empresa.com" 
            onblur="completeEmail(this)">

        
    </div> <!-- Cierra la caja de datos -->
</div> <!-- Cierra la fila -->
<script src="../../js/crear_empresa/formulario_empresa.js"></script> 
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Primero, procesar el formulario de empresa
    if (isset($_POST['empresa_nombre'])) {
        // Obtener datos del formulario de empresa
        $rut_empresa = $_POST['empresa_rut'];
        $nombre_empresa = $_POST['empresa_nombre'];
        $area_empresa = $_POST['empresa_area'];
        $direccion_empresa = $_POST['empresa_direccion'];
        $telefono_empresa = $_POST['empresa_telefono'];
        $email_empresa = $_POST['empresa_email'];
        $fecha_creacion = $_POST['fecha_creacion'];
        $dias_validez = $_POST['validez_cotizacion'];

        // Insertar empresa en la base de datos
        $sql_empresa = "INSERT INTO E_Empresa (rut_empresa, nombre_empresa, area_empresa, direccion_empresa, telefono_empresa, email_empresa, fecha_creacion, dias_validez)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_empresa = $mysqli->prepare($sql_empresa);
        $stmt_empresa->bind_param("ssssssis", $rut_empresa, $nombre_empresa, $area_empresa, $direccion_empresa, $telefono_empresa, $email_empresa, $fecha_creacion, $dias_validez);

        if ($stmt_empresa->execute()) {
            // Obtener el ID de la empresa recién insertada
            $id_empresa = $stmt_empresa->insert_id;
            echo "Empresa insertada correctamente. ID de la empresa: " . $id_empresa . "<br>";

            // Ahora, procesar la cotización si se han proporcionado los datos
            if (isset($_POST['numero_cotizacion']) && isset($_POST['validez_cotizacion'])) {
                $numero_cotizacion = $_POST['numero_cotizacion'];
                $validez_cotizacion = $_POST['validez_cotizacion'];

                // Insertar la cotización
                $sql_cotizacion = "INSERT INTO c_cotizaciones (numero_cotizacion, fecha_emision, fecha_validez, id_empresa)
                                   VALUES (?, CURDATE(), DATE_ADD(CURDATE(), INTERVAL ? DAY), ?)";
                $stmt_cotizacion = $mysqli->prepare($sql_cotizacion);
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
