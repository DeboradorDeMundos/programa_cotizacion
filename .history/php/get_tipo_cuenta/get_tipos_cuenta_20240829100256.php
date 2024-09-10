                                                                                <?php
header('Content-Type: application/json');

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

// Consultar tipo de cuenta
$sql_tipo_cuenta = "SELECT id_tipocuenta, tipocuenta FROM Tipo_Cuenta";
$result_tipo_cuenta = $conn->query($sql_tipo_cuenta);

$tipos_cuenta = [];

// Procesar resultados de tipo de cuenta
if ($result_tipo_cuenta->num_rows > 0) {
    while ($row = $result_tipo_cuenta->fetch_assoc()) {
        $tipos_cuenta[] = $row;
    }
}

$conn->close();

// Enviar datos en formato JSON
echo json_encode($tipos_cuenta);
?>
