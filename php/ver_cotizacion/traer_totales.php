
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
    ------------------------------------- INICIO ITred Spa Traer proyecto .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<?php

if (isset($_GET['id']) && intval($_GET['id']) > 0) {
    $id_cotizacion = intval($_GET['id']);
    // Consulta para obtener los totales de la cotización
    $sql_totales = "SELECT sub_total, descuento_global, monto_neto, iva_valor, total_iva, total_final 
                    FROM C_Totales 
                    WHERE id_cotizacion = ?";
    
    $stmt = $mysqli->prepare($sql_totales);
    $stmt->bind_param("i", $id_cotizacion);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $totales = $result->fetch_assoc();
        
        // Asigna los valores para usarlos en el formulario
        $sub_total = $totales['sub_total'];
        $descuento_global = $totales['descuento_global'];
        $monto_neto = $totales['monto_neto'];
        $iva_valor = $totales['iva_valor'];
        $total_iva = $totales['total_iva'];
        $total_final = $totales['total_final'];
    } else {
        echo "Error al obtener los totales: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID de cotización no válido.";
}
?>
<link rel="stylesheet" href="../../css/ver_cotizacion/traer_totales.css">
<div class="form-contenedor">
    <!-- TÍTULO: SUBTOTAL -->
    <div class="form-group-2">
        <label for="subTotal">Sub Total</label>
        <input type="number" id="sub_total" name="sub_total" step="1" min="0" value="<?php echo $sub_total; ?>" readonly>
    </div>

    <!-- TÍTULO: DESCUENTO Y MONTO -->
    <div class="form-group-inline-2">
        <!-- TÍTULO: DESCUENTO GLOBAL -->
        <div class="form-group-2">
            <label for="descuentoGlobal">Descuento</label>
            <input type="number" id="descuento_global_porcentaje" name="descuento_global_porcentaje" step="1" min="1" max="100" value="<?php echo $descuento_global; ?>" oninput="calculateTotals()">
            <span>%</span>
        </div>
        <!-- TÍTULO: MONTO DEL DESCUENTO -->
        <div class="form-group-2">
            <label for="monto">Monto</label>
            <input type="number" id="descuento_global_monto" name="descuento_global_monto" step="0" value="<?php echo ($sub_total * $descuento_global / 100); ?>" readonly>
        </div>
    </div>

    <!-- TÍTULO: MONTO NETO -->
    <div class="form-group-2">
        <label for="montoNeto">Monto Neto</label>
        <input type="number" id="monto_neto" name="monto_neto" step="1" min="0" value="<?php echo $monto_neto; ?>" readonly>
    </div>

    <!-- TÍTULO: IVA Y TOTAL IVA -->
    <div class="form-group-inline-2">
        <!-- TÍTULO: IVA PORCENTAJE -->
        <div class="form-group-2">
            <label for="iva">IVA</label>
            <input type="number" id="iva_porcentaje" name="iva_porcentaje" step="0.01" min="0" max="100" value="<?php echo $iva_valor; ?>" readonly>
            <span>%</span>
        </div>
        <!-- TÍTULO: TOTAL IVA -->
        <div class="form-group-2">
            <label for="totalIva">Total IVA</label>
            <input type="number" id="total_iva" name="total_iva" step="0.01" min="0" value="<?php echo $total_iva; ?>" readonly>
        </div>
    </div>
    
    <!-- TÍTULO: TOTAL FINAL -->
    <div class="form-group-2">
        <label for="total_final">Total final</label>
        <input type="number" id="total_final" name="total_final" step="1" min="0" value="<?php echo $total_final; ?>" readonly>
    </div>

    <div class="form-group-2">
        <!-- Espacio para elementos adicionales si es necesario -->
    </div>
</div>

<script src="../../js/nueva_cotizacion/detalle_total.js"></script>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sub_total = isset($_POST['sub_total']) ? floatval($_POST['sub_total']) : 0;
    $descuento_global = isset($_POST['descuento_global_porcentaje']) ? floatval($_POST['descuento_global_porcentaje']) : 0;
    $monto_neto = isset($_POST['monto_neto']) ? floatval($_POST['monto_neto']) : 0;
    $iva_valor = isset($_POST['iva_porcentaje']) ? floatval($_POST['iva_porcentaje']) : 0;
    $total_iva = isset($_POST['total_iva']) ? floatval($_POST['total_iva']) : 0;
    $total_final = isset($_POST['total_final']) ? floatval($_POST['total_final']) : 0;

    if ($id_cotizacion > 0) {
        // Inserta o actualiza los totales
        $sql_insert_totales = "INSERT INTO C_Totales (id_cotizacion, sub_total, descuento_global, monto_neto, iva_valor, total_iva, total_final) 
                               VALUES (?, ?, ?, ?, ?, ?, ?)
                               ON DUPLICATE KEY UPDATE 
                               sub_total = VALUES(sub_total), 
                               descuento_global = VALUES(descuento_global), 
                               monto_neto = VALUES(monto_neto),
                               iva_valor = VALUES(iva_valor), 
                               total_iva = VALUES(total_iva), 
                               total_final = VALUES(total_final)";
        
        $stmt = $mysqli->prepare($sql_insert_totales);

        if ($stmt === false) {
            die("Error al preparar la consulta: " . $mysqli->error);
        }

        $stmt->bind_param("idididd", 
            $id_cotizacion, 
            $sub_total, 
            $descuento_global, 
            $monto_neto, 
            $iva_valor, 
            $total_iva, 
            $total_final
        );

        if ($stmt->execute()) {
            $id_total = $stmt->insert_id; // Obtener el ID del total recién insertado
            echo "Totales insertados/actualizados correctamente. ID: $id_total<br>";
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: ID de cotización no válido.";
    }
}
?>