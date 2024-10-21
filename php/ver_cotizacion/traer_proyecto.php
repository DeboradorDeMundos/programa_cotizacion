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
    ------------------------------------- INICIO ITred Spa Traer proyecto .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<?php
// Inicializa las variables con valores por defecto
$proyecto_nombre = $proyecto_codigo = $tipo_trabajo = $area_trabajo = $riesgo = '';
$dias_compra = $dias_trabajo = $trabajadores = '';
$horario = $colacion = $entrega = '';

// Verificar si se ha enviado un ID de cotización
if (isset($_GET['id']) && intval($_GET['id']) > 0) {
    $id_cotizacion = intval($_GET['id']);
    // Consulta para obtener los datos del proyecto basado en la cotización
    $sql_proyecto = "SELECT 
        p.nombre_proyecto,
        p.codigo_proyecto,
        p.tipo_trabajo,
        p.area_trabajo,
        p.riesgo_proyecto,
        p.descripcion_riesgo,
        p.dias_compra,
        p.dias_trabajo,
        p.trabajadores,
        p.horario,
        p.colacion,
        p.entrega
    FROM C_Proyectos p
    LEFT JOIN C_Cotizaciones c ON p.id_proyecto = c.id_proyecto
    WHERE c.id_cotizacion = ?";

    if ($stmt_proyecto = $mysqli->prepare($sql_proyecto)) {
        $stmt_proyecto->bind_param("i", $id_cotizacion);
        $stmt_proyecto->execute();
        $result_proyecto = $stmt_proyecto->get_result();
        
        if ($result_proyecto->num_rows === 1) {
            $row = $result_proyecto->fetch_assoc();
            // Asignar los valores a las variables
            $proyecto_nombre = $row['nombre_proyecto'];
            $proyecto_codigo = $row['codigo_proyecto'];
            $tipo_trabajo = $row['tipo_trabajo'];
            $area_trabajo = $row['area_trabajo'];
            $riesgo = $row['riesgo_proyecto'];
            $riesgo_descripcion = $row['descripcion_riesgo'];
            $dias_compra = $row['dias_compra'];
            $dias_trabajo = $row['dias_trabajo'];
            $trabajadores = $row['trabajadores'];
            $horario = $row['horario'];
            $colacion = $row['colacion'];
            $entrega = $row['entrega'];
        } else {
            echo "<p>No se encontró el proyecto para la cotización especificada.</p>";
        }

        $stmt_proyecto->close();
    } else {
        echo "<p>Error al preparar la consulta del proyecto: " . $mysqli->error . "</p>";
    }
}

?>

