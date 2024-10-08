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
    ------------------------------------- INICIO ITred Spa Detalle proyecto.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->




    

<link rel="stylesheet" href="../../css/nueva_cotizacion/detalle_proyecto.css">
<fieldset class="box-6 cuadro-datos"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
    <legend>Datos proyecto</legend>
    <div class="form-group-inline">
        <div class="form-group">
            <label for="proyecto_nombre">Nombre</label> <!-- Etiqueta para el campo de entrada del nombre del proyecto -->
            <input type="text" id="proyecto_nombre" name="proyecto_nombre" required 
                pattern="^[A-Za-zÀ-ÿ0-9\s&.-]+$" 
                title="Por favor, ingrese solo letras, números y caracteres como &,-."
                oninput="QuitarCaracteresInvalidos(this)"
                placeholder="Ejemplo: Mi Proyecto 1"> <!-- Campo de texto para ingresar el nombre del proyecto. El atributo "required" hace que el campo sea obligatorio -->
        </div>

        <div class="form-group">
            <label for="proyecto_codigo">Código</label>
            <input type="text" id="proyecto_codigo" name="proyecto_codigo" 
                placeholder="Introduce un código único" 
                required 
                maxlength="10" 
                pattern="^[a-zA-Z0-9-_]{1,10}$" 
                oninput="QuitarCaracteresInvalidos(this)"
                title="Ingresa un código de hasta 10 caracteres (letras, números, guiones y guiones bajos).">
        </div>
        
    </div>
    <div class="form-group-inline">

        <div class="form-group">
            <label for="area_trabajo">Área de Trabajo:</label> <!-- Etiqueta para el campo de selección del área de trabajo -->
            <select id="area_trabajo" name="area_trabajo" required> <!-- Campo de selección para el área de trabajo. Este campo es obligatorio -->
                <option value="" disabled selected>Selecciona un área</option> <!-- Opción por defecto -->
                <option value="tecnologia">Tecnología</option>
                <option value="salud">Salud</option>
                <option value="educacion">Educación</option>
                <option value="construccion">Construcción</option>
                <option value="marketing">Marketing</option>
                <option value="finanzas">Finanzas</option>
                <option value="logistica">Logística</option>
                <option value="administracion">Administración</option>
                <option value="recursos_humanos">Recursos Humanos</option>
                <option value="ventas">Ventas</option>
                <option value="diseño">Diseño</option>
                <option value="investigacion">Investigación</option>
                <option value="arte">Arte</option>
                <option value="turismo">Turismo</option>
                <option value="comercio">Comercio</option>
            </select>
        </div>

        <div class="form-group">
            <label for="tipo_trabajo">Tipo de Trabajo:</label> <!-- Etiqueta para el campo de selección del tipo de trabajo -->
            <select id="tipo_trabajo" name="tipo_trabajo" required> <!-- Campo de selección para el tipo de trabajo. Este campo es obligatorio -->
                <option value="" disabled selected>Selecciona un tipo de trabajo</option> <!-- Opción por defecto -->
                <option value="instalacion">Instalación</option>
                <option value="mantenimiento">Mantenimiento</option>
                <option value="reparacion">Reparación</option>
                <option value="consultoria">Consultoría</option>
                <option value="desarrollo">Desarrollo</option>
                <option value="diseño">Diseño</option>
                <option value="gestión">Gestión</option>
                <option value="soporte">Soporte</option>
                <option value="capacitación">Capacitación</option>
                <option value="investigacion">Investigación</option>
                <option value="logistica">Logística</option>
                <option value="ventas">Ventas</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="riesgo">Riesgo:</label> <!-- Etiqueta para el campo de selección del riesgo -->
        <select id="riesgo" name="riesgo" required> <!-- Campo de selección para el riesgo. Este campo es obligatorio -->
            <option value="" disabled selected>Selecciona un nivel de riesgo</option> <!-- Opción por defecto -->
            <option value="alto">Alto</option>
            <option value="medio">Medio</option>
            <option value="bajo">Bajo</option>
        </select>
    </div>

    <div class="form-group">
        <label for="riesgo_descripcion">Descripción de riesgo</label> <!-- Etiqueta para el campo de entrada de la descripción del riesgo -->
        <input type="text" id="riesgo_descripcion" name="riesgo_descripcion" required 
            pattern="^[A-Za-zÀ-ÿ0-9\s&.-]+$" 
            title="Por favor, ingrese solo letras, números y caracteres como &,-."
            oninput="QuitarCaracteresInvalidos(this)"
            placeholder="Ejemplo: Riesgo de retraso en la entrega"> <!-- Campo de texto para ingresar la descripción del riesgo. El atributo "required" hace que el campo sea obligatorio -->
    </div>

</fieldset>


