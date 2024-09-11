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
    ------------------------------------- INICIO ITred Spa Detalle total.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->



<div class="form-container">
    <div class="form-group-2">
        <label for="subTotal">Sub Total</label>
        <input type="number" id="sub_total" name="sub_total" step="1" min="0" readonly>
    </div>

    <div class="form-group-inline-2">
        <div class="form-group-2">
            <label for="descuentoGlobal">Descuento</label>
            <input type="number" id="descuento_global_porcentaje" name="descuento_global_porcentaje" step="1" min="1" max="100" value="0" oninput="calculateTotals()">
            <span>%</span>
        </div>
        <div class="form-group-2">
            <label for="monto">Monto</label>
            <input type="number" id="descuento_global_monto" name="descuento_global_monto" step="0"  readonly>
        </div>
    </div>

    <div class="form-group-2">
        <label for="montoNeto">Monto Neto</label>
        <input type="number" id="monto_neto" name="monto_neto" step="1" min="0" readonly>
    </div>

    <div class="form-group-inline-2">
        <div class="form-group-2">
            <label for="iva">IVA</label>
            <input type="number" id="iva_porcentaje" name="iva_porcentaje" step="0.01" min="0" max="100" value="19" readonly>
            <span>%</span>
        </div>
        <div class="form-group-2">
            <label for="totalIva">Total IVA</label>
            <input type="number" id="total_iva" name="total_iva" step="0.01" min="0" readonly>
        </div>
    </div>
    <div class="form-group-2">
        <label for="total_final">Total final</label>
        <input type="number" id="total_final" name="total_final" step="1" min="0" readonly>
    </div>
    
</div>






     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Detalle total.PHP ----------------------------------------
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