<link rel="stylesheet" href="../../css/ver_cotizacion/traer_proyecto.css">
<!-- Título: Sección de detalle del proyecto -->
<fieldset class="box-6 cuadro-datos">
    <legend>Detalle proyecto</legend>
    <div class="form-group-inline">
        <div class="form-group">
            <!-- Título: Campo Nombre del proyecto -->
            <label for="proyecto_nombre">Nombre</label>
            <input type="text" id="proyecto_nombre" name="proyecto_nombre" required 
                pattern="^[A-Za-zÀ-ÿ0-9\s&.-]+$" 
                title="Por favor, ingrese solo letras, números y caracteres como &,-."
                oninput="QuitarCaracteresInvalidos(this)"
                placeholder="Ejemplo: Mi Proyecto 1"
                value="<?php echo htmlspecialchars($proyecto_nombre); ?>">
        </div>
        <div class="form-group">
            <!-- Título: Campo Código del proyecto -->
            <label for="proyecto_codigo">Código</label>
            <input type="text" id="proyecto_codigo" name="proyecto_codigo" required 
                maxlength="10" 
                pattern="^[a-zA-Z0-9-_]{1,10}$" 
                oninput="QuitarCaracteresInvalidos(this)" 
                title="Ingresa un código de hasta 10 caracteres (letras, números, guiones y guiones bajos)."
                placeholder="Introduce un código único"
                value="<?php echo htmlspecialchars($proyecto_codigo); ?>">
        </div>
    </div>

    <div class="form-group-inline">
        <div class="form-group">
            <!-- Título: Campo Área de Trabajo -->
            <label for="area_trabajo">Área de Trabajo:</label>
            <select id="area_trabajo" name="area_trabajo" required>
                <option value="" disabled selected>Selecciona un área</option>
                <option value="tecnologia" <?php if ($area_trabajo == 'tecnologia') echo 'selected'; ?>>Tecnología</option>
                <option value="salud" <?php if ($area_trabajo == 'salud') echo 'selected'; ?>>Salud</option>
                <option value="educacion" <?php if ($area_trabajo == 'educacion') echo 'selected'; ?>>Educación</option>
                <option value="construccion" <?php if ($area_trabajo == 'construccion') echo 'selected'; ?>>Construcción</option>
                <option value="marketing" <?php if ($area_trabajo == 'marketing') echo 'selected'; ?>>Marketing</option>
                <option value="finanzas" <?php if ($area_trabajo == 'finanzas') echo 'selected'; ?>>Finanzas</option>
                <option value="logistica" <?php if ($area_trabajo == 'logistica') echo 'selected'; ?>>Logística</option>
                <option value="administracion" <?php if ($area_trabajo == 'administracion') echo 'selected'; ?>>Administración</option>
                <option value="recursos_humanos" <?php if ($area_trabajo == 'recursos_humanos') echo 'selected'; ?>>Recursos Humanos</option>
                <option value="ventas" <?php if ($area_trabajo == 'ventas') echo 'selected'; ?>>Ventas</option>
                <option value="diseño" <?php if ($area_trabajo == 'diseño') echo 'selected'; ?>>Diseño</option>
                <option value="investigacion" <?php if ($area_trabajo == 'investigacion') echo 'selected'; ?>>Investigación</option>
                <option value="arte" <?php if ($area_trabajo == 'arte') echo 'selected'; ?>>Arte</option>
                <option value="turismo" <?php if ($area_trabajo == 'turismo') echo 'selected'; ?>>Turismo</option>
                <option value="comercio" <?php if ($area_trabajo == 'comercio') echo 'selected'; ?>>Comercio</option>
            </select>
        </div>
        <div class="form-group">
            <!-- Título: Campo Tipo de Trabajo -->
            <label for="tipo_trabajo">Tipo de Trabajo:</label>
            <select id="tipo_trabajo" name="tipo_trabajo" required>
                <option value="" disabled selected>Selecciona un tipo de trabajo</option>
                <option value="instalacion" <?php if ($tipo_trabajo == 'instalacion') echo 'selected'; ?>>Instalación</option>
                <option value="mantenimiento" <?php if ($tipo_trabajo == 'mantenimiento') echo 'selected'; ?>>Mantenimiento</option>
                <option value="reparacion" <?php if ($tipo_trabajo == 'reparacion') echo 'selected'; ?>>Reparación</option>
                <option value="consultoria" <?php if ($tipo_trabajo == 'consultoria') echo 'selected'; ?>>Consultoría</option>
                <option value="desarrollo" <?php if ($tipo_trabajo == 'desarrollo') echo 'selected'; ?>>Desarrollo</option>
                <option value="diseño" <?php if ($tipo_trabajo == 'diseño') echo 'selected'; ?>>Diseño</option>
                <option value="gestión" <?php if ($tipo_trabajo == 'gestión') echo 'selected'; ?>>Gestión</option>
                <option value="soporte" <?php if ($tipo_trabajo == 'soporte') echo 'selected'; ?>>Soporte</option>
                <option value="capacitación" <?php if ($tipo_trabajo == 'capacitación') echo 'selected'; ?>>Capacitación</option>
                <option value="investigacion" <?php if ($tipo_trabajo == 'investigacion') echo 'selected'; ?>>Investigación</option>
                <option value="logistica" <?php if ($tipo_trabajo == 'logistica') echo 'selected'; ?>>Logística</option>
                <option value="ventas" <?php if ($tipo_trabajo == 'ventas') echo 'selected'; ?>>Ventas</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <!-- Título: Campo Riesgo -->
        <label for="riesgo">Riesgo:</label>
        <select id="riesgo" name="riesgo" required>
            <option value="" disabled selected>Selecciona un nivel de riesgo</option>
            <option value="alto" <?php if ($riesgo == 'alto') echo 'selected'; ?>>Alto</option>
            <option value="medio" <?php if ($riesgo == 'medio') echo 'selected'; ?>>Medio</option>
            <option value="bajo" <?php if ($riesgo == 'bajo') echo 'selected'; ?>>Bajo</option>
        </select>
    </div>

    <div class="form-group">
        <!-- Título: Campo Descripción de Riesgo -->
        <label for="riesgo_descripcion">Descripción de riesgo</label>
        <input type="text" id="riesgo_descripcion" name="riesgo_descripcion" required 
            pattern="^[A-Za-zÀ-ÿ0-9\s&.-]+$" 
            title="Por favor, ingrese solo letras, números y caracteres como &,-."
            oninput="QuitarCaracteresInvalidos(this)"
            placeholder="Ejemplo: Riesgo de retraso en la entrega"
            value="<?php echo htmlspecialchars($riesgo_descripcion); ?>">
    </div>
