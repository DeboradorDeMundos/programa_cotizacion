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
    <link rel="stylesheet" href="../../css/crear_cliente/formulario_empresa_cliente.css"> 
    <!-- Cierra el elemento de cabecera -->
</head> 

<!-- Campo para el RUT de la empresa del _cliente 1 -->
<div class="form-group">
    <label for="rut_empresa_cliente">RUT:</label>
    <input type="text" id="rut_empresa_cliente" name="rut_empresa_cliente" required placeholder="XX.XXX.XXX-X" 
           oninput="formatoRut(this)" maxlength="12">
    <span id="error_rut" style="color: red; display: none;">Formato inválido. Ejemplo: 12.345.678-9</span>
</div>

<!-- Campo para el Nombre de la empresa del cliente -->
<div class="form-group">
    <label for="nombre_empresa_cliente">Nombre / Razon Social:</label>
    <input type="text" id="nombre_empresa_cliente" name="nombre_empresa_cliente" required placeholder="Ingrese el Razon Social de la empresa" oninput="validarNombre()">
    <span id="error_nombre" style="color: red; display: none;">Solo se permiten letras.</span>
</div>

<!-- Campo para el teléfono de la empresa del _cliente 3-->
<div class="form-group">
    <label for="telefono_empresa_cliente">Teléfono o celular:</label>
    <input type="text" id="telefono_empresa_cliente" name="telefono_empresa_cliente" placeholder="+56992389984" pattern="^\d{7,15}$">
</div>
<!-- Campo para el email de la empresa del _cliente 4 -->
<div class="form-group">
    <label for="email_empresa_cliente">Email:</label>
    <input type="email" id="email_empresa_cliente" name="email_empresa_cliente" placeholder="Ingrese el email" required>
</div>
<!-- Campo para el giro de la empresa del _cliente 5 -->
<div class="form-group">
    <label for="giro_empresa_cliente">Giro:</label>
    <input type="text" id="giro_empresa_cliente" name="giro_empresa_cliente" placeholder="Ingrese el giro de la empresa ">
</div>
<!-- Campo para el tipo de la empresa del _cliente 6-->
<div class="form-group">
    <label for="tipo_empresa_cliente">Tipo:</label>
    <input type="text" id="tipo_empresa_cliente" name="tipo_empresa_cliente" placeholder="Ingrese el tipo de empresa">
</div>
<!-- Campo para la ciudad de la empresa del _cliente  7-->
<div class="form-group">
    <label for="ciudad_empresa_cliente">Ciudad :</label>
    <input type="text" id="ciudad_empresa_cliente" name="ciudad_empresa_cliente" placeholder="Ingrese la ciudad ">
</div>
<!-- Campo para la comuna de la empresa del _cliente 8 -->
<div class="form-group">
    <label for="comuna_empresa_cliente">Comuna:</label>
    <input type="text" id="comuna_empresa_cliente" name="comuna_empresa_cliente" placeholder="Ingrese la comuna ">
</div>
<!-- Campo para la dirección de la empresa del _cliente 9 -->
<div class="form-group">
    <label for="direccion_empresa_cliente">Dirección:</label>
    <input type="text" id="direccion_empresa_cliente" name="direccion_empresa_cliente" placeholder="Ingrese la dirección" oninput="formatoDireccion(this)">
    <span id="error_direccion" style="color: red; display: none;">La dirección solo puede contener letras y números.</span>
</div>
<!-- Campo para el lugar de la empresa del _cliente 10 -->
<div class="form-group">
    <label for="observacion">Observacion extra:</label>
    <input type="text" id="observacion" name="observacion" placeholder="OPCIONAL: INGRESE ALGUN TIPO DE OBSERVACION O COMENTARIO DE LA EMPRESA">
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