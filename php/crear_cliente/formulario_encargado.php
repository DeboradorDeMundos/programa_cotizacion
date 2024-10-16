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
    ------------------------------------- INICIO ITred Spa crear encargado_cliente.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
    <head> 
    <!-- Define la codificación de caracteres como UTF-8 para asegurar la correcta visualización de caracteres especiales y diversos idiomas -->
    <meta charset="UTF-8"> 
    <!-- Configura la vista en dispositivos móviles. width=device-width asegura que el ancho de la página se ajuste al ancho de la pantalla del dispositivo, y initial-scale=1.0 establece el nivel de zoom inicial -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <!-- Define el título de la página que se muestra en la pestaña del navegador -->
    <title>Formulario Encargado de la Empresa (encargado_cliente)</title> 
    <!-- Enlaza una hoja de estilo externa que se encuentra en la ruta especificada para estilizar el contenido de la página -->
    <link rel="stylesheet" href="../../css/crear_cliente/formulario_encargado.css"> 
    <!-- Cierra el elemento de cabecera -->
</head> 

<!-- Campo para el RUT del encargado de la empresa encargado_cliente -->
<div class="form-group">
    <label for="rut_encargado_cliente">RUT:</label>
    <input type="text" id="rut_encargado_cliente" name="rut_encargado_cliente" required placeholder="XX.XXX.XXX-X" 
           oninput="formatoRut(this)" maxlength="12">
    <span id="error_rut" style="color: red; display: none;">Formato inválido. Ejemplo: 12.345.678-9</span>
</div>

<!-- Campo para el Nombre del encargado de la empresa encargado_cliente  -->
<div class="form-group">
    <label for="nombre_encargado_cliente">Nombre Del encargado:</label>
    <input type="text" id="nombre_encargado_cliente" name="nombre_encargado_cliente" required placeholder="Ingrese el nombre y apellido" oninput="validarNombre()">
    <span id="error_nombre" style="color: red; display: none;">Solo se permiten letras.</span>
</div>

<!-- Campo para el teléfono del encargado de la empresa encargado_cliente -->
<div class="form-group">
    <label for="telefono_encargado_cliente">Teléfono o Celular :</label>
    <input type="text" id="telefono_encargado_cliente" name="telefono_encargado_cliente" placeholder="Ingrese el teléfono" pattern="^\d{7,15}$">
</div>

<!-- Campo para el email del encargado de la empresa encargado_cliente -->
<div class="form-group">
    <label for="email_encargado_cliente">Email:</label>
    <input type="email" id="email_encargado_cliente" name="email_encargado_cliente" placeholder="Ingrese el email" required>
</div>

<!-- Campo para el cargo del encargado de la empresa encargado_cliente -->
<div class="form-group">
    <label for="cargo_encargado_cliente">Cargo del encargado:</label>
    <input type="text" id="cargo_encargado_cliente" name="cargo_encargado_cliente" placeholder="Ingrese el cargo">
</div>


<!-- Campo para la ciudad del encargado de la empresa encargado_cliente -->
<div class="form-group">
    <label for="ciudad_encargado_cliente">Ciudad:</label>
    <input type="text" id="ciudad_encargado_cliente" name="ciudad_encargado_cliente" placeholder="Ingrese la ciudad ">
</div>

<!-- Campo para la comuna del encargado de la empresa encargado_cliente -->
<div class="form-group">
    <label for="comuna_encargado_cliente">Comuna:</label>
    <input type="text" id="comuna_encargado_cliente" name="comuna_encargado_cliente" placeholder="Ingrese la comuna ">
</div>

<!-- Campo para la dirección del encargado de la empresa encargado_cliente -->
<div class="form-group">
    <label for="direccion_encargado_cliente">Dirección:</label>
    <input type="text" id="direccion_encargado_cliente" name="direccion_encargado_cliente" placeholder="Ingrese la dirección" oninput="formatoDireccion(this)">
    <span id="error_direccion" style="color: red; display: none;">La dirección solo puede contener letras y números.</span>
