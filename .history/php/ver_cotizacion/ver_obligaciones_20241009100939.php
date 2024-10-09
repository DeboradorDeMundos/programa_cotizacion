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
    ------------------------------------- INICIO ITred Ver obligaciones .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
<?php if (!empty($obligaciones)): ?>
    <strong>obligaciones: </strong><br><br>
    <?php foreach ($obligaciones as $obligacion): ?>
        <?php echo htmlspecialchars($obligacion['descripcion']); ?><br>
    <?php endforeach; ?>
<?php else: ?>
    No hay obligaciones disponibles.
<?php endif; ?>
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Ver obligaciones .PHP -----------------------------------
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