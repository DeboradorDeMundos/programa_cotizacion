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
    ------------------------------------- INICIO ITred Spa Detalle proyecto.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->





    <div class="form-group">
        <label for="entrega">Entrega:</label> <!-- Etiqueta para el campo de entrada de la entrega -->
        <input type="text" id="entrega" name="entrega" placeholder="Dia entrega"> <!-- Campo de texto para ingresar detalles sobre la entrega. Este campo no es obligatorio -->
    </div>
</fieldset>


<fieldset class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
    <legend>Detalle proyecto</legend>
    <div class="form-group-inline">
        <div class="form-group">
            <label for="proyecto_nombre">Nombre</label> <!-- Etiqueta para el campo de entrada del nombre del proyecto -->
            <input type="text" id="proyecto_nombre" name="proyecto_nombre" placeholder="proyecto" required> <!-- Campo de texto para ingresar el nombre del proyecto. El atributo "required" hace que el campo sea obligatorio -->
        </div>
        <div class="form-group">
            <label for="proyecto_codigo">Código</label> <!-- Etiqueta para el campo de entrada del código del proyecto -->
            <input type="text" id="proyecto_codigo" name="proyecto_codigo" placeholder="1234" required> <!-- Campo de texto para ingresar el código del proyecto. También es obligatorio -->
        </div>
    </div>
    <div class="form-group-inline">
        <div class="form-group">
            <label for="area_trabajo">Área de Trabajo:</label> <!-- Etiqueta para el campo de entrada del área de trabajo -->
            <input type="text" id="area_trabajo" name="area_trabajo" placeholder="tecnologia" required> <!-- Campo de texto para ingresar el área de trabajo. Este campo es obligatorio -->
        </div>
        <div class="form-group">
            <label for="tipo_trabajo">Tipo de Trabajo:</label> <!-- Etiqueta para el campo de entrada del tipo de trabajo -->
            <input type="text" id="tipo_trabajo" name="tipo_trabajo" placeholder="instalacion" required> <!-- Campo de texto para ingresar el tipo de trabajo. También es obligatorio -->
        </div>
    </div>

    <div class="form-group">
        <label for="riesgo">Riesgo:</label> <!-- Etiqueta para el campo de entrada del riesgo asociado al proyecto -->
        <input type="text" id="riesgo" name="riesgo" placeholder="nivel de riesgo" required> <!-- Campo de texto para ingresar el nivel o tipo de riesgo. Este campo es obligatorio -->
    </div>
</fieldset>






<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario para C_Proyectos
    $proyecto_nombre = isset($_POST['proyecto_nombre']) ? trim($_POST['proyecto_nombre']) : null;
    $proyecto_codigo = isset($_POST['proyecto_codigo']) ? trim($_POST['proyecto_codigo']) : null;
    $tipo_trabajo = isset($_POST['tipo_trabajo']) ? $_POST['tipo_trabajo'] : null;
    $area_trabajo = isset($_POST['area_trabajo']) ? $_POST['area_trabajo'] : null;
    $riesgo = isset($_POST['riesgo']) ? $_POST['riesgo'] : null;
    $dias_compra = isset($_POST['dias_compra']) ? $_POST['dias_compra'] : null;
    $dias_trabajo = isset($_POST['dias_trabajo']) ? $_POST['dias_trabajo'] : null;
    $trabajadores = isset($_POST['trabajadores']) ? $_POST['trabajadores'] : null;
    $horario = isset($_POST['horario']) ? $_POST['horario'] : null;
    $colacion = isset($_POST['colacion']) ? $_POST['colacion'] : null;
    $entrega = isset($_POST['entrega']) ? $_POST['entrega'] : null;

    if ($proyecto_nombre && $proyecto_codigo) {
        // Insertar o actualizar el proyecto
        $sql = "INSERT INTO C_Proyectos (nombre_proyecto, codigo_proyecto, tipo_trabajo, area_trabajo, riesgo_proyecto, dias_compra, dias_trabajo, trabajadores, horario, colacion, entrega)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE 
                    nombre_proyecto=VALUES(nombre_proyecto), 
                    codigo_proyecto=VALUES(codigo_proyecto), 
                    tipo_trabajo=VALUES(tipo_trabajo), 
                    area_trabajo=VALUES(area_trabajo), 
                    riesgo_proyecto=VALUES(riesgo_proyecto),
                    dias_compra=VALUES(dias_compra),
                    dias_trabajo=VALUES(dias_trabajo),
                    trabajadores=VALUES(trabajadores),
                    horario=VALUES(horario),
                    colacion=VALUES(colacion),
                    entrega=VALUES(entrega)";
        $stmt = $mysqli->prepare($sql);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $mysqli->error);
        }
        $stmt->bind_param("sssssiissss", 
            $proyecto_nombre, 
            $proyecto_codigo, 
            $tipo_trabajo, 
            $area_trabajo, 
            $riesgo, 
            $dias_compra, 
            $dias_trabajo, 
            $trabajadores, 
            $horario, 
            $colacion, 
            $entrega
        );
        $stmt->execute();
        if ($stmt->error) {
            die("Error en la ejecución de la consulta: " . $stmt->error);
        }
        
        $id_proyecto = $mysqli->insert_id;
        echo "Proyecto insertado/actualizado. ID: $id_proyecto<br>";
    } else {
        echo "El nombre y el código del proyecto son obligatorios.";
    }
}
?>

     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Detalle proyecto.PHP ----------------------------------------
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
