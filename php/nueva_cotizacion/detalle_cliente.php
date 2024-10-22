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
    ------------------------------------- INICIO ITred Spa Detalle cliente.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->



<link rel="stylesheet" href="../../css/nueva_cotizacion/detalle_cliente.css">
<fieldset class="row"> <!-- Crea una fila PARA organizar los elementos en una disposición horizontal -->
    <!-- TÍTULO: DATOS EMPRESA CLIENTE -->
    <legend>Datos empresa cliente </legend>
    <div class="box-6 cuadro-datos"> <!-- Crea una caja PARA ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
        <div class="form-group-inline">
            <div class="form-group">
                <!-- TÍTULO: CAMPO PARA EL RUT DE LA EMPRESA -->
                <label for="cliente_rut">RUT Empresa: </label> <!-- Etiqueta PARA el campo de entrada del RUT del cliente -->
                <!-- TÍTULO: CAMPO PARA INGRESAR EL RUT DEL CLIENTE -->
                <input type="text" id="cliente_rut" name="cliente_rut" 
                    minlength="7" maxlength="12" 
                    placeholder="Ej: 12.345.678-9"
                    oninput="FormatearRut(this)"
                    oninput="QuitarCaracteresInvalidos(this)"
                    required> <!-- Campo de texto PARA ingresar el RUT del cliente. También es obligatorio -->
            </div>

            <div class="form-group">
                <!-- TÍTULO: CAMPO PARA EL NOMBRE DEL REPRESENTANTE -->
                <label for="cliente_nombre">Nombre representante:</label> <!-- Etiqueta PARA el campo de entrada del nombre del cliente -->
                <!-- TÍTULO: CAMPO PARA INGRESAR EL NOMBRE DEL CLIENTE -->
                <input type="text" id="cliente_nombre" name="cliente_nombre" required
                    pattern="^[A-Za-zÀ-ÿ0-9\s&.-]+$" 
                    title="Por favor, ingrese solo letras, números y caracteres como &,-."
                    oninput="QuitarCaracteresInvalidos(this)"
                    placeholder="Ejemplo: Pedro Perez"> <!-- Campo de texto PARA ingresar el nombre del cliente. El atributo "required" hace que el campo sea obligatorio -->
            </div>
        </div>

        <div class="form-group">
            <!-- TÍTULO: CAMPO PARA LA EMPRESA DEL CLIENTE -->
            <label for="cliente_empresa">Empresa:</label> <!-- Etiqueta PARA el campo de entrada de la empresa del cliente -->
            <!-- TÍTULO: CAMPO PARA INGRESAR EL NOMBRE DE LA EMPRESA DEL CLIENTE -->
            <input type="text" id="cliente_empresa" name="cliente_empresa" required minlength="3" maxlength="100"
                pattern="^[A-Za-zÀ-ÿ0-9\s&.-]+$" 
                title="Por favor, ingrese solo letras, números y caracteres como &,-."
                oninput="QuitarCaracteresInvalidos(this)"
                placeholder="Ejemplo: Mi Empresa S.A."> <!-- Campo de texto PARA ingresar el nombre de la empresa del cliente. Este campo no es obligatorio -->
        </div>

        <div class="form-group-inline">
            <div class="form-group">
                <!-- TÍTULO: CAMPO PARA LA DIRECCIÓN DEL CLIENTE -->
                <label for="cliente_direccion">Dirección:</label> <!-- Etiqueta PARA el campo de entrada de la dirección del cliente -->
                <!-- TÍTULO: CAMPO PARA INGRESAR LA DIRECCIÓN DEL CLIENTE -->
                <input type="text" id="cliente_direccion" name="cliente_direccion"
                    minlength="5" maxlength="100" 
                    pattern="^[A-Za-z0-9À-ÿ\s#,-.]*$" 
                    oninput="QuitarCaracteresInvalidos(this)"
                    title="Por favor, ingrese una dirección válida. Se permiten letras, números, espacios y los caracteres #, -, , y .."
                    placeholder="Ejemplo: Av. Siempre Viva 742"> <!-- Campo de texto PARA ingresar la dirección del cliente. No es obligatorio -->
            </div>
            <div class="form-group">
                <!-- TÍTULO: CAMPO PARA EL LUGAR DEL CLIENTE -->
                <label for="cliente_lugar">Lugar:</label> <!-- Etiqueta PARA el campo de selección del lugar del cliente -->
                <!-- TÍTULO: CAMPO PARA SELECCIONAR EL LUGAR DEL CLIENTE -->
                <select id="cliente_lugar" name="cliente_lugar" required> <!-- Campo de selección PARA el lugar del cliente. Este campo es obligatorio -->
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
            <!-- Título: Campo PARA el Teléfono del Cliente -->
            <label for="cliente_fono" style="margin-right: 10px;">Teléfono:</label> <!-- Etiqueta PARA el campo de entrada del teléfono del cliente -->
            
            <!-- Título: Imagen de la Bandera -->
            <!-- Imagen de la bandera -->
            <img id="flag_cliente" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/Flag_of_None.svg/32px-Flag_of_None.svg.png" 
                 alt="Bandera" style="display: none; margin-right: 10px;" width="32" height="20">

            <!-- Título: Campo PARA Ingresar el Teléfono del Cliente -->
            <!-- Campo de entrada de texto -->
            <input type="text" id="cliente_fono" name="cliente_fono"
                   placeholder="+56 9 1234 1234" 
                   maxlength="14" 
                   required 
                   title="Formato válido: +56 9 1234 1234 (código de país, seguido de número)" 
                   oninput="asegurarMasYDetectarPais1(this)">
        </div>
    </div>
    
    <div class="box-6 cuadro-datos cuadro-datos-left"> <!-- Crea otra caja PARA ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "cuadro-datos-left" PARA estilo -->
        <div class="form-group">
            <!-- TÍTULO: CA/MPO PARA EL RUT DEL ENCARGADO -->
            <label for="rut_encargado_cliente">RUT Encargado: </label> <!-- Etiqueta PARA el campo de entrada del RUT del cliente -->
            <!-- Título: Campo PARA Ingresar el RUT del Encargado -->
            <input type="text" id="rut_encargado_cliente" name="rut_encargado_cliente" 
                minlength="7" maxlength="12" 
                placeholder="Ej: 12.345.678-9"
                oninput="FormatearRut(this)"
                oninput="QuitarCaracteresInvalidos(this)"
                required> <!-- Campo de texto PARA ingresar el RUT del cliente. También es obligatorio -->
        </div>
        
        <div class="form-group">
            <!-- Título: Campo PARA el Email del Cliente -->
            <label for="cliente_email">Email:</label> <!-- Etiqueta PARA el campo de entrada del email del cliente -->
            <!-- Título: Campo PARA Ingresar el Email del Cliente -->
            <input type="email" id="cliente_email" name="cliente_email"
                placeholder="ejemplo@gmail.com" 
                maxlength="255" 
                required 
                title="Ingresa un correo electrónico válido, como ejemplo@empresa.com" 
                oninput="QuitarCaracteresInvalidos(this)"
                onblur="CompletarEmail(this)"> <!-- Campo de correo electrónico PARA ingresar el email del cliente. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
        </div>

        <div class="form-group">
            <!-- TÍTULO: CAMPO PARA EL CARGO DEL CLIENTE -->
            <label for="cliente_cargo">Cargo:</label> <!-- Etiqueta PARA el campo de selección del cargo del cliente -->
            <!-- TÍTULO: CAMPO PARA SELECCIONAR EL CARGO DEL CLIENTE -->
            <select id="cliente_cargo" name="cliente_cargo" required> <!-- Campo de selección PARA el cargo del cliente. Este campo es obligatorio -->
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
    </div>
