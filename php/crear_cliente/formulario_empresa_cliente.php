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
    ------------------------------------- INICIO ITred Spa crear empresa_cliente.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
<head> 
    <!-- Define la codificación de caracteres como UTF-8 para asegurar la correcta visualización de caracteres especiales y diversos idiomas -->
    <meta charset="UTF-8"> 
    <!-- Configura la vista en dispositivos móviles. width=device-width asegura que el ancho de la página se ajuste al ancho de la pantalla del dispositivo, y initial-scale=1.0 establece el nivel de zoom inicial -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <!-- Define el título de la página que se muestra en la pestaña del navegador -->
    <title>Formulario Para Agregar empresa_cliente</title> 
    <!-- Enlaza una hoja de estilo externa que se encuentra en la ruta especificada para estilizar el contenido de la página -->
    <link rel="STYLESHEET" href="../../css/crear_cliente/formulario_empresa_cliente.css"> 
    <!-- Cierra el elemento de cabecera -->
</head> 

<!-- TÍTULO: FORMULARIO DE DATOS DE LA EMPRESA DEL CLIENTE -->

<!-- TÍTULO: CAMPO PARA EL RUT DE LA EMPRESA DEL CLIENTE -->
    <div class="form-group">
        <label for="rut_empresa_cliente">RUT:</label>
        <input type="text" id="rut_empresa_cliente" name="rut_empresa_cliente" required placeholder="XX.XXX.XXX-X" 
            oninput="formatoRut(this)" maxlength="12">
        <span id="error_rut" style="color: red; display: none;">Formato inválido. Ejemplo: 12.345.678-9</span>
    </div>

<!-- TÍTULO: CAMPO PARA EL NOMBRE DE LA EMPRESA DEL CLIENTE -->
    <div class="form-group">
        <label for="nombre_empresa_cliente">Nombre / Razon Social:</label>
        <input type="text" id="nombre_empresa_cliente" name="nombre_empresa_cliente" required placeholder="Ingrese el Razon Social de la empresa" oninput="validarNombre()">
        <span id="error_nombre" style="color: red; display: none;">Solo se permiten letras.</span>
    </div>

<!-- TÍTULO: CAMPO PARA EL TELÉFONO DE LA EMPRESA DEL CLIENTE -->
    <div class="form-group">
        <label for="telefono_empresa_cliente">Teléfono o celular:</label>
        <!-- Título: Espacio para mostrar la bandera del país -->
        <img id="flag_empresa_cliente" style="display:none; width: 32px; height: 32px;" alt="Bandera">
        <input type="text" id="telefono_empresa_cliente" name="telefono_empresa_cliente" placeholder="+56992389984" oninput="asegurarMasYDetectarPais1(this)">
    </div>

<!-- TÍTULO: CAMPO PARA EL EMAIL DE LA EMPRESA DEL CLIENTE -->
    <div class="form-group">
        <label for="email_empresa_cliente">Email:</label>
        <input type="email" id="email_empresa_cliente" name="email_empresa_cliente" placeholder="Ingrese el email" required oninput="validarEmailEmpresa(this)">
        <span id="mensaje_error_email_empresa" style="color: red; display: none;"></span>
    </div>

<!-- TÍTULO: CAMPO PARA EL GIRO DE LA EMPRESA DEL CLIENTE -->
    <div class="form-group">
        <label for="giro_empresa_cliente">Giro:</label>
        <select id="giro_empresa_cliente" name="giro_empresa_cliente" required>
            <option value="" disabled selected>Seleccione el giro de la empresa</option>
            
            <!-- TÍTULO: OPCIONES DE GIRO POR CATEGORÍAS -->
                <optgroup label="A">
                    <option value="Agricultura">Agricultura</option>
                    <option value="Artes y Cultura">Artes y Cultura</option>
                    <option value="Automotriz">Automotriz</option>
                </optgroup>
                
                <optgroup label="C">
                    <option value="Comercio">Comercio</option>
                    <option value="Comercio Electrónico">Comercio Electrónico</option>
                    <option value="Construcción">Construcción</option>
                    <option value="Construcción Civil">Construcción Civil</option>
                    <option value="Construcción de Infraestructura">Construcción de Infraestructura</option>
                    <option value="Cuidado de la Salud">Cuidado de la Salud</option>
                    <option value="Cuidado Personal">Cuidado Personal</option>
                    <option value="Consultoría">Consultoría</option>
                </optgroup>

                <optgroup label="D">
                    <option value="Desarrollo de Software">Desarrollo de Software</option>
                </optgroup>

                <optgroup label="E">            
                    <option value="E-commerce">E-commerce</option>
                    <option value="Energía">Energía</option>
                    <option value="Entretenimiento">Entretenimiento</option>
                    <option value="Exportación">Exportación</option>
                </optgroup>

                <optgroup label="F">    
                    <option value="Fabricación">Fabricación</option>
                    <option value="Finanzas">Finanzas</option>
                    <option value="Franquicias">Franquicias</option>
                </optgroup>

                <optgroup label="H">
                    <option value="Hostelería">Hostelería</option>
                </optgroup>

                <optgroup label="I">
                    <option value="Industria">Industria</option>
                    <option value="Investigación y Desarrollo">Investigación y Desarrollo</option>
                </optgroup>

                <optgroup label="L">
                    <option value="Logística">Logística</option>
                </optgroup>

                <optgroup label="M">
                    <option value="Mantenimiento">Mantenimiento</option>
                    <option value="Maquinaria y Equipos">Maquinaria y Equipos</option>
                    <option value="Medios de Comunicación">Medios de Comunicación</option>
                </optgroup>

                <optgroup label="O">
                    <option value="Publicidad">OTRO</option>
                </optgroup>

                <optgroup label="P">
                    <option value="Publicidad">Publicidad</option>
                </optgroup>

                <optgroup label="R">     
                    <option value="Recursos Humanos">Recursos Humanos</option>
                    <option value="Restauración">Restauración</option>
                </optgroup>    

                <optgroup label="S">    
                    <option value="Servicios">Servicios</option>
                    <option value="Servicios Ambientales">Servicios Ambientales</option>
                    <option value="Servicios Financieros">Servicios Financieros</option>
                    <option value="Servicios de Diseño">Servicios de Diseño</option>
                </optgroup>

                <optgroup label="T">
                    <option value="Tecnologías de la Información">Tecnologías de la Información</option>
                    <option value="Telecomunicaciones">Telecomunicaciones</option>
                    <option value="Transporte">Transporte</option>
                    <option value="Turismo">Turismo</option>
                </optgroup>
        </select>
        <span id="mensaje_error_giro" style="color: red; display: none;"></span>
    </div>

