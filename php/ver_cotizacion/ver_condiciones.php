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
    ------------------------------------- INICIO ITred Ver condiciones .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
<?php if (!empty($condiciones)): ?>
    <strong>Condiciones: </strong><br><br>
    <?php foreach ($condiciones as $condicion): ?>
        <?php echo htmlspecialchars($condicion['id_condiciones']); ?>
        <?php echo htmlspecialchars($condicion['descripcion_condiciones']); ?><br>
    <?php endforeach; ?>
<?php else: ?>
    No hay condiciones disponibles.
<?php endif; ?>
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Ver condiciones .PHP -----------------------------------
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
