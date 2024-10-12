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
    ------------------------------------- INICIO ITred Spa Traer cliente .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<?php
// Inicializa las variables con valores por defecto
$cliente_nombre = $cliente_empresa = $cliente_direccion = $cliente_lugar = '';
$cliente_fono = $cliente_email = $cliente_cargo = $cliente_giro = $cliente_comuna = $cliente_ciudad = $cliente_tipo = '';
$cliente_id = 0; // Agregado para manejar el ID del cliente

// Verificar si se ha enviado un ID de cotización
if (isset($_GET['id']) && intval($_GET['id']) > 0) {
    $id_cotizacion = intval($_GET['id']);
    // Consulta para obtener los datos del cliente basado en la cotización
    $sql_cliente = "SELECT 
        c.id_cliente,
        c.nombre_cliente,
        c.empresa_cliente,
        c.direccion_cliente,
        c.lugar_cliente,
        c.telefono_cliente,
        c.email_cliente,
        c.cargo_cliente,
        c.giro_cliente,
        c.comuna_cliente,
        c.ciudad_cliente,
        c.tipo_cliente
    FROM C_Clientes c
    LEFT JOIN C_Cotizaciones co ON c.id_cliente = co.id_cliente
    WHERE co.id_cotizacion = ?";

    if ($stmt_cliente = $mysqli->prepare($sql_cliente)) {
        $stmt_cliente->bind_param("i", $id_cotizacion);
        $stmt_cliente->execute();
        $result_cliente = $stmt_cliente->get_result();
        
        if ($result_cliente->num_rows === 1) {
            $row = $result_cliente->fetch_assoc();
            // Asignar los valores a las variables
            $cliente_id = $row['id_cliente'];
            $cliente_nombre = $row['nombre_cliente'];
            $cliente_empresa = $row['empresa_cliente'];
            $cliente_direccion = $row['direccion_cliente'];
            $cliente_lugar = $row['lugar_cliente'];
            $cliente_fono = $row['telefono_cliente'];
            $cliente_email = $row['email_cliente'];
            $cliente_cargo = $row['cargo_cliente'];
            $cliente_giro = $row['giro_cliente'];
            $cliente_comuna = $row['comuna_cliente'];
            $cliente_ciudad = $row['ciudad_cliente'];
            $cliente_tipo = $row['tipo_cliente'];
        } else {
            echo "<p>No se encontró el cliente para la cotización especificada.</p>";
        }

        $stmt_cliente->close();
    } else {
        echo "<p>Error al preparar la consulta del cliente: " . $mysqli->error . "</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario cliente
    $cliente_nombre = isset($_POST['cliente_nombre']) ? trim($_POST['cliente_nombre']) : null;
    $cliente_empresa = isset($_POST['cliente_empresa']) ? $_POST['cliente_empresa'] : null;
    $cliente_direccion = isset($_POST['cliente_direccion']) ? $_POST['cliente_direccion'] : null;
    $cliente_lugar = isset($_POST['cliente_lugar']) ? $_POST['cliente_lugar'] : null;
    $cliente_fono = isset($_POST['cliente_fono']) ? $_POST['cliente_fono'] : null;
    $cliente_email = isset($_POST['cliente_email']) ? $_POST['cliente_email'] : null;
    $cliente_cargo = isset($_POST['cliente_cargo']) ? $_POST['cliente_cargo'] : null;
    $cliente_giro = isset($_POST['cliente_giro']) ? $_POST['cliente_giro'] : null;
    $cliente_comuna = isset($_POST['cliente_comuna']) ? $_POST['cliente_comuna'] : null;
    $cliente_ciudad = isset($_POST['cliente_ciudad']) ? $_POST['cliente_ciudad'] : null;
    $cliente_tipo = isset($_POST['cliente_tipo']) ? $_POST['cliente_tipo'] : null;

    if ($cliente_nombre) {
        // Insertar o actualizar el cliente
        $sql = "INSERT INTO C_Clientes (nombre_cliente, empresa_cliente, direccion_cliente, lugar_cliente, telefono_cliente, email_cliente, cargo_cliente, giro_cliente, comuna_cliente, ciudad_cliente, tipo_cliente)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE 
                    nombre_cliente=VALUES(nombre_cliente), 
                    empresa_cliente=VALUES(empresa_cliente), 
                    direccion_cliente=VALUES(direccion_cliente), 
                    lugar_cliente=VALUES(lugar_cliente), 
                    telefono_cliente=VALUES(telefono_cliente), 
                    email_cliente=VALUES(email_cliente), 
                    cargo_cliente=VALUES(cargo_cliente), 
                    giro_cliente=VALUES(giro_cliente), 
                    comuna_cliente=VALUES(comuna_cliente), 
                    ciudad_cliente=VALUES(ciudad_cliente), 
                    tipo_cliente=VALUES(tipo_cliente)";
        $stmt = $mysqli->prepare($sql);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $mysqli->error);
        }
        $stmt->bind_param("sssssssssss", 
            $cliente_nombre, 
            $cliente_empresa, 
            $cliente_direccion, 
            $cliente_lugar, 
            $cliente_fono, 
            $cliente_email, 
            $cliente_cargo, 
            $cliente_giro, 
            $cliente_comuna, 
            $cliente_ciudad, 
            $cliente_tipo
        );
        $stmt->execute();
        if ($stmt->error) {
            die("Error en la ejecución de la consulta: " . $stmt->error);
        }
        
        $cliente_id = $mysqli->insert_id;
        echo "Cliente insertado/actualizado. ID: $cliente_id<br>";
    } else {
        echo "Nombre del cliente es obligatorio.";
    }
}
?>
<link rel="stylesheet" href="../../css/ver_cotizacion/traer_cliente.css">
<fieldset class="row">
    <legend>Datos cliente</legend>
    <div class="box-6 cuadro-datos">
        <div class="form-group-inline">
            <div class="form-group">
                <label for="cliente_rut">RUT:</label>
                <input type="text" id="cliente_rut" name="cliente_rut"
                    placeholder="Ej: 12.345.678-9"
                    value="<?php echo htmlspecialchars($cliente_rut); ?>" 
                    minlength="7" maxlength="12" 
                    oninput="FormatearRut(this)"
                    oninput="QuitarCaracteresInvalidos(this)"
                    required>
            </div>
            <div class="form-group">
                <label for="cliente_nombre">Nombre:</label>
                <input type="text" id="cliente_nombre" name="cliente_nombre"
                    placeholder="Ejemplo: Pedro Perez"
                    value="<?php echo htmlspecialchars($cliente_nombre); ?>" 
                    required
                    pattern="^[A-Za-zÀ-ÿ0-9\s&.-]+$" 
                    title="Por favor, ingrese solo letras, números y caracteres como &,-."
                    oninput="QuitarCaracteresInvalidos(this)">
            </div>
        </div>

        <div class="form-group">
            <label for="cliente_empresa">Empresa:</label>
            <input type="text" id="cliente_empresa" name="cliente_empresa" 
                placeholder="Ejemplo: Mi Empresa S.A."
                value="<?php echo htmlspecialchars($cliente_empresa); ?>">
        </div>

        <div class="form-group-inline">
            <div class="form-group">
                <label for="cliente_direccion">Dirección:</label>
                <input type="text" id="cliente_direccion" name="cliente_direccion" 
                    placeholder="Ejemplo: Av. Siempre Viva 742"
                    value="<?php echo htmlspecialchars($cliente_direccion); ?>">
            </div>
            <div class="form-group">
                <label for="cliente_lugar">Lugar:</label>
                <select id="cliente_lugar" name="cliente_lugar" required>
                    <option value="" disabled <?php echo $cliente_lugar ? '' : 'selected'; ?>>Selecciona un lugar</option>
                    <option value="casa" <?php echo $cliente_lugar === 'casa' ? 'selected' : ''; ?>>Casa</option>
                    <option value="oficina" <?php echo $cliente_lugar === 'oficina' ? 'selected' : ''; ?>>Oficina</option>
                    <option value="local_comercial" <?php echo $cliente_lugar === 'local_comercial' ? 'selected' : ''; ?>>Local Comercial</option>
                    <option value="almacen" <?php echo $cliente_lugar === 'almacen' ? 'selected' : ''; ?>>Almacén</option>
                    <option value="bodega" <?php echo $cliente_lugar === 'bodega' ? 'selected' : ''; ?>>Bodega</option>
                    <option value="fabrica" <?php echo $cliente_lugar === 'fabrica' ? 'selected' : ''; ?>>Fábrica</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="cliente_fono">Teléfono:</label>
            <input type="text" id="cliente_fono" name="cliente_fono"
                pattern="\+?\d{7,15}" 
                placeholder="+1234567890" 
                value="<?php echo htmlspecialchars($cliente_fono); ?>">
        </div>
    </div>

    <div class="box-6 cuadro-datos cuadro-datos-left">
        <div class="form-group">
            <label for="cliente_email">Email:</label>
            <input type="email" id="cliente_email" name="cliente_email"
                placeholder="ejemplo@gmail.com" 
                value="<?php echo htmlspecialchars($cliente_email); ?>">
        </div>

        <div class="form-group">
            <label for="cliente_cargo">Cargo:</label>
            <select id="cliente_cargo" name="cliente_cargo" required>
                <option value="" disabled <?php echo $cliente_cargo ? '' : 'selected'; ?>>Selecciona un cargo</option>
                <option value="gerente" <?php echo $cliente_cargo === 'gerente' ? 'selected' : ''; ?>>Gerente</option>
                <option value="director" <?php echo $cliente_cargo === 'director' ? 'selected' : ''; ?>>Director</option>
                <option value="ejecutivo" <?php echo $cliente_cargo === 'ejecutivo' ? 'selected' : ''; ?>>Ejecutivo</option>
                <option value="supervisor" <?php echo $cliente_cargo === 'supervisor' ? 'selected' : ''; ?>>Supervisor</option>
                <option value="jefe_area" <?php echo $cliente_cargo === 'jefe_area' ? 'selected' : ''; ?>>Jefe de Área</option>
                <option value="coordinador" <?php echo $cliente_cargo === 'coordinador' ? 'selected' : ''; ?>>Coordinador</option>
                <option value="analista" <?php echo $cliente_cargo === 'analista' ? 'selected' : ''; ?>>Analista</option>
                <option value="asistente" <?php echo $cliente_cargo === 'asistente' ? 'selected' : ''; ?>>Asistente</option>
                <option value="consultor" <?php echo $cliente_cargo === 'consultor' ? 'selected' : ''; ?>>Consultor</option>
                <option value="ingeniero" <?php echo $cliente_cargo === 'ingeniero' ? 'selected' : ''; ?>>Ingeniero</option>
                <option value="técnico" <?php echo $cliente_cargo === 'técnico' ? 'selected' : ''; ?>>Técnico</option>
                <option value="auxiliar" <?php echo $cliente_cargo === 'auxiliar' ? 'selected' : ''; ?>>Auxiliar</option>
                <option value="vendedor" <?php echo $cliente_cargo === 'vendedor' ? 'selected' : ''; ?>>Vendedor</option>
                <option value="administrativo" <?php echo $cliente_cargo === 'administrativo' ? 'selected' : ''; ?>>Administrativo</option>
                <option value="recepcionista" <?php echo $cliente_cargo === 'recepcionista' ? 'selected' : ''; ?>>Recepcionista</option>
                <option value="operador" <?php echo $cliente_cargo === 'operador' ? 'selected' : ''; ?>>Operador</option>
                <option value="contador" <?php echo $cliente_cargo === 'contador' ? 'selected' : ''; ?>>Contador</option>
                <option value="encargado_rrhh" <?php echo $cliente_cargo === 'encargado_rrhh' ? 'selected' : ''; ?>>Encargado de RRHH</option>
            </select>
        </div>

        <div class="form-group">
            <label for="cliente_giro">Giro:</label>
            <select id="cliente_giro" name="cliente_giro" required>
                <option value="" disabled <?php echo $cliente_giro ? '' : 'selected'; ?>>Selecciona un giro</option>
                <option value="comercio" <?php echo $cliente_giro === 'comercio' ? 'selected' : ''; ?>>Comercio</option>
                <option value="servicios" <?php echo $cliente_giro === 'servicios' ? 'selected' : ''; ?>>Servicios</option>
                <option value="manufactura" <?php echo $cliente_giro === 'manufactura' ? 'selected' : ''; ?>>Manufactura</option>
                <option value="construccion" <?php echo $cliente_giro === 'construccion' ? 'selected' : ''; ?>>Construcción</option>
                <option value="tecnologia" <?php echo $cliente_giro === 'tecnologia' ? 'selected' : ''; ?>>Tecnología</option>
                <option value="alimentos_bebidas" <?php echo $cliente_giro === 'alimentos_bebidas' ? 'selected' : ''; ?>>Alimentos y Bebidas</option>
                <option value="educacion" <?php echo $cliente_giro === 'educacion' ? 'selected' : ''; ?>>Educación</option>
                <option value="salud" <?php echo $cliente_giro === 'salud' ? 'selected' : ''; ?>>Salud</option>
                <option value="finanzas" <?php echo $cliente_giro === 'finanzas' ? 'selected' : ''; ?>>Finanzas</option>
                <option value="agricultura" <?php echo $cliente_giro === 'agricultura' ? 'selected' : ''; ?>>Agricultura</option>
                <option value="logistica_transporte" <?php echo $cliente_giro === 'logistica_transporte' ? 'selected' : ''; ?>>Logística y Transporte</option>
                <option value="inmobiliario" <?php echo $cliente_giro === 'inmobiliario' ? 'selected' : ''; ?>>Inmobiliario</option>
                <option value="energia" <?php echo $cliente_giro === 'energia' ? 'selected' : ''; ?>>Energía</option>
            </select>
        </div>

        <div class="form-group-inline">
            <div class="form-group">
                <label for="cliente_comuna">Comuna:</label>
                <input type="text" id="cliente_comuna" name="cliente_comuna" 
                    placeholder="comuna" 
                    value="<?php echo htmlspecialchars($cliente_comuna); ?>">
            </div>
            <div class="form-group">
                <label for="cliente_ciudad">Ciudad:</label>
                <input type="text" id="cliente_ciudad" name="cliente_ciudad" 
                    placeholder="ciudad" 
                    value="<?php echo htmlspecialchars($cliente_ciudad); ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="cliente_tipo">Tipo:</label>
            <select id="cliente_tipo" name="cliente_tipo" required>
                <option value="" disabled selected>Selecciona un tipo de cliente</option>
                <option value="persona_natural" <?php echo ($cliente_tipo == 'persona_natural') ? 'selected' : ''; ?>>Persona Natural</option>
                <option value="empresa" <?php echo ($cliente_tipo == 'empresa') ? 'selected' : ''; ?>>Empresa</option>
                <option value="organizacion_sin_fines_de_lucro" <?php echo ($cliente_tipo == 'organizacion_sin_fines_de_lucro') ? 'selected' : ''; ?>>Organización Sin Fines de Lucro</option>
                <option value="institucion_gubernamental" <?php echo ($cliente_tipo == 'institucion_gubernamental') ? 'selected' : ''; ?>>Institución Gubernamental</option>
                <option value="institucion_educativa" <?php echo ($cliente_tipo == 'institucion_educativa') ? 'selected' : ''; ?>>Institución Educativa</option>
                <option value="multinacional" <?php echo ($cliente_tipo == 'multinacional') ? 'selected' : ''; ?>>Multinacional</option>
            </select>
        </div>
    </div>
</fieldset>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Traer cliente .PHP ----------------------------------------
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