<fieldset class="box-6 cuadro-datos cuadro-datos-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "cuadro-datos-left" para estilo -->
    <legend>-</legend>
    <div class="form-group-inline">
        <div class="form-group">
            <label for="dias_compra">Días de Compra:</label> <!-- Etiqueta para el campo de entrada de los días de compra -->
            <input type="number" id="dias_compra" name="dias_compra" placeholder="ingrese N° de dias" oninput="QuitarCaracteresInvalidos(this)"> <!-- Campo de número para ingresar la cantidad de días de compra. Este campo no es obligatorio -->
        </div>
        <div class="form-group">
            <label for="dias_trabajo">Días de Trabajo:</label> <!-- Etiqueta para el campo de entrada de los días de trabajo -->
            <input type="number" id="dias_trabajo" name="dias_trabajo" placeholder="ingrese N° de dias" oninput="QuitarCaracteresInvalidos(this)"> <!-- Campo de número para ingresar la cantidad de días de trabajo. No es obligatorio -->
        </div>
    </div>

    <div class="form-group">
        <label for="trabajadores">Número de Trabajadores:</label> <!-- Etiqueta para el campo de entrada del número de trabajadores -->
        <input type="number" id="trabajadores" name="trabajadores" placeholder="N° trabajadores" oninput="QuitarCaracteresInvalidos(this)"> <!-- Campo de número para ingresar la cantidad de trabajadores. Este campo no es obligatorio -->
    </div>

    <div class="form-group-inline">
        <div class="form-group">
        <label for="horario">Horario:</label>
        <input type="text" id="horario" name="horario" 
            placeholder="Ej: 08:00 a 18:00" 
            pattern="^([01]?[0-9]|2[0-3]):[0-5][0-9] a ([01]?[0-9]|2[0-3]):[0-5][0-9]$" 
            oninput="QuitarCaracteresInvalidos(this)"
            title="Ingresa un horario válido (Ej: 08:00 a 18:00)."> <!-- Campo de texto para ingresar el horario. Este campo no es obligatorio -->
        </div>
        <div class="form-group">
            <label for="colacion">Colación:</label>
            <input type="text" id="colacion" name="colacion" 
                placeholder="Ej: Sí o No" 
                pattern="^[a-zA-Z0-9-_]{1,10}$" 
                oninput="QuitarCaracteresInvalidos(this)"
                title="Ingresa 'Sí' o 'No'." /> <!-- Campo de texto para ingresar la información sobre la colación. No es obligatorio -->
        </div>
    </div>

    <div class="form-group">
        <label for="entrega">Entrega:</label> <!-- Etiqueta para el campo de entrada de la entrega -->
        <input type="text" id="entrega" name="entrega" 
            placeholder="Ej: Lunes, Martes" 
            required 
            pattern="^[a-zA-Z0-9-_]{1,10}$" 
            oninput="QuitarCaracteresInvalidos(this)"
            title="Ingresa un día de la semana (Ej: Lunes, Martes, etc.). Solo se permiten nombres de días."> <!-- Campo de texto para ingresar detalles sobre la entrega. Este campo no es obligatorio -->
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
    $riesgo_descripcion = isset($_POST['riesgo_descripcion']) ? trim($_POST['riesgo_descripcion']) : null; // Nueva variable
    $dias_compra = isset($_POST['dias_compra']) ? $_POST['dias_compra'] : null;
    $dias_trabajo = isset($_POST['dias_trabajo']) ? $_POST['dias_trabajo'] : null;
    $trabajadores = isset($_POST['trabajadores']) ? $_POST['trabajadores'] : null;
    $horario = isset($_POST['horario']) ? $_POST['horario'] : null;
    $colacion = isset($_POST['colacion']) ? $_POST['colacion'] : null;
    $entrega = isset($_POST['entrega']) ? $_POST['entrega'] : null;

    if ($proyecto_nombre && $proyecto_codigo) {
        // Insertar o actualizar el proyecto
        $sql = "INSERT INTO C_Proyectos (nombre_proyecto, codigo_proyecto, tipo_trabajo, area_trabajo, riesgo_proyecto, descripcion_riesgo, dias_compra, dias_trabajo, trabajadores, horario, colacion, entrega)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE 
                    nombre_proyecto=VALUES(nombre_proyecto), 
                    codigo_proyecto=VALUES(codigo_proyecto), 
                    tipo_trabajo=VALUES(tipo_trabajo), 
                    area_trabajo=VALUES(area_trabajo), 
                    riesgo_proyecto=VALUES(riesgo_proyecto),
                    descripcion_riesgo=VALUES(descripcion_riesgo),
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
        $stmt->bind_param("ssssssiiisss", 
            $proyecto_nombre, 
            $proyecto_codigo, 
            $tipo_trabajo, 
            $area_trabajo, 
            $riesgo, 
            $riesgo_descripcion, // Nueva variable para descripción de riesgo
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
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->
