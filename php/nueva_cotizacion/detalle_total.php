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
    ------------------------------------- INICIO ITred Spa Detalle total.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->


<link rel="stylesheet" href="../../css/nueva_cotizacion/detalle_total.css">
<div class="form-contenedor">
    <div class="form-group-2">
        <!-- TÍTULO: CAMPO PARA SUB TOTAL -->
        <label for="subTotal">Sub Total</label>
        <!-- TÍTULO: CAMPO PARA MOSTRAR EL SUB TOTAL -->
        <input type="number" id="sub_total" name="sub_total" step="1" min="0" readonly>
    </div>

    <div class="form-group-inline-2">
        <div class="form-group-2">
            <!-- TÍTULO: CAMPO PARA DESCUENTO GLOBAL -->
            <label for="descuentoGlobal">Descuento</label>
            <!-- TÍTULO: CAMPO PARA INGRESAR EL DESCUENTO GLOBAL EN PORCENTAJE -->
            <input type="number" id="descuento_global_porcentaje" name="descuento_global_porcentaje" oninput="CalcularTotales()" oninput="QuitarCaracteresInvalidos(this)" step="1" min="0" max="100" value="0">
            <span>%</span>
        </div>
        <div class="form-group-2">
            <!-- TÍTULO: CAMPO PARA MONTO DEL DESCUENTO GLOBAL -->
            <label for="monto">Monto</label>
            <!-- TÍTULO: CAMPO PARA MOSTRAR EL MONTO DEL DESCUENTO GLOBAL -->
            <input type="number" id="descuento_global_monto" name="descuento_global_monto" step="0" readonly>
        </div>
    </div>

    <div class="form-group-2">
        <!-- TÍTULO: CAMPO PARA MONTO NETO -->
        <label for="montoNeto">Monto Neto</label>
        <!-- TÍTULO: CAMPO PARA MOSTRAR EL MONTO NETO -->
        <input type="number" id="monto_neto" name="monto_neto" step="1" min="0" readonly>
    </div>

    <div class="form-group-inline-2">
        <div class="form-group-2">
            <!-- TÍTULO: CAMPO PARA IVA -->
            <label for="iva">IVA</label>
            <!-- TÍTULO: CAMPO PARA MOSTRAR EL IVA EN PORCENTAJE -->
            <input type="number" id="iva_porcentaje" name="iva_porcentaje" step="0" min="0" max="100" value="19" readonly>
            <span>%</span>
        </div>
        <div class="form-group-2">
            <!-- TÍTULO: CAMPO PARA TOTAL IVA -->
            <label for="totalIva">Total IVA</label>
            <!-- TÍTULO: CAMPO PARA MOSTRAR EL TOTAL DE IVA -->
            <input type="number" id="total_iva" name="total_iva" step="0" min="0" readonly>
        </div>
    </div>

    <div class="form-group-2">
        <!-- TÍTULO: CAMPO PARA TOTAL FINAL -->
        <label for="total_final">Total final</label>
        <!-- TÍTULO: CAMPO PARA MOSTRAR EL TOTAL FINAL -->
        <input type="number" id="total_final" name="total_final" step="1" min="0" readonly>
    </div>

    <label>Son:</label> 
    <!-- TÍTULO: INCLUSIÓN DEL ARCHIVO NUMERO_TEXT.PHP -->
    <?php include 'numero_text.php'; ?>
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
    $total_en_texto = isset($_POST['total-en-texto']) ? $_POST['total-en-texto'] : 'fallo';
    
    // Verifica si el valor se recibió correctamente
    echo "Total en texto recibido: " . htmlspecialchars($total_en_texto);

    
    // Verificación básica para asegurar que se ha proporcionado un ID de cotización válido
    if ($id_cotizacion > 0) {
        // Inserta o actualiza los totales
        $sql_insert_totales = "INSERT INTO C_Totales (id_cotizacion, sub_total, descuento_global, monto_neto, iva_valor, total_iva, total_final, total_final_letras) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                               ON DUPLICATE KEY UPDATE 
                               sub_total = VALUES(sub_total), 
                               descuento_global = VALUES(descuento_global), 
                               monto_neto = VALUES(monto_neto),
                               iva_valor = VALUES(iva_valor), 
                               total_iva = VALUES(total_iva), 
                               total_final = VALUES(total_final),
                               total_final_letras = VALUES(total_final_letras)";

        $stmt = $mysqli->prepare($sql_insert_totales);

        if ($stmt === false) {
            die("Error al preparar la consulta: " . $mysqli->error);
        }

        $stmt->bind_param("idididds", 
            $id_cotizacion, 
            $sub_total, 
            $descuento_global, 
            $monto_neto, 
            $iva_valor, 
            $total_iva, 
            $total_final,
            $total_en_texto
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



     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Detalle total.PHP ----------------------------------------
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
