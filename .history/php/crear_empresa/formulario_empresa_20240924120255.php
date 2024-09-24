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

        <label for="empresa_nombre">Nombre de la Empresa:</label> <!-- Etiqueta para el campo de entrada del nombre de la empresa -->
        <input type="text" id="empresa_nombre" name="empresa_nombre" required> <!-- Campo de texto para ingresar el nombre de la empresa. El atributo "required" hace que el campo sea obligatorio -->

        
        <label for="empresa_area">Área de la Empresa:</label> <!-- Etiqueta para el campo de entrada del área de la empresa -->
        <input type="text" id="empresa_area" name="empresa_area"> <!-- Campo de texto para ingresar el área de la empresa. Este campo no es obligatorio -->


        <label for="empresa_direccion">Dirección de la Empresa:</label> <!-- Etiqueta para el campo de entrada de la dirección de la empresa -->
        <input type="text" id="empresa_direccion" name="empresa_direccion"> <!-- Campo de texto para ingresar la dirección de la empresa. Este campo no es obligatorio -->


        <label for="empresa_telefono">Teléfono de la Empresa:</label> <!-- Etiqueta para el campo de entrada del teléfono de la empresa -->
        <input type="text" id="empresa_telefono" name="empresa_telefono" pattern="\+?\d{7,15}" placeholder="+1234567890"> <!-- Campo de texto para ingresar el teléfono de la empresa. Este campo no es obligatorio -->


        <label for="empresa_email">Email de la Empresa:</label> <!-- Etiqueta para el campo de entrada del email de la empresa -->
        <input type="email" id="empresa_email" name="empresa_email"> <!-- Campo de correo electrónico para ingresar el email de la empresa. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
    
        
    </div> <!-- Cierra la caja de datos -->
</div> <!-- Cierra la fila -->
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
      // Conversión de fecha
$fecha_creacion_formateada = DateTime::createFromFormat('d-m-Y', $fecha_creacion)->format('Y-m-d');

        // Insertar empresa en la base de datos
        $sql_empresa = "INSERT INTO E_Empresa (id_foto,rut_empresa, nombre_empresa, area_empresa, direccion_empresa, telefono_empresa, email_empresa, fecha_creacion, dias_validez)
                        VALUES (?,?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_empresa = $mysqli->prepare($sql_empresa);
        $stmt_empresa->bind_param("issssssis",$id_foto, $rut_empresa, $nombre_empresa, $area_empresa, $direccion_empresa, $telefono_empresa, $email_empresa, $fecha_creacion, $dias_validez);

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
