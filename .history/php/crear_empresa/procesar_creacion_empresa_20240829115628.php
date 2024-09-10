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
    ------------------------------------- INICIO ITred Spa Procesar Cotizacion .PHP --------------------------------------
 ------------------------------------------------------------------------------------------------------------- -->

 <?php
// Habilitar el reporte de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establecer la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "itredspa_bd";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa<br>";

// Recibir datos del formulario
$empresa_rut = $_POST['empresa_rut'];
$empresa_nombre = $_POST['empresa_nombre'];
$empresa_area = $_POST['empresa_area'];
$empresa_direccion = $_POST['empresa_direccion'];
$empresa_telefono = $_POST['empresa_telefono'];
$empresa_email = $_POST['empresa_email'];
$nombre_cuenta = $_POST['nombre_cuenta'];
$id_banco = $_POST['id_banco'];
$id_tipocuenta = $_POST['id_tipocuenta'];
$numero_cuenta = $_POST['numero_cuenta'];
$nombre_encargado = $_POST['nombre_encargado'];
$rut_banco = $_POST['rut_banco'];
$email_banco = $_POST['email_banco'];

// Definir la ruta de subida de archivos
$upload_dir = '../../imagenes/programa_cotizacion/'; // Ruta relativa desde el archivo PHP

// Inicializar la variable para el ID de la foto
$empresa_id_foto = null;

// Verificar si el archivo fue subido sin errores
if (isset($_FILES['logo_upload']) && $_FILES['logo_upload']['error'] == UPLOAD_ERR_OK) {
    $tmp_name = $_FILES['logo_upload']['tmp_name'];
    $name = basename($_FILES['logo_upload']['name']);

    // Validar el tipo de archivo
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($_FILES['logo_upload']['type'], $allowed_types)) {
        die("Error: Tipo de archivo no permitido.");
    }

    $upload_file = $upload_dir . $name;

    // Mover el archivo cargado al directorio de destino
    if (move_uploaded_file($tmp_name, $upload_file)) {
        echo "Imagen subida correctamente.";

        // Insertar la ruta de la foto en la tabla FotosPerfil
        $sql_foto = "INSERT INTO FotosPerfil (ruta_foto) VALUES (?)";
        $stmt_foto = $conn->prepare($sql_foto);
        $stmt_foto->bind_param("s", $upload_file);
        if ($stmt_foto->execute()) {
            echo "Foto del perfil insertada correctamente.";
            
            // Obtener el ID de la foto recién insertada
            $empresa_id_foto = $conn->insert_id;
        } else {
            die("Error al insertar la foto del perfil: " . $stmt_foto->error);
        }
        $stmt_foto->close();
    } else {
        die("Error al subir la imagen.");
    }
} else {
    echo "No se subió una imagen.";
}

// Insertar o actualizar la empresa
$sql = "INSERT INTO Empresa (rut_empresa, id_foto, nombre_empresa, area_empresa, direccion_empresa, telefono_empresa, email_empresa)
        VALUES (?, ?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE nombre_empresa=VALUES(nombre_empresa), area_empresa=VALUES(area_empresa), direccion_empresa=VALUES(direccion_empresa), telefono_empresa=VALUES(telefono_empresa), email_empresa=VALUES(email_empresa)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("sisssss", $empresa_rut, $empresa_id_foto, $empresa_nombre, $empresa_area, $empresa_direccion, $empresa_telefono, $empresa_email);
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}

// Obtener el ID de la empresa después de la inserción/actualización
$id_empresa = $conn->insert_id;
echo "Empresa insertada/actualizada. ID: $id_empresa<br>";

// Insertar datos en la tabla Cuenta_Bancaria
$sql = "INSERT INTO Cuenta_Bancaria (nombre_cuenta, id_banco, id_tipocuenta, numero_cuenta, nombre_encargado, rut_banco, email_banco)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("siissss", $nombre_cuenta, $id_banco, $id_tipocuenta, $numero_cuenta, $nombre_encargado, $rut_banco, $email_banco);
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}

$id_cuenta = $conn->insert_id;
echo "Cuenta bancaria insertada. ID: $id_cuenta<br>";
$id_vendedor = $conn->insert_id;
echo "Vendedor insertado/actualizado. ID: $id_vendedor<br>";

// Cerrar la conexión
$conn->close();

// Redirigir a una página de éxito
header('Location: ../../programa_cotizacion.php'); // Cambia 'exito.php' por la página a la que quieras redirigir
exit();

?>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Procesar Cotizacion .PHP -----------------------------------
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
