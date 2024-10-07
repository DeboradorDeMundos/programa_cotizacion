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
    ------------------------------------- INICIO ITred Spa Cuadro rojo cotizacion.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
<?php

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Preparar la consulta para obtener los detalles de la empresa
    $sql_empresa = "SELECT 
        e.rut_empresa AS EmpresaRUT,
        e.nombre_empresa AS EmpresaNombre,
        e.area_empresa AS EmpresaArea,
        e.direccion_empresa AS EmpresaDireccion,
        e.telefono_empresa AS EmpresaTelefono,
        e.email_empresa AS EmpresaEmail,
        f.ruta_foto,
        e.id_tipo_firma AS tipo_firma
    FROM e_empresa e
    LEFT JOIN e_FotosPerfil f ON f.id_foto = e.id_foto
    WHERE e.id_empresa = ?";

    if ($stmt_empresa = $mysqli->prepare($sql_empresa)) {
        $stmt_empresa->bind_param("i", $id);
        $stmt_empresa->execute();
        $result_empresa = $stmt_empresa->get_result();

        if ($result_empresa->num_rows == 1) {
            $row = $result_empresa->fetch_assoc();
            // Aquí va lo que quieres que haga si $row no es null
            // Por ejemplo, mostrar datos:
            $tipo_firma = $row['tipo_firma'];

            // Consulta para obtener la firma de la empresa
            $sql_firma = "
            SELECT 
                f.id_firma,
                f.id_empresa,
                f.titulo_firma, 
                f.nombre_encargado_firma, 
                f.cargo_encargado_firma, 
                f.telefono_encargado_firma,
                f.nombre_empresa_firma, 
                f.area_empresa_firma,
                f.telefono_empresa_firma, 
                f.firma_digital,
                f.email_firma, 
                f.direccion_firma, 
                f.ciudad_firma,
                f.pais_firma,
                f.rut_firma,
                f.web_firma
            FROM E_Firmas f
            WHERE f.id_empresa = ?";

            if ($stmt_firma = $mysqli->prepare($sql_firma)) {
                $stmt_firma->bind_param("i", $id);
                $stmt_firma->execute();
                $result_firma = $stmt_firma->get_result();

                if ($result_firma->num_rows == 1) {
                    $firma = $result_firma->fetch_assoc();
                } else {
                    $firma = null; // No hay firma manual
                }

                $stmt_firma->close();
            } else {
                echo "<p>Error al preparar la consulta de la firma: " . $mysqli->error . "</p>";
            }
            // Consulta para obtener los días de validez
            $sql_validez = "SELECT dias_validez FROM E_Empresa WHERE id_empresa = ? ";
            if ($stmt_validez = $mysqli->prepare($sql_validez)) {
                $stmt_validez->bind_param("i", $id);
                $stmt_validez->execute();
                $stmt_validez->bind_result($dias_validez);
                $stmt_validez->fetch();
                $stmt_validez->close();
            } else {
                echo "<p>Error al preparar la consulta de días de validez: " . $mysqli->error . "</p>";
            }

            // Obtener el número de cotización más alto
            $sql_last_cot = "SELECT numero_cotizacion FROM C_Cotizaciones WHERE id_empresa = ? ORDER BY numero_cotizacion DESC LIMIT 1";
            if ($stmt_last_cot = $mysqli->prepare($sql_last_cot)) {
                $stmt_last_cot->bind_param("i", $id);
                $stmt_last_cot->execute();
                $stmt_last_cot->bind_result($last_num_cotizacion);
                $stmt_last_cot->fetch();
                $stmt_last_cot->close();
                $numero_cotizacion = ($last_num_cotizacion) ? (int)$last_num_cotizacion + 1 : 1;
            } else {
                echo "<p>Error al preparar la consulta de cotización: " . $mysqli->error . "</p>";
            }
        } else {
            echo "<p>No se encontró la empresa con el ID proporcionado.</p>";
        }
    }
}
?>
     
<body onload="calcularFechaValidez();">
<link rel="stylesheet" href="../../css/nueva_cotizacion/cuadro_rojo_cotizacion.css">
<fieldset class="box-6 data-box data-box-red"> <!-- Crea una caja para ingresar datos, ocupando otras 6 columnas. Se aplica una clase adicional para estilo -->
    <legend>Detalle Cotización</legend>
    <label for="empresa_rut">RUT de la Empresa:</label> <!-- Etiqueta para el campo de entrada del RUT de la empresa -->
    <input type="text" id="empresa_rut" name="empresa_rut" 
        minlength="7" maxlength="12" 
        required oninput="FormatearRut(this)" 
        value="<?php echo htmlspecialchars($row['EmpresaRUT']); ?>"> <!-- Campo de texto para ingresar el RUT de la empresa. El atributo "required" hace que el campo sea obligatorio -->
    
    <label for="numero_cotizacion">Número de Cotización:</label> <!-- Etiqueta para el campo de entrada del número de cotización -->
    <input type="number" id="numero-cotizacion" name="numero_cotizacion" required min="1" required placeholder="30" value="<?php echo htmlspecialchars($numero_cotizacion); ?>"> <!-- Campo de correo electrónico para ingresar el email de la empresa. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
        <!-- Campo de texto para ingresar el número de cotización. También es obligatorio -->
    
    <label for="dias_validez">dias Validez</label> <!-- Etiqueta para el campo de entrada de la validez de la cotización -->
    <input type="number" id="dias_validez" name="dias_validez" required min="1" required placeholder="30" value="<?php echo htmlspecialchars($dias_validez); ?>" readonly>
    
    <label for="fecha_validez">Fecha de Validez:</label>
    <input type="date" id="fecha_validez" name="fecha_validez" readonly>
</fieldset>   
</body>

<script src="../../js/nueva_cotizacion/cuadro_rojo_cotizacion.js"></script> <!-- Enlaza nuevamente el archivo JavaScript para manejar la lógica del formulario de cotización -->


<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Cuadro rojo cotizacion.PHP ----------------------------------------
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
