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



<link rel="stylesheet" href="../../css/nueva_cotizacion/detalle_cliente.css">
<fieldset class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
    <legend>Datos cliente</legend>
    <div class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
        <div class="form-group-inline">
            <div class="form-group">
                <label for="cliente_rut">RUT: </label> <!-- Etiqueta para el campo de entrada del RUT del cliente -->
                <input type="text" id="cliente_rut" name="cliente_rut" 
                    minlength="7" maxlength="12" 
                    placeholder="Ej: 12.345.678-9"
                    required oninput="formatRut(this)"> <!-- Campo de texto para ingresar el RUT del cliente. También es obligatorio -->
            </div>
            <div class="form-group">
                <label for="cliente_nombre">Nombre:</label> <!-- Etiqueta para el campo de entrada del nombre del cliente -->
                <input type="text" id="cliente_nombre" name="cliente_nombre" required
                    pattern="^[A-Za-zÀ-ÿ0-9\s&.-]+$" 
                    title="Por favor, ingrese solo letras, números y caracteres como &,-."
                    placeholder="Ejemplo: Pedro Perez"> <!-- Campo de texto para ingresar el nombre del cliente. El atributo "required" hace que el campo sea obligatorio -->
            </div>
        </div>

        <div class="form-group">
            <label for="cliente_empresa">Empresa:</label> <!-- Etiqueta para el campo de entrada de la empresa del cliente -->
            <input type="text" id="cliente_empresa" name="cliente_empresa" required minlength="3" maxlength="100"
                pattern="^[A-Za-zÀ-ÿ0-9\s&.-]+$" 
                title="Por favor, ingrese solo letras, números y caracteres como &,-."
                placeholder="Ejemplo: Mi Empresa S.A."> <!-- Campo de texto para ingresar el nombre de la empresa del cliente. Este campo no es obligatorio -->
        </div>

        <div class="form-group-inline">
            <div class="form-group">
                <label for="cliente_direccion">Dirección:</label> <!-- Etiqueta para el campo de entrada de la dirección del cliente -->
                <input type="text" id="cliente_direccion" name="cliente_direccion"
                    minlength="5" maxlength="100" 
                    pattern="^[A-Za-z0-9À-ÿ\s#,-.]*$" 
                    title="Por favor, ingrese una dirección válida. Se permiten letras, números, espacios y los caracteres #, -, , y .."
                    placeholder="Ejemplo: Av. Siempre Viva 742"> <!-- Campo de texto para ingresar la dirección del cliente. No es obligatorio -->
            </div>
            <div class="form-group">
                <label for="cliente_lugar">Lugar:</label> <!-- Etiqueta para el campo de selección del lugar del cliente -->
                <select id="cliente_lugar" name="cliente_lugar" required> <!-- Campo de selección para el lugar del cliente. Este campo es obligatorio -->
                    <option value="" disabled selected>Selecciona un lugar</option> <!-- Opción por defecto -->
                    <option value="casa">Casa</option>
                    <option value="oficina">Oficina</option>
                    <option value="local_comercial">Local Comercial</option>
                    <option value="almacen">Almacén</option>
                    <option value="bodega">Bodega</option>
                    <option value="fabrica">Fábrica</option>
                </select>
            </div>
        </div>

        <div class="form-group" style="display: flex; align-items: center;">
    <label for="cliente_fono" style="margin-right: 10px;">Teléfono:</label> <!-- Etiqueta para el campo de entrada del teléfono del cliente -->
    
    <!-- Imagen de la bandera -->
    <img id="flag_cliente" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/Flag_of_None.svg/32px-Flag_of_None.svg.png" 
         alt="Bandera" style="display: none; margin-right: 10px;" width="32" height="20">

    <!-- Campo de entrada de texto -->
    <input type="text" id="cliente_fono" name="cliente_fono"
           placeholder="+56 9 1234 1234" 
           maxlength="13" 
           required 
           pattern="^\+\d{2}\s\d{1}\s\d{4}\s\d{4}$" 
           title="Formato válido: +56 9 1234 1234 (código de país, seguido de número)" oninput="asegurarMasYDetectarPais(this)">
