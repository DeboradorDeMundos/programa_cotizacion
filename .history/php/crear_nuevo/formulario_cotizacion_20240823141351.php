<fieldset>
    <legend>Detalle de la Cotización</legend>
    <div id="detalle-container">
        <!-- Sección de Títulos -->
        <div class="detalle-section">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="detalle_titulo[]" required>
            <button type="button" onclick="addDetailRow(this)">Agregar detalles</button>
            <button type="button" onclick="addDetailSection()">Agregar un nuevo título</button>
            <table class="detalle-table">
                <thead>
                    <tr>
                        <th>CANTIDAD</th>
                        <th>DESCRIPCIÓN</th>
                        <th>PRECIO UNI.</th>
                        <th>TOTAL</th>
                        <th>ACCION</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"><strong>Subtotal de la Sección:</strong></td>
                        <td><input type="number" name="subtotal_seccion[]" step="0.01" min="0" readonly></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- Sección para los cálculos finales -->
    <div id="calculos-finales">
        <fieldset>
            <legend>Cálculos Finales</legend>
            <table class="detalle-table">
                <thead>
                    <tr>
                        <th>NETO</th>
                        <th>IVA 19%</th>
                        <th>TOTAL</th>
                        <th>DESCUENTO</th>
                        <th>TOTAL CON DESCUENTO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="number" name="detalle_neto[]" step="0.01" min="0" readonly></td>
                        <td><input type="number" name="detalle_iva[]" step="0.01" min="0" readonly></td>
                        <td><input type="number" name="detalle_total[]" step="0.01" min="0" readonly></td>
                        <td><input type="number" name="detalle_descuento[]" step="0.01" min="0" value="0"></td>
                        <td><input type="number" name="detalle_total_con_descuento[]" step="0.01" min="0" value="0"></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </div>
</fieldset>
