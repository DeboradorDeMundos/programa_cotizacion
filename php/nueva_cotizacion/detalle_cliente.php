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
    ------------------------------------- INICIO ITred Spa Detalle cliente.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->




<fieldset class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
    <legend>Detalle cliente</legend>
    <div class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
        <div class="form-group-inline">
                                    <div class="form-group">
                <label for="cliente_rut">RUT: </label> <!-- Etiqueta para el campo de entrada del RUT del cliente -->
                <input type="text" id="cliente_rut" name="cliente_rut" 
                    minlength="7" maxlength="12" 
                    placeholder="x.xxx.xxx-x"
                    required oninput="formatRut(this)"> <!-- Campo de texto para ingresar el RUT del cliente. También es obligatorio -->
            </div>
            <div class="form-group">
                <label for="cliente_nombre">Nombre:</label> <!-- Etiqueta para el campo de entrada del nombre del cliente -->
                <input type="text" id="cliente_nombre" name="cliente_nombre" placeholder="nombre cliente" required> <!-- Campo de texto para ingresar el nombre del cliente. El atributo "required" hace que el campo sea obligatorio -->
            </div>
        </div>

        <div class="form-group">
            <label for="cliente_empresa">Empresa:</label> <!-- Etiqueta para el campo de entrada de la empresa del cliente -->
            <input type="text" id="cliente_empresa" name="cliente_empresa" placeholder="cliente empresa"> <!-- Campo de texto para ingresar el nombre de la empresa del cliente. Este campo no es obligatorio -->
        </div>

        <div class="form-group-inline">
            <div class="form-group">
                <label for="cliente_direccion">Dirección:</label> <!-- Etiqueta para el campo de entrada de la dirección del cliente -->
                <input type="text" id="cliente_direccion" name="cliente_direccion" placeholder="pasaje x #1234"> <!-- Campo de texto para ingresar la dirección del cliente. No es obligatorio -->
            </div>
            <div class="form-group">
                <label for="cliente_lugar">Lugar:</label> <!-- Etiqueta para el campo de entrada del lugar del cliente -->
                <input type="text" id="cliente_lugar" name="cliente_lugar" placeholder="casa/Oficina"> <!-- Campo de texto para ingresar el lugar del cliente. Este campo no es obligatorio -->
            </div>
        </div>

        <div class="form-group">
            <label for="cliente_fono">Teléfono:</label> <!-- Etiqueta para el campo de entrada del teléfono del cliente -->
            <input type="text" id="cliente_fono" name="cliente_fono" pattern="\+?\d{7,15}" placeholder="+1234567890"> <!-- Campo de texto para ingresar el teléfono del cliente. Este campo no es obligatorio -->
        </div>
    </div>
    <div class="box-6 data-box data-box-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "data-box-left" para estilo -->
        
        <div class="form-group">
            <label for="cliente_email">Email:</label> <!-- Etiqueta para el campo de entrada del email del cliente -->
            <input type="email" id="cliente_email" name="cliente_email" placeholder="cliente@gmail.com"> <!-- Campo de correo electrónico para ingresar el email del cliente. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
        </div>

        <div class="form-group">
            <label for="cliente_cargo">Cargo:</label> <!-- Etiqueta para el campo de entrada del cargo del cliente -->
            <input type="text" id="cliente_cargo" name="cliente_cargo" placeholder="cargo cliente"> <!-- Campo de texto para ingresar el cargo del cliente. Este campo no es obligatorio -->
        </div>

        <div class="form-group">
            <label for="cliente_giro">Giro:</label> <!-- Etiqueta para el campo de entrada del giro del cliente -->
            <input type="text" id="cliente_giro" name="cliente_giro" placeholder="giro cliente"> <!-- Campo de texto para ingresar el giro o sector del cliente. No es obligatorio -->
        </div>

        <div class="form-group-inline">
            <div class="form-group">
                <label for="cliente_comuna">Comuna:</label> <!-- Etiqueta para el campo de entrada de la comuna del cliente -->
                <input type="text" id="cliente_comuna" name="cliente_comuna" placeholder="comuna"> <!-- Campo de texto para ingresar la comuna del cliente. Este campo no es obligatorio -->
            </div>
            <div class="form-group">
                <label for="cliente_ciudad">Ciudad:</label> <!-- Etiqueta para el campo de entrada de la ciudad del cliente -->
                <input type="text" id="cliente_ciudad" name="cliente_ciudad" placeholder="ciudad"> <!-- Campo de texto para ingresar la ciudad del cliente. No es obligatorio -->
            </div>
        </div>

        <div class="form-group">
            <label for="cliente_tipo">Tipo:</label> <!-- Etiqueta para el campo de entrada del tipo de cliente -->
            <input type="text" id="cliente_tipo" name="cliente_tipo" placeholder="tipo cliente"> <!-- Campo de texto para ingresar el tipo de cliente. Este campo no es obligatorio -->
        </div>
    </div>
</fieldset> <!-- Cierra la fila -->

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario cliente
    $cliente_nombre = isset($_POST['cliente_nombre']) ? trim($_POST['cliente_nombre']) : null;
    $cliente_rut = isset($_POST['cliente_rut']) ? $_POST['cliente_rut'] : null;
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

    if ($cliente_nombre && $cliente_rut) {
        // Insertar o actualizar el cliente
        $sql = "INSERT INTO C_Clientes (nombre_cliente, empresa_cliente, rut_cliente, direccion_cliente, lugar_cliente, telefono_cliente, email_cliente, cargo_cliente, giro_cliente, comuna_cliente, ciudad_cliente, tipo_cliente)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
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
        $stmt->bind_param("ssssssssssss", 
            $cliente_nombre, 
            $cliente_empresa, 
            $cliente_rut, 
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
        
        $id_cliente = $mysqli->insert_id;
        echo "Cliente insertado/actualizado. ID: $id_cliente<br>";
    } else {
        echo "Nombre y RUT del cliente son obligatorios.";
    }
}
?>




     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Detalle cliente.PHP ----------------------------------------
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
