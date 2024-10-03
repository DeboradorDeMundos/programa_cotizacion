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
    <div style="text-align: center;">
        <?php
        // Verifica si hay un tipo de firma
        if ($tipo_firma) {
            switch ($tipo_firma) {
                case 1: // Firma Automática
                    echo "<h3>Tipo de Firma: Automática</h3>";
                    echo "<p><strong>" . htmlspecialchars($firma['titulo_firma']) . "</strong></p>";
                    echo "<p>" . htmlspecialchars($firma['nombre_encargado_firma']) . "</p>";
                    echo "<p>" . htmlspecialchars($firma['cargo_encargado_firma']) . " - " . htmlspecialchars($firma['nombre_empresa_firma']) . "</p>";
                    echo "<p>" . htmlspecialchars($firma['direccion_firma']) . "</p>";
                    echo "<p>" . htmlspecialchars($firma['ciudad_firma']) . ", " . htmlspecialchars($firma['pais_firma']) . "</p>";
                    echo "<p>Teléfono: " . htmlspecialchars($firma['telefono_empresa_firma']) . "</p>";
                    echo "<p>Celular: " . htmlspecialchars($firma['telefono_encargado_firma']) . "</p>"; // Asegúrate de que 'telefono_encargado_firma' sea el campo correcto para el celular
                    echo "<p>Email: " . htmlspecialchars($firma['email_firma']) . "</p>";
                    echo "<p>Web: " . htmlspecialchars($firma['web_firma']) . "</p>";
                    break;

                case 2: // Firma Manual
                    if (!empty($firma)) {
                        echo "<h3>Tipo de Firma: Manual</h3>";
                        echo "<p><strong>" . htmlspecialchars($firma['titulo_firma']) . "</strong></p>";
                        echo "<p><strong>" . htmlspecialchars($firma['nombre_empresa_firma']) . "</strong></p>";
                        echo "<p>" . htmlspecialchars($firma['direccion_firma']) . "</p>";
                        echo "<p>" . htmlspecialchars($firma['telefono_empresa_firma']) . "</p>";
                        echo "<p>" . htmlspecialchars($firma['email_firma']) . "</p>";
                    } else {
                        echo "<p>No se encontró la firma manual de la empresa.</p>";
                    }
                    break;

                case 3: // Firma Imagen
                    echo "<h3>Tipo de Firma: Imagen</h3>";
                    if (!empty($firma['firma_digital'])) {
                        // Mostrar la imagen de la firma
                        $firma_imagen_url = htmlspecialchars($firma['firma_digital']);
                        echo "<img src='$firma_imagen_url' alt='Firma Imagen' style='max-width: 300px;'>";
                    } else {
                        echo "<p>No hay firma registrada para este tipo.</p>";
                    }
                    break;

                case 4: // Firma Digital
                    echo "<h3>Tipo de Firma: Digital</h3>";
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