</fieldset>

<div class="form-group">
    <!-- TÍTULO: CAMPO PARA EL GIRO DEL CLIENTE -->
    <label for="cliente_giro">Giro:</label> <!-- Etiqueta PARA el campo de selección del giro del cliente -->
    <!-- TÍTULO: CAMPO PARA SELECCIONAR EL GIRO DEL CLIENTE -->
    <select id="cliente_giro" name="cliente_giro" required> <!-- Campo de selección PARA el giro del cliente. Este campo es obligatorio -->
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
        <!-- TÍTULO: CAMPO PARA LA COMUNA DEL CLIENTE -->
        <label for="cliente_comuna">Comuna:</label> <!-- Etiqueta PARA el campo de entrada de la comuna del cliente -->
        <!-- TÍTULO: CAMPO PARA INGRESAR LA COMUNA DEL CLIENTE -->
        <input type="text" id="cliente_comuna" name="cliente_comuna" 
            placeholder="Ej: La Reina, Providencia" 
            required 
            minlength="3" 
            maxlength="50" 
            pattern="^[a-zA-ZÀ-ÿ\s]+$" 
            oninput="QuitarCaracteresInvalidos(this)"
            title="Ingresa una comuna válida (Ej: La Reina, Providencia). Solo se permiten letras y espacios."> <!-- Campo de texto PARA ingresar la comuna del cliente. Este campo no es obligatorio -->
    </div>
    <div class="form-group">
        <!-- TÍTULO: CAMPO PARA LA CIUDAD DEL CLIENTE -->
        <label for="cliente_ciudad">Ciudad:</label> <!-- Etiqueta PARA el campo de entrada de la ciudad del cliente -->
        <!-- TÍTULO: CAMPO PARA INGRESAR LA CIUDAD DEL CLIENTE -->
        <input type="text" id="cliente_ciudad" name="cliente_ciudad" 
            placeholder="Ej: Santiago, Valparaíso" 
            required 
            minlength="3" 
            maxlength="50" 
            pattern="^[a-zA-ZÀ-ÿ\s]+$" 
            oninput="QuitarCaracteresInvalidos(this)"
            title="Ingresa una ciudad válida (Ej: Santiago, Valparaíso). Solo se permiten letras y espacios."> <!-- Campo de texto PARA ingresar la ciudad del cliente. Este campo no es obligatorio -->
    </div>
</div>

