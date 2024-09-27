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




    <h2 style="text-align: center;">TRANSFERENCIAS A:</h2> <!-- Título para la sección de transferencias bancarias -->
<table style="margin: 0 auto; border-collapse: collapse;"> <!-- Crea una tabla para mostrar la información bancaria para transferencias -->
    <tr>
        <?php if (!empty($bancos)): ?>
            <?php foreach ($bancos as $banco): ?>
                <th style="text-align: center; border: 1px solid #ddd; padding: 8px;">
                    <?php echo htmlspecialchars($banco['TipoCuentaDescripcion']); ?>
                </th>
            <?php endforeach; ?>
        <?php else: ?>
            <th colspan="3" style="text-align: center; border: 1px solid #ddd; padding: 8px;">No hay información bancaria disponible.</th>
        <?php endif; ?>
    </tr>
    <?php if (!empty($bancos)): ?>
        <tr>
            <?php foreach ($bancos as $banco): ?>
                <td style="text-align: center; border: 1px solid #ddd; padding: 8px;">
                    BANCO: <?php echo htmlspecialchars($banco['BancoNombre']); ?>
                </td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php foreach ($bancos as $banco): ?>
                <td style="text-align: center; border: 1px solid #ddd; padding: 8px;">
                    TIPO CUENTA: <?php echo htmlspecialchars($banco['TipoCuentaDescripcion']); ?>
                </td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php foreach ($bancos as $banco): ?>
                <td style="text-align: center; border: 1px solid #ddd; padding: 8px;">
                    NUMERO CUENTA: <?php echo htmlspecialchars($banco['CuentaNumeroCuenta']); ?>
                </td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php foreach ($bancos as $banco): ?>
                <td style="text-align: center; border: 1px solid #ddd; padding: 8px;">
                    NOMBRE: <?php echo htmlspecialchars($banco['CuentaNombreTitular']); ?>
                </td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php foreach ($bancos as $banco): ?>
                <td style="text-align: center; border: 1px solid #ddd; padding: 8px;">
                    RUT: <?php echo htmlspecialchars($banco['CuentaRutTitular']); ?>
                </td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php foreach ($bancos as $banco): ?>
                <td style="text-align: center; border: 1px solid #ddd; padding: 8px;">
                    E-MAIL: <?php echo htmlspecialchars($banco['CuentaEmailBanco']); ?>
                </td>
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
