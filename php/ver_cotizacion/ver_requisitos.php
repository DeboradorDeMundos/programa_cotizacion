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
    ------------------------------------- INICIO ITred Ver requisitos .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
<?php if (!empty($requisitos)): ?>
    <strong>requisitos:</strong><br><br>
    <?php foreach ($requisitos as $requisito): ?>
        <?php echo htmlspecialchars($requisito['descripcion_condiciones']); ?><br>
    <?php endforeach; ?>
<?php else: ?>
    No hay requisitos disponibles.
<?php endif; ?>
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Ver requisitos .PHP -----------------------------------
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
