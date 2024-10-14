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
    ------------------------------------- INICIO ITred Spa Datos empresa.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
    <link rel="stylesheet" href="../../css/ver_cotizacion/datos_empresa.css"> <!-- Enlaza el archivo CSS para estilizar los datos de la empresa -->
<div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
    <!-- Crea una caja para ingresar datos, ocupando las 12 columnas disponibles en el diseño. Esta caja contiene varios campos de entrada de datos -->
    <fieldset class="box-12 cuadro-datos"> 
        <legend>Mi Empresa</legend> <!-- Título del campo de datos -->

        <!-- Campo de texto para ingresar el ID de la empresa. Este campo está oculto -->
        <input type="text" id="empresa-id" name="empresa_id" value="<?php echo htmlspecialchars($id); ?>" hidden> 
        
        <div class="form-group">
            <!-- Etiqueta para el campo de entrada del nombre de la empresa -->
            <label for="empresa_nombre">Nombre</label> 
            <!-- Campo de texto para ingresar el nombre de la empresa. El atributo "required" hace que el campo sea obligatorio -->
            <input type="text" id="empresa_nombre" name="empresa_nombre" value="<?php echo htmlspecialchars($row['EmpresaNombre']); ?>" oninput="QuitarCaracteresInvalidos(this)"> 
        </div>

        <div class="form-group">
            <!-- Etiqueta para el campo de entrada del área de la empresa -->
            <label for="empresa_area">Área</label> 
            <!-- Campo de texto para ingresar el área de la empresa. Este campo no es obligatorio -->
            <input type="text" id="empresa_area" name="empresa_area" value="<?php echo htmlspecialchars($row['EmpresaArea']); ?>" oninput="QuitarCaracteresInvalidos(this)"> 
        </div>

        <div class="form-group">
            <!-- Etiqueta para el campo de entrada de la dirección de la empresa -->
            <label for="empresa_direccion">Dirección</label> 
            <!-- Campo de texto para ingresar la dirección de la empresa. Este campo no es obligatorio -->
            <input type="text" id="empresa_direccion" name="empresa_direccion" value="<?php echo htmlspecialchars($row['EmpresaDireccion']); ?>" oninput="QuitarCaracteresInvalidos(this)"> 
        </div>
                
        <div class="form-group" style="display: flex; align-items: center;">
            <!-- Etiqueta para el campo de entrada del teléfono de la empresa -->
            <label for="empresa_telefono" style="margin-right: 10px;">Teléfono</label>

            <!-- Imagen de la bandera -->
            <img id="flag" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/Flag_of_None.svg/32px-Flag_of_None.svg.png" 
                alt="Bandera" style="display: none; margin-right: 10px;" width="32" height="20">

            <!-- Campo de entrada de texto para el teléfono de la empresa -->
            <input type="text" id="empresa_telefono" name="empresa_telefono" 
                value="<?php echo htmlspecialchars($row['EmpresaTelefono']); ?>"
                placeholder="+56 9 1234 1234" 
                maxlength="13" 
                required 
                title="Formato válido: +56 9 1234 1234 (código de país, seguido de número)"
                oninput="AgregarMasYDetectarPais(this)"> 
        </div>

        <div class="form-group">
            <!-- Etiqueta para el campo de entrada del email de la empresa -->
            <label for="empresa_email">Email</label> 
            <!-- Campo de correo electrónico para ingresar el email de la empresa. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
            <input type="email" id="empresa_email" name="empresa_email" value="<?php echo htmlspecialchars($row['EmpresaEmail']); ?>" oninput="QuitarCaracteresInvalidos(this)"> 
        </div>
    </fieldset> <!-- Cierra la caja de datos -->
</div> <!-- Cierra la fila -->

<!-- Enlaza el archivo JavaScript para manejar la lógica del formulario de datos de la empresa -->
<script src="../../js/ver_cotizacion/datos_empresa.js"></script> 

<?php
// Verifica si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene los valores del formulario
    $empresa_id = isset($_POST['empresa_id']) ? $_POST['empresa_id'] : null; 
    $empresa_rut = isset($_POST['empresa_rut']) ? $_POST['empresa_rut'] : null; 
    $empresa_nombre = isset($_POST['empresa_nombre']) ? trim($_POST['empresa_nombre']) : null; 
    $empresa_area = isset($_POST['empresa_area']) ? $_POST['empresa_area'] : null; 
    $empresa_direccion = isset($_POST['empresa_direccion']) ? $_POST['empresa_direccion'] : null; 
    $empresa_telefono = isset($_POST['empresa_telefono']) ? $_POST['empresa_telefono'] : null; 
    $empresa_email = isset($_POST['empresa_email']) ? $_POST['empresa_email'] : null; 

    // Verifica que el nombre y el RUT de la empresa estén presentes
    if ($empresa_nombre && $empresa_rut) {
        // Consulta para insertar o actualizar la empresa
        $sql = "INSERT INTO E_Empresa (rut_empresa, id_foto, nombre_empresa, area_empresa, direccion_empresa, telefono_empresa, email_empresa)
                VALUES (?, ?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE nombre_empresa=VALUES(nombre_empresa), area_empresa=VALUES(area_empresa), direccion_empresa=VALUES(direccion_empresa), telefono_empresa=VALUES(telefono_empresa), email_empresa=VALUES(email_empresa)";
        $stmt = $mysqli->prepare($sql);
        // Verifica si la preparación de la consulta fue exitosa
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $mysqli->error);
        }
        $empresa_id_foto = null; // O el valor correspondiente si tienes la foto
        // Vincula los parámetros a la consulta
        $stmt->bind_param("sisssss", $empresa_rut, $empresa_id_foto, $empresa_nombre, $empresa_area, $empresa_direccion, $empresa_telefono, $empresa_email);
        $stmt->execute();
        // Verifica si hubo errores en la ejecución de la consulta
        if ($stmt->error) {
            die("Error en la ejecución de la consulta: " . $stmt->error);
        }

        // Obtiene el ID de la empresa insertada/actualizada
        $id_empresa = $mysqli->insert_id;
        echo "Empresa insertada/actualizada. ID: $id_empresa<br>";
    } else {
        echo "Nombre y RUT de la empresa son obligatorios."; // Mensaje de error si faltan campos obligatorios
    }
}
?>







     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Datos empresa.PHP ----------------------------------------
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
