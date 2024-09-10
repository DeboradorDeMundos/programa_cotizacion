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
    ------------------------------------- INICIO ITred Spa Adelanto.PHP --------------------------------------
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

<fieldset>
    <legend>Adelanto</legend>
    <table class="detalle-table">
        <thead>
            <tr>
                <th>DESCRIPCIÓN</th>
                <th>Porcentaje Adelanto: %</th>
                <th>Monto adelanto</th>
                <th>Fecha adelanto</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="checkbox" onclick="toggleDescription(this)"></td>
                <td><input type="number" id="porcentaje_adelanto" name="porcentaje_adelanto" min="0" max="100" required oninput="calculateAdelanto()"></td>
                <td><input type="number" id="monto_adelanto" name="monto_adelanto" min="0" required readonly></td>
                <td><input type="date" id="fecha_adelanto" name="fecha_adelanto" required></td>
            </tr>
            <tr class="descripcion-row" style="display: none;">
                <td colspan="4">
                    <textarea name="adelanto_descripcion"  id="adelanto_descripcion" placeholder="Ingrese detalles adicionales sobre las condiciones generales"></textarea>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>


<!-- ---------------------
-- INICIO CIERRE CONEXION BD --
     --------------------- -->
     <php?
     $mysqli->close();
?>
<!-- ---------------------
     -- FIN CIERRE CONEXION BD --
     --------------------- -->



     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Adelanto.PHP ----------------------------------------
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
