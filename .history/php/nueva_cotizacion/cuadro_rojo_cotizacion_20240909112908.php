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
    ------------------------------------- INICIO ITred Spa Cuadro rojo cotizacion.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->
     <?php
// Establece la conexión a la base de datos de ITred Spa
$conn = new mysqli('localhost', 'root', '', 'ITredSpa_bd');


?>
<!-- ---------------------
     -- FIN CONEXION BD --
     --------------------- -->

<fieldset class="box-6 data-box data-box-red"> <!-- Crea una caja para ingresar datos, ocupando otras 6 columnas. Se aplica una clase adicional para estilo -->
    <legend>Detalle Cotización</legend>
    <label for="empresa_rut">RUT de la Empresa:</label> <!-- Etiqueta para el campo de entrada del RUT de la empresa -->
    <input type="text" id="empresa_rut" name="empresa_rut" 
        minlength="7" maxlength="12" 
        required oninput="formatRut(this)" 
        value="<?php echo htmlspecialchars($row['EmpresaRUT']); ?>"> <!-- Campo de texto para ingresar el RUT de la empresa. El atributo "required" hace que el campo sea obligatorio -->
    
    <label for="numero_cotizacion">Número de Cotización:</label> <!-- Etiqueta para el campo de entrada del número de cotización -->
    <input type="text" id="numero_cotizacion" name="numero_cotizacion" required pattern="\d+" value="<?php echo htmlspecialchars($numero_cotizacion); ?>"> <!-- Campo de correo electrónico para ingresar el email de la empresa. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
        <!-- Campo de texto para ingresar el número de cotización. También es obligatorio -->
    
    <label for="dias_validez">dias Validez</label> <!-- Etiqueta para el campo de entrada de la validez de la cotización -->
    <input type="number" id="dias_validez" name="dias_validez" required min="1" required placeholder="30" readonly> <!-- Campo de número para ingresar la validez de la cotización en días. El atributo "required" asegura que no se deje vacío -->
    
    
    <label for="fecha_validez">Fecha de Validez:</label>
    <input type="date" id="fecha_validez" name="fecha_validez" readonly> <!-- Campo de fecha de validez -->
    </div>
</fieldset>


<?php 

// Obtener el ID de la empresa desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

f ($id > 0) {
    // Preparar la consulta para obtener los detalles de la empresa
    $sql_empresa = "SELECT 
        e.rut_empresa AS EmpresaRUT,
        e.nombre_empresa AS EmpresaNombre,
        e.area_empresa AS EmpresaArea,
        e.direccion_empresa AS EmpresaDireccion,
        e.telefono_empresa AS EmpresaTelefono,
        e.email_empresa AS EmpresaEmail,
        f.ruta_foto
    FROM e_empresa e
    LEFT JOIN e_FotosPerfil f ON f.id_foto = e.id_foto
    WHERE e.id_empresa = ?";

    if ($stmt_empresa = $conn->prepare($sql_empresa)) {
        $stmt_empresa->bind_param("i", $id);
        $stmt_empresa->execute();
        $result_empresa = $stmt_empresa->get_result();

        if ($result_empresa->num_rows == 1) {
            $row = $result_empresa->fetch_assoc();

             // Aquí va la consulta para obtener "dias_validez"
             $sql_validez = "SELECT dias_validez FROM C_Cotizaciones WHERE id_empresa = ? ORDER BY numero_cotizacion DESC LIMIT 1";
             if ($stmt_validez = $conn->prepare($sql_validez)) {
                 $stmt_validez->bind_param("i", $id);
                 $stmt_validez->execute();
                 $stmt_validez->bind_result($dias_validez);
                 $stmt_validez->fetch();
                 $stmt_validez->close();
             } else {
                 echo "<p>Error al preparar la consulta de días de validez: " . $conn->error . "</p>";
             }
    

            // Obtener el número de cotización más alto para la empresa específica
            $sql_last_cot = "SELECT numero_cotizacion FROM C_Cotizaciones WHERE id_empresa = ? ORDER BY numero_cotizacion DESC LIMIT 1";
            if ($stmt_last_cot = $conn->prepare($sql_last_cot)) {
                $stmt_last_cot->bind_param("i", $id);
                $stmt_last_cot->execute();
                $stmt_last_cot->bind_result($last_num_cotizacion);
                $stmt_last_cot->fetch();
                $stmt_last_cot->close();

                $numero_cotizacion = ($last_num_cotizacion) ? (int)$last_num_cotizacion + 1 : 1;
            } else {
                echo "<p>Error al preparar la consulta de cotización: " . $conn->error . "</p>";
            }
        } else {
            echo "<p>No se encontró la empresa con el ID proporcionado.</p>";
        }

        $stmt_empresa->close();
    } else {
        echo "<p>Error al preparar la consulta de empresa: " . $conn->error . "</p>";
    }
} else {
    echo "<p>ID inválido.</p>";
}

?>




     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Cuadro rojo cotizacion.PHP ----------------------------------------
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
