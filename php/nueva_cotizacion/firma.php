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
    ------------------------------------- INICIO ITred Spa Firma .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
    
    <div id="firma-container" style="text-align: left;"> <!-- Aseguramos que inicie a la izquierda -->
    <?php
// Verifica si hay un tipo de firma
if ($tipo_firma) {
    switch ($tipo_firma) {
        case 1: // Firma Automática
        case 2: // Firma Manual
            echo "<div id='firma-container'>";

            // Mostrar la imagen de la firma si está disponible
            if (!empty($ruta_foto)) {
                echo "<img src='$ruta_foto' alt='Logo de la Empresa' class='imagen-firma' style='max-width: 150px; vertical-align: middle;'>";
            }

            // Contenedor de los textos de la firma
            echo "<div id='texto-firma-container' style='display: inline-block; vertical-align: middle;'>";
            echo "<p class='texto-firma'><strong>FIRMA DEL REPRESENTANTE:</strong></p>";
            echo "<img class='imagen-firma' src='" . htmlspecialchars($row['ruta_foto']) . "' alt='Firma' style='width:300px; height:auto;'>";
            echo "<p class='texto-firma'>" . htmlspecialchars($firma['nombre_encargado_firma']) . "</p>";
            echo "<p class='texto-firma'>" . htmlspecialchars($firma['cargo_encargado_firma']) . " - " . htmlspecialchars($firma['nombre_empresa_firma']) . "</p>";
            echo "<p class='texto-firma'>" . htmlspecialchars($firma['direccion_firma']) . "</p>";
            echo "<p class='texto-firma'>" . htmlspecialchars($firma['ciudad_firma']) . ", " . htmlspecialchars($firma['pais_firma']) . "</p>";
            echo "<p class='texto-firma'>Teléfono: " . htmlspecialchars($firma['telefono_empresa_firma']) . "</p>";
            echo "<p class='texto-firma'>Celular: " . htmlspecialchars($firma['telefono_encargado_firma']) . "</p>";
            echo "<p class='texto-firma'>Email: " . htmlspecialchars($firma['email_firma']) . "</p>";
            echo "<p class='texto-firma'>Web: " . htmlspecialchars($firma['web_firma']) . "</p>";
            echo "</div>"; // Cierre de texto-firma-container

            echo "</div>"; // Cierre de firma-container
            break;

        case 3: // Firma Imagen
            if (!empty($firma['firma_digital'])) {
                $firma_imagen_url = htmlspecialchars($firma['firma_digital']);
                echo "<img src='$firma_imagen_url' alt='Firma Imagen' style='max-width: 300px;'>";
            } else {
                echo "<p>No hay firma registrada para este tipo.</p>";
            }
            break;

        case 4: // Firma Digital
            $url_firma = "../ver_cotizacion/ver_firma.php?id_cotizacion=" . $numero_cotizacion;
            $qr_url = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($url_firma);
            echo "<p>Escanea el código QR para ver la firma digital:</p>";
            echo "<img src='$qr_url' alt='Código QR' style='max-width: 200px;'>";
            echo "<p><a href='$url_firma' class='btn btn-primary' style='padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;'>Ver Firma Digital</a></p>";
            break;

        default:
            echo "<h3>Tipo de Firma: Desconocido</h3>";
            echo "<p>No se puede determinar el tipo de firma.</p>";
            break;
    }
} else {
    echo "<p>No se encontró la firma de la empresa.</p>";
}
?>

</div>

<div class="contenedor-alineacion"> <!-- Título: Contenedor de Alineación -->
    <label> <!-- Título: Opción Izquierda -->
        <input type="radio" name="alineacion" value="izquierda" checked onchange="cambiarAlineacion('izquierda')"> Izquierda
    </label>
    <label> <!-- Título: Opción Centro -->
        <input type="radio" name="alineacion" value="centro" onchange="cambiarAlineacion('centro')"> Centro
    </label>
    <label> <!-- Título: Opción Derecha -->
        <input type="radio" name="alineacion" value="derecha" onchange="cambiarAlineacion('derecha')"> Derecha
    </label>
</div>



<script src="../../js/nueva_cotizacion/firma.js"></script> 
     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Firma  .PHP ----------------------------------------
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
