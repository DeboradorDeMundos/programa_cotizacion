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


<div class="box-6 logo-box">
    <label for="logo-upload" class="logo-contenedor">
        <?php if (isset($row['ruta_foto']) && !empty($row['ruta_foto'])): ?>
            <img src="<?php echo htmlspecialchars($row['ruta_foto'], ENT_QUOTES, 'UTF-8'); ?>" alt="Foto de perfil" id="logo-preview" class="logo" onclick="document.getElementById('logo-upload').click();" />
        <?php else: ?>
            <span id="logo-text" onclick="document.getElementById('logo-upload').click();">Cargar Logo de Empresa</span>
        <?php endif; ?>
        <input type="file" id="logo-upload" name="logo_upload" accept="image/*" style="display:none;" onchange="previewImage(event)">
    </label>
</div>


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