<!-- TÍTULO: CAMPO PARA EL TIPO DE LA EMPRESA DEL CLIENTE -->
    <div class="form-group">
        <label for="tipo_empresa_cliente">Tipo:</label>
        <select id="tipo_empresa_cliente" name="tipo_empresa_cliente" onchange="validarTipo(this)">
            <option value="">Seleccione el tipo de empresa</option>
            <option value="Pequeña">Pequeña</option>
            <option value="Mediana">Mediana</option>
            <option value="Grande">Grande</option>
            <option value="Startup">Startup</option>
            <option value="Corporación">Corporación</option>
            <option value="Multinacional">Multinacional</option>
            <option value="Gobierno">Gobierno</option>
            <option value="ONG">ONG</option>
        </select>
        <span id="mensaje_error_tipo" style="color: red; display: none;"></span>
    </div>

<!-- TÍTULO: CAMPO PARA EL LUGAR DE LA EMPRESA DEL CLIENTE -->
    <div class="form-group">
        <label for="lugar_empresa_cliente">Lugar:</label>
        <select id="lugar_empresa_cliente" name="lugar_empresa_cliente" onchange="validarLugar(this)">
            <option value="">Seleccione el lugar de la empresa</option>
            <option value="Casa">Casa</option>
            <option value="Oficina">Oficina</option>
            <option value="Co-working">Co-working</option>
            <option value="Edificio Corporativo">Edificio Corporativo</option>
            <option value="Local Comercial">Local Comercial</option>
            <option value="Planta Industrial">Planta Industrial</option>
            <option value="Otro">Otro</option>
        </select>
        <span id="mensaje_error_lugar" style="color: red; display: none;"></span>
    </div>

<!-- TÍTULO: CAMPO PARA LA CIUDAD DE LA EMPRESA DEL CLIENTE -->
    <div class="form-group">
        <label for="ciudad_empresa_cliente">Ciudad:</label>
        <input type="text" id="ciudad_empresa_cliente" name="ciudad_empresa_cliente" placeholder="Ingrese la ciudad" oninput="validarCiudad(this)">
        <span id="mensaje_error_ciudad" style="color: red; display: none;"></span>
    </div>

<!-- TÍTULO: CAMPO PARA LA COMUNA DE LA EMPRESA DEL CLIENTE -->
    <div class="form-group">
        <label for="comuna_empresa_cliente">Comuna:</label>
        <input type="text" id="comuna_empresa_cliente" name="comuna_empresa_cliente" placeholder="Ingrese la comuna" oninput="validarComuna(this)">
        <span id="mensaje_error_comuna" style="color: red; display: none;"></span>
    </div>

<!-- TÍTULO: CAMPO PARA LA DIRECCIÓN DE LA EMPRESA DEL CLIENTE -->
    <div class="form-group">
        <label for="direccion_empresa_cliente">Dirección:</label>
        <input type="text" id="direccion_empresa_cliente" name="direccion_empresa_cliente" placeholder="Ingrese la dirección" oninput="formatoDireccion(this)">
        <span id="error_direccion" style="color: red; display: none;">La dirección solo puede contener letras y números.</span>
    </div>

<!-- TÍTULO: CAMPO PARA OBSERVACIÓN EXTRA DE LA EMPRESA DEL CLIENTE -->
    <div class="form-group">
        <label for="observacion">Observación extra:</label>
        <input type="text" id="observacion" name="observacion" placeholder="Observación opcional de empresa/cliente" oninput="validarObservacion(this)">
        <span id="error_observacion" style="color: red; display: none;">La observación solo puede contener letras y números.</span>
    </div>

<script src="../../js/crear_cliente/formulario_empresa_cliente.js"></script> 


 
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa crear empresa_cliente .PHP ----------------------------------------
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