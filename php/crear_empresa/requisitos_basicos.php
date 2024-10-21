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
    ------------------------------------- INICIO ITred Spa Requisitos basicos.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

     <link rel="stylesheet" href="../../css/crear_empresa/requisitos_basicos.css">

<h2>Requisitos básicos</h2>

<!-- TÍTULO: CONTENEDOR PARA LOS REQUISITOS -->
    <!-- Contenedor para los requisitos -->
    <div id="contenedor-requisitos">
        <!-- TÍTULO: AQUÍ SE AGREGARÁN DINÁMICAMENTE LAS FILAS DE CONDICIONES -->
            <!-- Aquí se agregarán dinámicamente las filas de condiciones -->
    </div>

    <div style="margin-top: 10px;">
        <!-- TÍTULO: BOTÓN PARA AGREGAR UN NUEVO REQUISITO -->
            <!-- Botón para agregar un nuevo requisito -->
            <button id="boton-agregar-requisito" type="button">Agregar nuevo requisito</button>
        <!-- TÍTULO: BOTÓN PARA ELIMINAR EL ÚLTIMO REQUISITO, INICIALMENTE OCULTO -->
            <!-- Botón para eliminar el último requisito, inicialmente oculto -->
            <button id="boton-eliminar-obligacion" type="button" style="display: none;">Eliminar último requisito</button>
    </div>

<script src="../../js/crear_empresa/requisitos_basicos.js"></script>

<?php
// Verifica si el método de la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtiene la cadena de requisitos desde el formulario
    $requisitosString = $_POST['requisitos'];

    // Convierte la cadena en un array
    $requisitosArray = explode('|', $requisitosString);
    
    // Comprueba si el array de requisitos no está vacío
    if (!empty($requisitosArray)) {
        // Prepara la consulta para insertar requisitos en la base de datos
        $stmt = $mysqli->prepare("INSERT INTO E_Requisitos_Basicos (indice, descripcion_condiciones, id_empresa) VALUES (?, ?, ?)");

        // Verifica si la preparación de la consulta fue exitosa
        if (!$stmt) {
            die("Error al preparar la consulta: " . $mysqli->error);
        }

        // Inserta cada requisito en la base de datos
        foreach ($requisitosArray as $index => $requisito) {
            $indice = $index + 1; // Incrementa el índice para cada requisito
            $stmt->bind_param("isi", $indice, $requisito, $id_empresa);
            if (!$stmt->execute()) {
                // Muestra un mensaje de error si la inserción falla
                echo "Error al insertar requisito: " . $stmt->error;
            }
        }
        // Cierra la declaración
        $stmt->close();
    } else {
        // Mensaje si no hay requisitos para insertar
        echo "No hay requisitos para insertar.";
    }
}
?>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Requisitos basicos .PHP ----------------------------------------
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
