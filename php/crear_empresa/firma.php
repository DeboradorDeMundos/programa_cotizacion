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
    ------------------------------------- INICIO ITred Spa Firma .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- falta php de esto -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/crear_empresa/firma.css">
    <title>Firma</title>
</head>
<body>
<div class="signature-container">
        <h1>Selecciona una opción de firma</h1>
        
        <div class="option">
            <input type="radio" id="auto-signature" name="signature-option" value="automatic">
            <label for="auto-signature">Firma Automática</label>
            <div id="auto-signature-display" class="signature-display" style="display: none;"></div>
        </div>

        <div class="option">
            <input type="radio" id="manual-signature" name="signature-option" value="manual">
            <label for="manual-signature">Firma Manual</label>
            <div id="manual-signatures" class="signature-display" style="display: none;">
                <div class="signature-row" style="display: flex; align-items: center;">
                    <input type="text" class="manual-signature-input" placeholder="Ingresa tu firma aquí..." style="flex: 1; margin-right: 10px;">
                    <button type="button" class="remove-signature" style="background-color: red; color: white; border: none; cursor: pointer; padding: 5px 10px;">Eliminar</button>
                </div>
                <button type="button" id="add-signature" style="margin-top: 10px; background-color: blue; color: white; border: none; cursor: pointer; padding: 5px 10px;">Agregar Fila</button>
            </div>
        </div>

        <div class="option">
            <input type="radio" id="image-signature" name="signature-option" value="image">
            <label for="image-signature">Firma por Imagen</label>
            <input type="file" id="signature-image" name="signature-image" accept="image/*" style="display: none;">
        </div>
    </div>

    <script src="../../js/crear_empresa/firma.js"></script>
</body>
</html>
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Firma  .PHP ----------------------------------------
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
