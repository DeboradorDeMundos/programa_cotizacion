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
    ------------------------------------- INICIO ITred Spa Condiciones Generales.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->



<!-- falta php de esta funcion -->
<link rel="stylesheet" href="../../css/crear_empresa/condiciones_generales.css"> <!-- Enlaza una hoja de estilo externa que se encuentra en la ruta especificada para estilizar el contenido de la página -->
<h2>condiciones generaes</h2>
<div id="conditions-container">
    
        <!-- Aquí se agregarán dinámicamente las filas de condiciones -->
</div>

<div style="margin-top: 10px;">
    <button id="add-condition-btn" type="button">Agregar nueva condición</button>
    <button id="remove-condition-btn" type="button" style="display: none;">Eliminar última condición</button>
</div>

<script src="../../js/crear_empresa/condiciones_generales.js"></script>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $condicionesString = $_POST['condiciones'];
    
    $condicionesArray = explode('|', $condicionesString);
    if (!empty($condicionesArray)) {
        $stmt = $mysqli->prepare("INSERT INTO C_Condiciones_Generales (id_empresa, descripcion_condiciones) VALUES (?, ?)");

        if (!$stmt) {
            die("Error al preparar la consulta: " . $mysqli->error);
        }

        foreach ($condicionesArray as $condicion) {
            $stmt->bind_param("is", $id_empresa, $condicion);
            if (!$stmt->execute()) {
                echo "Error al insertar condición: " . $stmt->error;
            }
        }
        $stmt->close();
    } else {
        echo "No hay condiciones para insertar.";
    }
}
?>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Condiciones Generales .PHP ----------------------------------------
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