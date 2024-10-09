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
    ------------------------------------- INICIO ITred Spa Requisitos basicos.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->
<!-- falta php de esta funcion -->

<link rel="stylesheet" href="../../css/crear_empresa/requisitos_basicos.css">
<h2>Requisitos basicos</h2>
<div id="contenedor-requistos">
    
        <!-- Aquí se agregarán dinámicamente las filas de condiciones -->
</div>

<div style="margin-top: 10px;">
    <button id="boton-agregar-requisito" type="button">Agregar nuevo requisito</button>
    <button id="boton-eliminar-obligacion" type="button" style="display: none;">Eliminar último requisito</button>
</div>

<script src="../../js/crear_empresa/requisitos_basicos.js"></script>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $requisitosString = $_POST['requisitos'];
    
    $requisitosArray = explode('|', $requisitosString);
    if (!empty($requisitosArray)) {
        $stmt = $mysqli->prepare("INSERT INTO E_Requisitos_Basicos (indice, descripcion_condiciones, id_empresa) VALUES (?, ?, ?)");

        if (!$stmt) {
            die("Error al preparar la consulta: " . $mysqli->error);
        }

        foreach ($requisitosArray as $index => $requisito) {
            $indice = $index + 1;
            $stmt->bind_param("isi", $indice, $requisito, $id_empresa);
            if (!$stmt->execute()) {
                echo "Error al insertar requisito: " . $stmt->error;
            }
        }
        $stmt->close();
    } else {
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
Pedro Agui Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->
