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
    ------------------------------------- INICIO ITred Spa Traer cliente .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->
<?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'ITredSpa_bd');
?>
<!-- ---------------------
// FIN CONEXION BD --
// --------------------- -->

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
<fieldset class="row">
    <legend>Detalle cliente</legend>
    <div class="box-6 data-box">
        <div class="form-group-inline">
            <div class="form-group">
                <label for="cliente_nombre">Nombre:</label>
                <input type="text" id="cliente_nombre" name="cliente_nombre" 
                    placeholder="nombre cliente" 
                    value="<?php echo htmlspecialchars($cliente_nombre); ?>" 
                    required>
            </div>
        </div>

        <div class="form-group">
            <label for="cliente_empresa">Empresa:</label>
            <input type="text" id="cliente_empresa" name="cliente_empresa" 
                placeholder="cliente empresa" 
                value="<?php echo htmlspecialchars($cliente_empresa); ?>">
        </div>

        <div class="form-group-inline">
            <div class="form-group">
                <label for="cliente_direccion">Dirección:</label>
                <input type="text" id="cliente_direccion" name="cliente_direccion" 
                    placeholder="pasaje x #1234" 
                    value="<?php echo htmlspecialchars($cliente_direccion); ?>">
            </div>
            <div class="form-group">
                <label for="cliente_lugar">Lugar:</label>
                <input type="text" id="cliente_lugar" name="cliente_lugar" 
                    placeholder="casa/Oficina" 
                    value="<?php echo htmlspecialchars($cliente_lugar); ?>">
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
    <div class="box-6 data-box data-box-left">
        <div class="form-group">
            <label for="cliente_email">Email:</label>
            <input type="email" id="cliente_email" name="cliente_email" 
                placeholder="cliente@gmail.com" 
                value="<?php echo htmlspecialchars($cliente_email); ?>">
        </div>

        <div class="form-group">
            <label for="cliente_cargo">Cargo:</label>
            <input type="text" id="cliente_cargo" name="cliente_cargo" 
                placeholder="cargo cliente" 
                value="<?php echo htmlspecialchars($cliente_cargo); ?>">
        </div>

        <div class="form-group">
            <label for="cliente_giro">Giro:</label>
            <input type="text" id="cliente_giro" name="cliente_giro" 
                placeholder="giro cliente" 
                value="<?php echo htmlspecialchars($cliente_giro); ?>">
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
            <input type="text" id="cliente_tipo" name="cliente_tipo" 
                placeholder="tipo cliente" 
                value="<?php echo htmlspecialchars($cliente_tipo); ?>">
        </div>
    </div>
</fieldset>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Traer cliente .PHP ----------------------------------------
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
