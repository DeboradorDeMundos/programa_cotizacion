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
    ------------------------------------- INICIO ITred Spa Condiciones Generales.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

    <link rel="stylesheet" href="../../css/crear_empresa/condiciones_generales.css"> <!-- Enlaza una hoja de estilo externa para estilizar el contenido de la página -->
<h2>Condiciones Generales</h2>
<div id="contenedor-condiciones">
    <!-- Aquí se agregarán dinámicamente las filas de condiciones -->
</div>

<div style="margin-top: 10px;">
    <button id="btn-agregar-condicion" type="button">Agregar nueva condición</button>
    <button id="btn-eliminar-condicion" type="button" style="display: none;">Eliminar última condición</button>
</div>

<script src="../../js/crear_empresa/condiciones_generales.js"></script>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $condicionesCadena = $_POST['condiciones'];
    
    $condicionesArray = explode('|', $condicionesCadena);
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
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->
