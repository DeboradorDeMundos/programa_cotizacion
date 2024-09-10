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

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->
     <?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'ITredSpa_bd');
?>
<!-- ---------------------
     -- FIN CONEXION BD --
     --------------------- -->
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
            <input type="text" id="empresa_telefono" name="empresa_telefono" pattern="\+?\d{7,15}" placeholder="+1234567890" value="<?php echo htmlspecialchars($row['EmpresaTelefono']); ?>"> <!-- Campo de texto para ingresar el teléfono de la empresa. Este campo no es obligatorio -->
        </div>
        <div class="form-group">
            <label for="empresa_email">Email</label> <!-- Etiqueta para el campo de entrada del email de la empresa -->
            <input type="email" id="empresa_email" name="empresa_email" value="<?php echo htmlspecialchars($row['EmpresaEmail']); ?>"> <!-- Campo de correo electrónico para ingresar el email de la empresa. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
        </div>
    </fieldset> <!-- Cierra la caja de datos -->
</div> <!-- Cierra la fila -->



<!-- ---------------------
-- INICIO CIERRE CONEXION BD --
     --------------------- -->
     <?php
     $mysqli->close();
?>
<!-- ---------------------
     -- FIN CIERRE CONEXION BD --
     --------------------- -->


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
