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
    <link rel="stylesheet" href="../../css/crear_empresa/condiciones_generales.css"> <!-- Enlaza una hoja de estilo externa que se encuentra en la ruta especificada para estilizar el contenido de la página -->
<h2>condiciones generaes</h2>
<div id="contenedor-condiciones">
    <!-- Aquí se agregarán dinámicamente las filas de condiciones -->
</div>

<div style="margin-top: 10px;">
    <!-- Botones para agregar condiciones -->
    <button id="boton-agregar-condicion" type="button">Agregar nueva condición</button>
    <!-- Botones eliminar condiciones -->
    <button id="boton-eliminar-condicion" type="button">Eliminar última condición</button>
</div>

<script src="../../js/crear_empresa/condiciones_generales.js"></script> <!-- Enlaza un archivo JavaScript externo para manejar la lógica relacionada con las condiciones generales -->

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Se verifica si el formulario ha sido enviado
    $condicionesString = $_POST['condiciones']; // Se obtiene el string de condiciones del formulario
    
    $condicionesArray = explode('|', $condicionesString); // Se divide el string en un array utilizando el delimitador '|'
    if (!empty($condicionesArray)) {
        // Preparar la consulta para insertar las condiciones en la base de datos
        $stmt = $mysqli->prepare("INSERT INTO C_Condiciones_Generales (id_empresa, descripcion_condiciones) VALUES (?, ?)");

        if (!$stmt) {
            // Manejo de errores al preparar la consulta
            die("Error al preparar la consulta: " . $mysqli->error);
        }

        foreach ($condicionesArray as $condicion) {
            // Vincula los parámetros de la consulta y ejecuta la inserción
            $stmt->bind_param("is", $id_empresa, $condicion);
            if (!$stmt->execute()) {
                // Manejo de errores al insertar condición
                echo "Error al insertar condición: " . $stmt->error;
            }
        }
        $stmt->close(); // Cierra la declaración preparada
    } else {
        // Mensaje si no hay condiciones para insertar
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