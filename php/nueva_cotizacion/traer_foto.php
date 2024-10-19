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
    ------------------------------------- INICIO ITred Spa Traer foto.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

    <link rel="stylesheet" href="../../css/nueva_cotizacion/traer_foto.css">
<!-- Título: Sección para Cargar Logo de Empresa -->
<div class="box-6 caja-logo">
    <label for="subir-logo" class="contenedor-logo">
        <?php if (isset($row['ruta_foto']) && !empty($row['ruta_foto'])): ?>
            <!-- Título: Imagen de Logo de Empresa -->
            <img src="<?php echo htmlspecialchars($row['ruta_foto'], ENT_QUOTES, 'UTF-8'); ?>" alt="Foto de perfil" id="Previsualizar-logo" class="logo" onclick="document.getElementById('subir-logo').click();" />
        <?php else: ?>
            <!-- Título: Texto para Cargar Logo -->
            <span id="logo-text" onclick="document.getElementById('subir-logo').click();">Cargar Logo de Empresa</span>
        <?php endif; ?>
        <!-- Título: Input para Subir Logo -->
        <input type="file" id="subir-logo" name="logo_upload" accept="image/*" style="display:none;" onchange="previewImage(event)">
    </label>
</div>

<script src="../../js/nueva_cotizacion/traer_foto.js"></script> 
     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Traer foto.PHP ----------------------------------------
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
