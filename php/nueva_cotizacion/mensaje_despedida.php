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
    ------------------------------------- INICIO ITred Spa mensaje despedida .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->


    <link rel="stylesheet" href="../../css/nueva_cotizacion/mensaje_despedida.css">
<fieldset class="mensaje_despedida-box">
    <div class="form-group">
        <label for="mensaje_despedida">MENSAJE AL FINAL DE LA COTIZACION:</label>
        <textarea id="mensaje_despedida" name="mensaje_despedida" rows="4" cols="50" placeholder="---> AGREGA AQUI TU MENSAJE DE DESPEDIDA AQUI ..."></textarea>
    </div>        
</fieldset>

<script src="../../js/nueva_cotizacion/mensaje_despedida.js"></script> 



     <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mensaje_despedida = $_POST['mensaje_despedida'] ?? '';
    
    echo "ID Cotización: " . $id_cotizacion . "<br>";
    echo "Mensaje Despedida: " . $mensaje_despedida . "<br>";
    
    // Asegúrate de que no esté vacío
    if (!empty($mensaje_despedida)) {
        $sql_insert_mensaje_despedida = "INSERT INTO C_mensaje_despedida (id_cotizacion, mensaje_despedida) VALUES (?, ?)";
        $stmt_insert_mensaje_despedida = $mysqli->prepare($sql_insert_mensaje_despedida);

        if (!$stmt_insert_mensaje_despedida) {
            die("Error al preparar la consulta: " . $mysqli->error);
        }

        // Asocia la ID de la cotización y el mensaje despedida
        $stmt_insert_mensaje_despedida->bind_param("is", $id_cotizacion, $mensaje_despedida);
        
        if ($stmt_insert_mensaje_despedida->execute()) {
            echo "Mensaje de despedida guardado correctamente.";
        } else {
            echo "Error al guardar el mensaje de despedida: " . $stmt_insert_mensaje_despedida->error;
        }

        // Cerrar la consulta
        $stmt_insert_mensaje_despedida->close();
    } else {
        echo "El mensaje de despedida no puede estar vacío.";
    }
}

?>


<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa  mensaje despedida .PHP -----------------------------------
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