</div>



    </div>
    <div class="box-6 data-box data-box-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "data-box-left" para estilo -->
        
        <div class="form-group">
            <label for="cliente_email">Email:</label> <!-- Etiqueta para el campo de entrada del email del cliente -->
            <input type="email" id="cliente_email" name="cliente_email"
                placeholder="ejemplo@gmail.com" 
                maxlength="255" 
                required 
                title="Ingresa un correo electrónico válido, como ejemplo@empresa.com" 
                onblur="completeEmail(this)"> <!-- Campo de correo electrónico para ingresar el email del cliente. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
        </div>

        <div class="form-group">
            <label for="cliente_cargo">Cargo:</label> <!-- Etiqueta para el campo de selección del cargo del cliente -->
            <select id="cliente_cargo" name="cliente_cargo" required> <!-- Campo de selección para el cargo del cliente. Este campo es obligatorio -->
                <option value="" disabled selected>Selecciona un cargo</option> <!-- Opción por defecto -->
                <option value="gerente">Gerente</option>
                <option value="director">Director</option>
                <option value="ejecutivo">Ejecutivo</option>
                <option value="supervisor">Supervisor</option>
                <option value="jefe_area">Jefe de Área</option>
                <option value="coordinador">Coordinador</option>
                <option value="analista">Analista</option>
                <option value="asistente">Asistente</option>
                <option value="consultor">Consultor</option>
                <option value="ingeniero">Ingeniero</option>
                <option value="técnico">Técnico</option>
                <option value="auxiliar">Auxiliar</option>
                <option value="vendedor">Vendedor</option>
                <option value="administrativo">Administrativo</option>
                <option value="recepcionista">Recepcionista</option>
                <option value="operador">Operador</option>
                <option value="contador">Contador</option>
                <option value="encargado_rrhh">Encargado de RRHH</option>
            </select>
        </div>

        <div class="form-group">
            <label for="cliente_giro">Giro:</label> <!-- Etiqueta para el campo de selección del giro del cliente -->
            <select id="cliente_giro" name="cliente_giro" required> <!-- Campo de selección para el giro del cliente. Este campo es obligatorio -->
                <option value="" disabled selected>Selecciona un giro</option> <!-- Opción por defecto -->
                <option value="comercio">Comercio</option>
                <option value="servicios">Servicios</option>
                <option value="manufactura">Manufactura</option>
                <option value="construccion">Construcción</option>
                <option value="tecnologia">Tecnología</option>
                <option value="alimentos_bebidas">Alimentos y Bebidas</option>
                <option value="educacion">Educación</option>
                <option value="salud">Salud</option>
                <option value="finanzas">Finanzas</option>
                <option value="agricultura">Agricultura</option>
                <option value="logistica_transporte">Logística y Transporte</option>
                <option value="inmobiliario">Inmobiliario</option>
                <option value="mineria">Minería</option>
                <option value="energia">Energía</option>
                <option value="turismo">Turismo</option>
                <option value="arte_cultura">Arte y Cultura</option>
            </select>
        </div>

        <div class="form-group-inline">
            <div class="form-group">
                <label for="cliente_comuna">Comuna:</label> <!-- Etiqueta para el campo de entrada de la comuna del cliente -->
                <input type="text" id="cliente_comuna" name="cliente_comuna" 
                    placeholder="Ej: La Reina, Providencia" 
                    required 
                    minlength="3" 
                    maxlength="50" 
                    pattern="^[a-zA-ZÀ-ÿ\s]+$" 
                    title="Ingresa una comuna válida (Ej: La Reina, Providencia). Solo se permiten letras y espacios."> <!-- Campo de texto para ingresar la comuna del cliente. Este campo no es obligatorio -->
            </div>
            <div class="form-group">
                <label for="cliente_ciudad">Ciudad:</label> <!-- Etiqueta para el campo de entrada de la ciudad del cliente -->
                <input type="text" id="cliente_ciudad" name="cliente_ciudad" 
                    placeholder="Ej: Santiago, Valparaíso" 
                    required 
                    minlength="3" 
                    maxlength="50" 
                    pattern="^[a-zA-ZÀ-ÿ\s]+$" 
                    title="Ingresa una ciudad válida (Ej: Santiago, Valparaíso). Solo se permiten letras y espacios."> <!-- Campo de texto para ingresar la ciudad del cliente. Este campo no es obligatorio -->
            </div>
        </div>

        <div class="form-group">
            <label for="cliente_tipo">Tipo:</label> <!-- Etiqueta para el campo de selección del tipo de cliente -->
            <select id="cliente_tipo" name="cliente_tipo" required> <!-- Campo de selección para el tipo de cliente. Este campo es obligatorio -->
                <option value="" disabled selected>Selecciona un tipo de cliente</option> <!-- Opción por defecto -->
                <option value="persona_natural">Persona Natural</option>
                <option value="empresa">Empresa</option>
                <option value="organizacion_sin_fines_de_lucro">Organización Sin Fines de Lucro</option>
                <option value="institucion_gubernamental">Institución Gubernamental</option>
                <option value="institucion_educativa">Institución Educativa</option>
                <option value="multinacional">Multinacional</option>
            </select>
        </div>
    </div>
</fieldset> <!-- Cierra la fila -->
<script src="../../js/nueva_cotizacion/detalle_cliente.js"></script> 
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
