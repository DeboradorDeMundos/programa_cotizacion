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
    <!-- Título: Verificación de Tipo de Firma -->
    <?php
    // Verifica si hay un tipo de firma
    if ($tipo_firma) {
        switch ($tipo_firma) {
            case 1: // Firma Automática
            case 2: // Firma Manual
                // Título: Mostrar Imagen de Firma
                // Mostrar la imagen de la firma
                if (!empty($ruta_foto)) {
                    echo "<img src='$ruta_foto' alt='Logo de la Empresa' style='max-width: 150px; vertical-align: middle;' id='imagen-firma'>";
                }

                // Título: Información de la Firma
                echo "<div id='texto-firma-container' style='display: inline-block; vertical-align: middle;'>";
                echo "<p id='texto-firma'>" . htmlspecialchars($firma['nombre_encargado_firma']) . "</p>";
                echo "<p id='texto-firma'>" . htmlspecialchars($firma['cargo_encargado_firma']) . " - " . htmlspecialchars($firma['nombre_empresa_firma']) . "</p>";
                echo "<p id='texto-firma'>" . htmlspecialchars($firma['direccion_firma']) . "</p>";
                echo "<p id='texto-firma'>" . htmlspecialchars($firma['ciudad_firma']) . ", " . htmlspecialchars($firma['pais_firma']) . "</p>";
                echo "<p id='texto-firma'>Teléfono: " . htmlspecialchars($firma['telefono_empresa_firma']) . "</p>";
                echo "<p id='texto-firma'>Celular: " . htmlspecialchars($firma['telefono_encargado_firma']) . "</p>";
                echo "<p id='texto-firma'>Email: " . htmlspecialchars($firma['email_firma']) . "</p>";
                echo "<p id='texto-firma'>Web: " . htmlspecialchars($firma['web_firma']) . "</p>";
                echo "</div>"; // Cierre de texto-firma-container
                break;

            case 3: // Firma Imagen
                // Título: Mostrar Imagen de Firma Digital
                if (!empty($firma['firma_digital'])) {
                    // Mostrar la imagen de la firma
                    $firma_imagen_url = htmlspecialchars($firma['firma_digital']);
                    echo "<img src='$firma_imagen_url' alt='Firma Imagen' style='max-width: 300px;'>";
                } else {
                    echo "<p>No hay firma registrada para este tipo.</p>";
                }
                break;

            case 4: // Firma Digital
                // Título: Generar Código QR para Firma Digital
                // Generar el número de cotización
                $url_firma = "../ver_cotizacion/ver_firma.php?id_cotizacion=" . $numero_cotizacion;
                // URL del generador de códigos QR
                $qr_url = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($url_firma);
                // Mostrar el código QR
                echo "<p>Escanea el código QR para ver la firma digital:</p>";
                echo "<img src='$qr_url' alt='Código QR' style='max-width: 200px;'>";
                // Botón que lleva a la firma digital
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

<!-- Contenedor de Alineación -->
<div>
    <!-- Título: Alineación de la Firma -->
    <label>
        <!-- Título: Opción de Alineación Izquierda -->
        <input type="radio" name="alineacion" value="izquierda" checked onchange="cambiarAlineacion('izquierda')"> Izquierda
    </label>
    <label>
        <!-- Título: Opción de Alineación Centro -->
        <input type="radio" name="alineacion" value="centro" onchange="cambiarAlineacion('centro')"> Centro
    </label>
    <label>
        <!-- Título: Opción de Alineación Derecha -->
        <input type="radio" name="alineacion" value="derecha" onchange="cambiarAlineacion('derecha')"> Derecha
    </label>
</div>

<script src="../../js/ver_cotizacion/posicionar_firma.js"></script> 
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