</fieldset>

<!-- Título: Sección de detalle adicional -->
<fieldset class="box-6 cuadro-datos cuadro-datos-left">
    <legend>Detalle</legend>
    <div class="form-group-inline">
        <div class="form-group">
            <!-- Título: Campo Días de Compra -->
            <label for="dias_compra">Días de Compra:</label>
            <input type="number" id="dias_compra" name="dias_compra" placeholder="Ingrese N° de días" 
                oninput="QuitarCaracteresInvalidos(this)"
                value="<?php echo htmlspecialchars($dias_compra); ?>">
        </div>
        <div class="form-group">
            <!-- Título: Campo Días de Trabajo -->
            <label for="dias_trabajo">Días de Trabajo:</label>
            <input type="number" id="dias_trabajo" name="dias_trabajo" placeholder="Ingrese N° de días" 
                oninput="QuitarCaracteresInvalidos(this)"
                value="<?php echo htmlspecialchars($dias_trabajo); ?>">
        </div>
    </div>

    <div class="form-group">
        <!-- Título: Campo Número de Trabajadores -->
        <label for="trabajadores">Número de Trabajadores:</label>
        <input type="number" id="trabajadores" name="trabajadores" placeholder="N° trabajadores" 
            oninput="QuitarCaracteresInvalidos(this)"
            value="<?php echo htmlspecialchars($trabajadores); ?>">
    </div>

    <div class="form-group-inline">
        <div class="form-group">
            <!-- Título: Campo Horario -->
            <label for="horario">Horario:</label>
            <input type="text" id="horario" name="horario" 
                pattern="^([01]?[0-9]|2[0-3]):[0-5][0-9] a ([01]?[0-9]|2[0-3]):[0-5][0-9]$" 
                title="Ingresa un horario válido (Ej: 08:00 a 18:00)." 
                placeholder="Ej: 08:00 a 18:00"
                value="<?php echo htmlspecialchars($horario); ?>">
        </div>
        <div class="form-group">
            <!-- Título: Campo Colación -->
            <label for="colacion">Colación:</label>
            <input type="text" id="colacion" name="colacion" placeholder="Ej: Sí o No"
                pattern="^[a-zA-Z]{2}$"
                title="Ingresa 'Sí' o 'No'."
                value="<?php echo htmlspecialchars($colacion); ?>">
        </div>
    </div>

    <div class="form-group">
        <!-- Título: Campo Entrega -->
        <label for="entrega">Entrega:</label>
        <input type="text" id="entrega" name="entrega" placeholder="Ej: Lunes, Martes"
            required 
            pattern="^[a-zA-Z0-9-_]{1,10}$"
            title="Ingresa un día o rango de días válido."
            value="<?php echo htmlspecialchars($entrega); ?>">
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
    -------------------------------------- FIN ITred Spa Traer proyecto .PHP ----------------------------------------
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
