<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'cotizaciones_db');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$proyecto = $_POST['proyecto'];
$cod_prov = $_POST['cod_prov'];
$cliente_empresa = $_POST['cliente_empresa'];
$cliente_rut = $_POST['cliente_rut'];
$cliente_direccion = $_POST['cliente_direccion'];
$cliente_fono = $_POST['cliente_fono'];
$cliente_email = $_POST['cliente_email'];
$cantidad = $_POST['cantidad'];
$descripcion = $_POST['descripcion'];
$precio_unitario = $_POST['precio_unitario'];

// Calcular el total
$total = $cantidad * $precio_unitario;
$iva = $total * 0.19;
$total_con_iva = $total + $iva;
$descuento = $total_con_iva * 0.05;
$total_con_descuento = $total_con_iva - $descuento;
$adelanto = $total_con_descuento * 0.30;

// Insertar los datos en la base de datos
$sql = "INSERT INTO cotizaciones (proyecto, cod_prov, cliente_empresa, cliente_rut, cliente_direccion, cliente_fono, cliente_email, cantidad, descripcion, precio_unitario, total, iva, total_con_iva, descuento, total_con_descuento, adelanto) 
        VALUES ('$proyecto', '$cod_prov', '$cliente_empresa', '$cliente_rut', '$cliente_direccion', '$cliente_fono', '$cliente_email', $cantidad, '$descripcion', $precio_unitario, $total, $iva, $total_con_iva, $descuento, $total_con_descuento, $adelanto)";

if ($conn->query($sql) === TRUE) {
    echo "<h2>Cotización Generada</h2>";
    echo "<p>Proyecto: $proyecto</p>";
    echo "<p>Código Prov: $cod_prov</p>";
    echo "<p>Empresa: $cliente_empresa</p>";
    echo "<p>RUT: $cliente_rut</p>";
    echo "<p>Dirección: $cliente_direccion</p>";
    echo "<p>Teléfono: $cliente_fono</p>";
    echo "<p>E-mail: $cliente_email</p>";
    echo "<p>Cantidad: $cantidad</p>";
    echo "<p>Descripción: $descripcion</p>";
    echo "<p>Precio Unitario: $precio_unitario</p>";
    echo "<p>Total: $total</p>";
    echo "<p>IVA (19%): $iva</p>";
    echo "<p>Total con IVA: $total_con_iva</p>";
    echo "<p>Descuento (5%): $descuento</p>";
    echo "<p>Total con Descuento: $total_con_descuento</p>";
    echo "<p>Adelanto (30%): $adelanto</p>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