</div>
<script src="../../js/crear_cliente/formulario_encargado.js"></script> 

<?php
// Comprueba si el formulario ha sido enviado mediante el método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     // Captura los datos del formulario y realiza una validación básica
     $rut_empresa_cliente = $mysqli->real_escape_string($_POST['rut_empresa_cliente']);
     $nombre_empresa_cliente = $mysqli->real_escape_string($_POST['nombre_empresa_cliente']);
     $telefono_empresa_cliente = $mysqli->real_escape_string($_POST['telefono_empresa_cliente']);
     $email_empresa_cliente = $mysqli->real_escape_string($_POST['email_empresa_cliente']);
     $giro_empresa_cliente = $mysqli->real_escape_string($_POST['giro_empresa_cliente']);
     $tipo_empresa_cliente = $mysqli->real_escape_string($_POST['tipo_empresa_cliente']);
     $comuna_empresa_cliente = $mysqli->real_escape_string($_POST['comuna_empresa_cliente']);
     $ciudad_empresa_cliente = $mysqli->real_escape_string($_POST['ciudad_empresa_cliente']);
     $direccion_empresa_cliente = $mysqli->real_escape_string($_POST['direccion_empresa_cliente']);
     $observacion = $mysqli->real_escape_string($_POST['observacion']);
    
    // Captura los datos del formulario y realiza una validación básica
    $nombre_encargado_cliente = $mysqli->real_escape_string($_POST['nombre_encargado_cliente']);
    $rut_encargado_cliente = $mysqli->real_escape_string($_POST['rut_encargado_cliente']);
    $direccion_encargado_cliente = $mysqli->real_escape_string($_POST['direccion_encargado_cliente']);
    $telefono_encargado_cliente = $mysqli->real_escape_string($_POST['telefono_encargado_cliente']);
    $email_encargado_cliente = $mysqli->real_escape_string($_POST['email_encargado_cliente']);
    $cargo_encargado_cliente = $mysqli->real_escape_string($_POST['cargo_encargado_cliente']);
    $comuna_encargado_cliente = $mysqli->real_escape_string($_POST['comuna_encargado_cliente']);
    $ciudad_encargado_cliente = $mysqli->real_escape_string($_POST['ciudad_encargado_cliente']);
 

    

     // Crea la consulta SQL para insertar un nuevo cliente en la base de datos
     $sql = "INSERT INTO C_Clientes (rut_empresa_cliente,
      nombre_empresa_cliente,
       telefono_empresa_cliente,
        email_empresa_cliente,
         giro_empresa_cliente,
          tipo_empresa_cliente,
           comuna_empresa_cliente,
            ciudad_empresa_cliente,
             direccion_empresa_cliente,
              observacion,
               rut_encargado_cliente,
                nombre_encargado_cliente,
                 direccion_encargado_cliente,
                  telefono_encargado_cliente,
                   email_encargado_cliente,
                    cargo_encargado_cliente,
                     comuna_encargado_cliente,
                      ciudad_encargado_cliente)
     VALUES ('$rut_empresa_cliente',
      '$nombre_empresa_cliente',
       '$telefono_empresa_cliente',
        '$email_empresa_cliente',
         '$giro_empresa_cliente',
          '$tipo_empresa_cliente',
           '$comuna_empresa_cliente',
            '$ciudad_empresa_cliente',
             '$direccion_empresa_cliente',
              '$observacion',
               '$rut_encargado_cliente',
                '$nombre_encargado_cliente', 
                '$direccion_encargado_cliente',
                 '$telefono_encargado_cliente',
                  '$email_encargado_cliente',
                   '$cargo_encargado_cliente',
                    '$comuna_encargado_cliente',
                     '$ciudad_encargado_cliente')";


    // Ejecuta la consulta y verifica si se insertó correctamente
    if ($mysqli->query($sql) === TRUE) {
        echo "encargado_cliente creado exitosamente.";
    } else {
        echo "Error al crear el encargado_cliente: " . $mysqli->error;
    }   
}
?>

 
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa formulario encargado .PHP ----------------------------------------
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