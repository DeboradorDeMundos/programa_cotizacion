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
    ------------------------------------- INICIO ITred Spa Datos empresa.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
     
     <?php
function obtener_datos_empresa($mysqli, $id) {
    $sql_empresa = "SELECT 
        e.rut_empresa AS EmpresaRUT,
        e.nombre_empresa AS EmpresaNombre,
        e.area_empresa AS EmpresaArea,
        e.direccion_empresa AS EmpresaDireccion,
        e.telefono_empresa AS EmpresaTelefono,
        e.email_empresa AS EmpresaEmail,
        f.ruta_foto
    FROM e_empresa e
    LEFT JOIN e_FotosPerfil f ON f.id_foto = e.id_foto
    WHERE e.id_empresa = ?";

    if ($stmt_empresa = $mysqli->prepare($sql_empresa)) {
        $stmt_empresa->bind_param("i", $id);
        $stmt_empresa->execute();
        $result_empresa = $stmt_empresa->get_result();
        $stmt_empresa->close();
        return $result_empresa->fetch_assoc();
    } else {
        echo "<p>Error al preparar la consulta de empresa: " . $mysqli->error . "</p>";
        return null;
    }
}
?>

<div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
    <fieldset class="box-12 data-box"> <!-- Crea una caja para ingresar datos, ocupando las 12 columnas disponibles en el diseño. Esta caja contiene varios campos de entrada de datos -->
        <legend>Detalle empresa</legend>

        <input type="text" id="empresa-id" name="empresa_id" value="<?php echo htmlspecialchars($id); ?>" hidden> <!-- Campo de texto para ingresar el nombre de la empresa. El atributo "required" hace que el campo sea obligatorio -->
        
        <div class="form-group">
            <label for="empresa_nombre">Nombre</label> <!-- Etiqueta para el campo de entrada del nombre de la empresa -->
            <input type="text" id="empresa_nombre" name="empresa_nombre" value="<?php echo htmlspecialchars($row['EmpresaNombre']); ?>"> <!-- Campo de texto para ingresar el nombre de la empresa. El atributo "required" hace que el campo sea obligatorio -->
        </div>

        <div class="form-group">
            <label for="empresa_area">Área</label> <!-- Etiqueta para el campo de entrada del área de la empresa -->
            <input type="text" id="empresa_area" name="empresa_area" value="<?php echo htmlspecialchars($row['EmpresaArea']); ?>"> <!-- Campo de texto para ingresar el área de la empresa. Este campo no es obligatorio -->
        </div>
        <div class="form-group">
            <label for="empresa_direccion">Dirección</label> <!-- Etiqueta para el campo de entrada de la dirección de la empresa -->
            <input type="text" id="empresa_direccion" name="empresa_direccion" value="<?php echo htmlspecialchars($row['EmpresaDireccion']); ?>"> <!-- Campo de texto para ingresar la dirección de la empresa. Este campo no es obligatorio -->
        </div>
        <div class="form-group">
            <label for="empresa_telefono">Teléfono</label> <!-- Etiqueta para el campo de entrada del teléfono de la empresa -->
            <input type="text" id="empresa_telefono" name="empresa_telefono" pattern="\+?\d{7,15}" placeholder="+1234567890" value="<?php echo htmlspecialchars($row['EmpresaTelefono']); ?>"
                placeholder="+56 9 1234 1234" 
                maxlength="11" 
                required 
                pattern="^\+\d{2}\s\d{1}\s\d{4}\s\d{4}$" 
                title="Formato válido: +56 9 1234 1234 (código de país, seguido de número)"
                oninput="formatPhoneNumber(this)">  <!-- Campo de texto para ingresar el teléfono de la empresa. Este campo no es obligatorio -->
        </div>
        <div class="form-group">
            <label for="empresa_email">Email</label> <!-- Etiqueta para el campo de entrada del email de la empresa -->
            <input type="email" id="empresa_email" name="empresa_email" value="<?php echo htmlspecialchars($row['EmpresaEmail']); ?>"> <!-- Campo de correo electrónico para ingresar el email de la empresa. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
        </div>
    </fieldset> <!-- Cierra la caja de datos -->
</div> <!-- Cierra la fila -->



<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $empresa_id = isset($_POST['empresa_id']) ? $_POST['empresa_id'] : null;
    $empresa_rut = isset($_POST['empresa_rut']) ? $_POST['empresa_rut'] : null;
    $empresa_nombre = isset($_POST['empresa_nombre']) ? trim($_POST['empresa_nombre']) : null;
    $empresa_area = isset($_POST['empresa_area']) ? $_POST['empresa_area'] : null;
    $empresa_direccion = isset($_POST['empresa_direccion']) ? $_POST['empresa_direccion'] : null;
    $empresa_telefono = isset($_POST['empresa_telefono']) ? $_POST['empresa_telefono'] : null;
    $empresa_email = isset($_POST['empresa_email']) ? $_POST['empresa_email'] : null;

    if ($empresa_nombre && $empresa_rut) {
        // Insertar o actualizar la empresa
        $sql = "INSERT INTO E_Empresa (rut_empresa, id_foto, nombre_empresa, area_empresa, direccion_empresa, telefono_empresa, email_empresa)
                VALUES (?, ?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE nombre_empresa=VALUES(nombre_empresa), area_empresa=VALUES(area_empresa), direccion_empresa=VALUES(direccion_empresa), telefono_empresa=VALUES(telefono_empresa), email_empresa=VALUES(email_empresa)";
        $stmt = $mysqli->prepare($sql);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $mysqli->error);
        }
        $empresa_id_foto = null; // O el valor correspondiente si tienes la foto
        $stmt->bind_param("sisssss", $empresa_rut, $empresa_id_foto, $empresa_nombre, $empresa_area, $empresa_direccion, $empresa_telefono, $empresa_email);
        $stmt->execute();
        if ($stmt->error) {
            die("Error en la ejecución de la consulta: " . $stmt->error);
        }

        $id_empresa = $mysqli->insert_id;
        echo "Empresa insertada/actualizada. ID: $id_empresa<br>";
    } else {
        echo "Nombre y RUT de la empresa son obligatorios.";
    }
}
?>






     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Datos empresa.PHP ----------------------------------------
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
