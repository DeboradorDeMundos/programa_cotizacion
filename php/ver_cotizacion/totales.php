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
    ------------------------------------- INICIO ITred Spa totales .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

     <?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');
?>

<div class="totals-container">
<table class="observations">
    <tr>
        <td>
            <strong>OBSERVACIONES</strong>
        </td>
    </tr>
    <tr class="large-cell">
        <td>
            <?php
            // Verificar si hay observaciones
            if (!empty($observaciones)) {
                foreach ($observaciones as $observacion) {
                    echo htmlspecialchars($observacion['observacion']) . "<br>"; // Mostrar cada observación
                }
            } else {
                echo "Sin observaciones extras."; // Mensaje por defecto si no hay observaciones
            }
            ?>
        </td>
    </tr>
</table>

<table class="totals">
    
        <tr>
            <td>Sub-total</td>
            <td>$ <?php echo number_format($totales['sub_total'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td>Monto descuento_porcentaje</td>
            <td>$ <?php echo number_format($totales['descuento_global'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td>19% I.V.A.</td>
            <td>$ <?php echo number_format($totales['total_iva'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td>Monto neto</td>
            <td>$ <?php echo number_format($totales['monto_neto'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
        <td>TOTAL</td>
            <td>$ <?php echo number_format($totales['total_final'], 0, ',', '.'); ?></td>
        </tr>

    </table>
</div>


<script src="../../js/ver_cotizacion/totales.js"></script> 
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa  totales .PHP -----------------------------------
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