<div class="form-group">
    <!-- TÍTULO: CAMPO PARA EL TIPO DE CLIENTE -->
    <label for="cliente_tipo">Tipo:</label> <!-- Etiqueta PARA el campo de selección del tipo de cliente -->
    <!-- TÍTULO: CAMPO PARA SELECCIONAR EL TIPO DE CLIENTE -->
    <select id="cliente_tipo" name="cliente_tipo" required> <!-- Campo de selección PARA el tipo de cliente. Este campo es obligatorio -->
        <option value="" disabled selected>Selecciona un tipo de cliente</option> <!-- Opción por defecto -->
        <option value="persona_natural">Persona Natural</option>
        <option value="empresa">Empresa</option>
        <option value="organizacion_sin_fines_de_lucro">Organización Sin Fines de Lucro</option>
        <option value="institucion_gubernamental">Institución Gubernamental</option>
        <option value="institucion_educativa">Institución Educativa</option>
        <option value="multinacional">Multinacional</option>
    </select>
</div>
<script src="../../js/nueva_cotizacion/detalle_cliente.js"></script> 

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // datos de la empresa 
    $rut_empresa_cliente = isset($_POST['cliente_rut']) ? $_POST['cliente_rut'] : null;
    $nombre_empresa_cliente = isset($_POST['cliente_empresa']) ? $_POST['cliente_empresa'] : null;
    $direccion_empresa_cliente = isset($_POST['cliente_direccion']) ? $_POST['cliente_direccion'] : null;
    $lugar_empresa_cliente = isset($_POST['cliente_lugar']) ? $_POST['cliente_lugar'] : null;
    $telefono_empresa_cliente = isset($_POST['cliente_fono']) ? $_POST['cliente_fono'] : null;
    $email_empresa_cliente = isset($_POST['cliente_email']) ? $_POST['cliente_email'] : null;
    $giro_empresa_cliente = isset($_POST['cliente_giro']) ? $_POST['cliente_giro'] : null;
    $comuna_empresa_cliente = isset($_POST['cliente_comuna']) ? $_POST['cliente_comuna'] : null;
    $ciudad_empresa_cliente = isset($_POST['cliente_ciudad']) ? $_POST['cliente_ciudad'] : null;
    $tipo_empresa_cliente = isset($_POST['cliente_tipo']) ? $_POST['cliente_tipo'] : null;
    //datos del encargado
    $rut_encargado_cliente = isset($_POST['rut_encargado_cliente']) ? $_POST['rut_encargado_cliente'] : null;
    $nombre_encargado_cliente = isset($_POST['cliente_nombre']) ? trim($_POST['cliente_nombre']) : null;
    $cargo_encargado_cliente = isset($_POST['cliente_cargo']) ? $_POST['cliente_cargo'] : null;
 
    

    // Campos no recibidos en el formulario que se dejarán en null
    $observacion = null;
    $direccion_encargado_cliente = null;
    $telefono_encargado_cliente = null;
    $comuna_encargado_cliente = null;
    $ciudad_encargado_cliente = null;

    if ($nombre_encargado_cliente && $rut_encargado_cliente) {
        // Insertar o actualizar el cliente
        $sql = "INSERT INTO C_Clientes (
            id_empresa_creadora, 
            rut_empresa_cliente, 
            nombre_empresa_cliente, 
            telefono_empresa_cliente, 
            email_empresa_cliente, 
            giro_empresa_cliente, 
            tipo_empresa_cliente, 
            lugar_empresa_cliente, 
            ciudad_empresa_cliente, 
            comuna_empresa_cliente, 
            direccion_empresa_cliente, 
            observacion, 
            rut_encargado_cliente, 
            nombre_encargado_cliente, 
            direccion_encargado_cliente, 
            telefono_encargado_cliente, 
            email_encargado_cliente, 
            cargo_encargado_cliente, 
            comuna_encargado_cliente, 
            ciudad_encargado_cliente
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
   
   $stmt = $mysqli->prepare($sql);
   $stmt->bind_param(
       'isssssssssssssssssss',
       $id, 
       $rut_empresa_cliente, 
       $nombre_empresa_cliente, 
       $telefono_empresa_cliente, 
       $email_empresa_cliente, 
       $giro_empresa_cliente, 
       $tipo_empresa_cliente, 
       $lugar_empresa_cliente, 
       $ciudad_empresa_cliente, 
       $comuna_empresa_cliente, 
       $direccion_empresa_cliente, 
       $observacion, 
       $rut_encargado_cliente, 
       $nombre_encargado_cliente, 
       $direccion_encargado_cliente, 
       $telefono_encargado_cliente, 
       $email_encargado_cliente, 
       $cargo_encargado_cliente, 
       $comuna_encargado_cliente, 
       $ciudad_encargado_cliente
   );
   
   if ($stmt->execute()) {
       echo "Cliente creado exitosamente.";
       // Obtiene el ID de la empresa insertada/actualizada
        $id_cliente = $mysqli->insert_id;
        echo "Cliente insertada/actualizada. ID: $id_cliente<br>";
   } else {
       echo "Error al crear el cliente: " . $stmt->error;
   }
    }};   
?>





     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Detalle cliente.PHP ----------------------------------------
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
