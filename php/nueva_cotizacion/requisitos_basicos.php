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
<?php
    // Consulta para obtener los requisitos básicos
    $query_requisitos = "SELECT id_requisitos, indice, descripcion_condiciones FROM E_Requisitos_Basicos WHERE id_empresa = ?";
    if ($stmt_req = $mysqli->prepare($query_requisitos)) {
        $stmt_req->bind_param('i', $id);
        $stmt_req->execute();
        $result_req = $stmt_req->get_result();
        $requisitos = $result_req->fetch_all(MYSQLI_ASSOC);
        $stmt_req->close();
    } else {
        echo "<p>Error al preparar la consulta de requisitos: " . $mysqli->error . "</p>";
    }
?> 
<div id="requisitos-basicos" class="data-box">
    <h3>Requisitos Básicos</h3>
    <div class="field">
        <label for="primer_titulo_1">Primer Título:</label>
        <input type="text" id="primer_titulo_1" name="primer_titulo[]" placeholder="Primer Título" required>
    </div>
    <div class="field">
        <label for="descripcion_condiciones_1">Descripción:</label>
        <input type="text" id="descripcion_requisitos" name="descripcion_requisitos[]" placeholder="Descripción de la condición" required>
    </div>
    <div class="field">
        <label for="ultimo_titulo_1">Último Título:</label>
        <input type="text" id="ultimo_titulo_1" name="ultimo_titulo[]" placeholder="Último Título" required>
    </div>
    <!-- Puedes duplicar el bloque anterior para más requisitos básicos -->
</div>



     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Requisitos basicos.PHP ----------------------------------------
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

