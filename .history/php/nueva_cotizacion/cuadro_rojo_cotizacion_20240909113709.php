<!-- Sitio Web Creado por ITred Spa. -->

<!-- ------------------------------------------------------------------------------------------------------------
    ------------------------------------- INICIO ITred Spa Cuadro rojo cotizacion.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- INICIO CONEXION BD -->
<?php
$conn = new mysqli('localhost', 'root', '', 'ITredSpa_bd');

// Verificar si hay errores en la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID de la empresa desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Obtener detalles de la empresa
    $sql_empresa = "SELECT e.rut_empresa AS EmpresaRUT
                    FROM e_empresa e
                    WHERE e.id_empresa = ?";
    $stmt_empresa = $conn->prepare($sql_empresa);
    $stmt_empresa->bind_param("i", $id);
    $stmt_empresa->execute();
    $result_empresa = $stmt_empresa->get_result();

    if ($result_empresa->num_rows == 1) {
        $row = $result_empresa->fetch_assoc();

        // Obtener "dias_validez"
        $sql_validez = "SELECT dias_validez 
                        FROM C_Cotizaciones 
                        WHERE id_empresa = ? 
                        ORDER BY numero_cotizacion DESC 
                        LIMIT 1";
        $stmt_validez = $conn->prepare($sql_validez);
        $stmt_validez->bind_param("i", $id);
        $stmt_validez->execute();
        $stmt_validez->bind_result($dias_validez);
        $stmt_validez->fetch();
        $stmt_validez->close();

        // Obtener el número de cotización más alto
        $sql_last_cot = "SELECT numero_cotizacion 
                         FROM C_Cotizaciones 
                         WHERE id_empresa = ? 
                         ORDER BY numero_cotizacion DESC 
                         LIMIT 1";
        $stmt_last_cot = $conn->prepare($sql_last_cot);
        $stmt_last_cot->bind_param("i", $id);
        $stmt_last_cot->execute();
        $stmt_last_cot->bind_result($last_num_cotizacion);
        $stmt_last_cot->fetch();
        $stmt_last_cot->close();

        $numero_cotizacion = ($last_num_cotizacion) ? (int)$last_num_cotizacion + 1 : 1;
    } else {
        echo "<p>No se encontró la empresa con el ID proporcionado.</p>";
        $row = [];  // Evitar errores si la empresa no es encontrada
        $dias_validez = '';
        $numero_cotizacion = '';
    }

    $stmt_empresa->close();
} else {
    echo "<p>ID inválido.</p>";
    $row = [];
    $dias_validez = '';
    $numero_cotizacion = '';
}

$conn->close();
?>
<!-- FIN CONEXION BD -->

<!-- Formulario HTML -->
<fieldset class="box-6 data-box data-box-red">
    <legend>Detalle Cotización</legend>
    <label for="empresa_rut">RUT de la Empresa:</label>
    <input type="text" id="empresa_rut" name="empresa_rut" 
           minlength="7" maxlength="12" required 
           oninput="formatRut(this)" 
           value="<?php echo htmlspecialchars($row['EmpresaRUT'] ?? ''); ?>">

    <label for="numero_cotizacion">Número de Cotización:</label>
    <input type="text" id="numero_cotizacion" name="numero_cotizacion" 
           required pattern="\d+" 
           value="<?php echo htmlspecialchars($numero_cotizacion); ?>">

    <label for="dias_validez">Días de Validez:</label>
    <input type="number" id="dias_validez" name="dias_validez" 
           required min="1" placeholder="30" 
           value="<?php echo htmlspecialchars($dias_validez); ?>" readonly>

    <label for="fecha_validez">Fecha de Validez:</label>
    <input type="date" id="fecha_validez" name="fecha_validez" readonly>
</fieldset>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Cuadro rojo cotizacion.PHP ----------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- Sitio Web Creado por ITred Spa. -->
