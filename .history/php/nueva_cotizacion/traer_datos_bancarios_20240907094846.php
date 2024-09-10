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
    ------------------------------------- INICIO ITred Spa Traer datos bancarios.PHP --------------------------------------
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


<h2>TRANSFERENCIAS A:</h2> <!-- Título para la sección de transferencias bancarias -->
<table> <!-- Crea una tabla para mostrar la información bancaria para transferencias -->
<tr>
    <?php if (!empty($bancos)): ?>
        <?php foreach ($bancos as $banco): ?>
            <th><?php echo htmlspecialchars($banco['TipoCuentaDescripcion']); ?></th>
        <?php endforeach; ?>
    <?php else: ?>
        <th colspan="3">No hay información bancaria disponible.</th>
    <?php endif; ?>
</tr>
<?php if (!empty($bancos)): ?>
    <tr>
        <?php foreach ($bancos as $banco): ?>
            <td>BANCO: <?php echo htmlspecialchars($banco['BancoNombre']); ?></td>
        <?php endforeach; ?>
    </tr>
    <tr>
        <?php foreach ($bancos as $banco): ?>
            <td>TIPO CUENTA: <?php echo htmlspecialchars($banco['TipoCuentaDescripcion']); ?></td>
        <?php endforeach; ?>
    </tr>
    <tr>
        <?php foreach ($bancos as $banco): ?>
            <td>NUMERO CUENTA: <?php echo htmlspecialchars($banco['CuentaNumeroCuenta']); ?></td>
        <?php endforeach; ?>
    </tr>
    <tr>
        <?php foreach ($bancos as $banco): ?>
            <td>NOMBRE: <?php echo htmlspecialchars($banco['CuentaNombreTitular']); ?></td>
        <?php endforeach; ?>
    </tr>
    <tr>
        <?php foreach ($bancos as $banco): ?>
            <td>RUT: <?php echo htmlspecialchars($banco['CuentaRutTitular']); ?></td>
        <?php endforeach; ?>
    </tr>
    <tr>
        <?php foreach ($bancos as $banco): ?>
            <td>E-MAIL: <?php echo htmlspecialchars($banco['CuentaEmailBanco']); ?></td>
        <?php endforeach; ?>
    </tr>
<?php endif; ?>
</table>

     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Traer datos bancarios.PHP ----------------------------------------
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
