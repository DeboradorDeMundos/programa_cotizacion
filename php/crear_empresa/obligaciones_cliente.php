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

<h2>Obligaciones cliente</h2>
<div id="obligaciones-container">
    
        <!-- Aquí se agregarán dinámicamente las filas de condiciones -->
</div>

<div style="margin-top: 10px;">
    <button id="add-obligaciones-btn" type="button">Agregar nueva obligacion</button>
    <button id="remove-obligaciones-btn" type="button" style="display: none;">Eliminar última obligacion</button>
</div>
<script src="../../js/crear_empresa/obligaciones_cliente.js"></script>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $obligacionesString = $_POST['obligaciones'];
    
    $obligacionesArray = explode('|', $obligacionesString);
    if (!empty($obligacionesArray)) {
        $stmt = $mysqli->prepare("INSERT INTO E_Obligaciones_Cliente (indice, descripcion, id_empresa) VALUES (?, ?, ?)");

        if (!$stmt) {
            die("Error al preparar la consulta: " . $mysqli->error);
        }

        foreach ($obligacionesArray as $index => $obligacion) {
            $indice = $index + 1;
            $stmt->bind_param("isi", $indice, $obligacion, $id_empresa);
            if (!$stmt->execute()) {
                echo "Error al insertar obligación: " . $stmt->error;
            }
        }
        $stmt->close();
    } else {
        echo "No hay obligaciones para insertar.";
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
