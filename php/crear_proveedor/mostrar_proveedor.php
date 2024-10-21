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
    ------------------------------------- INICIO ITred Spa crear proveedor.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

    <?php
// Consulta para obtener todos los proveedores
$sql = "SELECT 
            id_proveedor, 
            nombre_proveedor, 
            direccion_proveedor, 
            rut_proveedor, 
            telefono_proveedor, 
            email_proveedor, 
            cargo_proveedor, 
            comuna_proveedor, 
            ciudad_proveedor, 
            tipo_proveedor, 
            empresa_proveedor, 
            rut_empresa_proveedor, 
            direccion_empresa_proveedor, 
            telefono_empresa_proveedor, 
            email_empresa_proveedor, 
            comuna_empresa_proveedor, 
            ciudad_empresa_proveedor, 
            giro_proveedor 
        FROM P_Proveedor";

$result = $mysqli->query($sql);

// Verifica si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . $mysqli->error); // Muestra el error en caso de fallo
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Proveedores</title>
    <link rel="stylesheet" href="../../css/crear_proveedor/mostrar_proveedor.css"> <!-- Enlace a tu archivo CSS -->
</head>
<body>
<div class="container">
    <!-- TÍTULO: LISTA DE PROVEEDORES -->
        <h1>Lista de Proveedores</h1>
    
    <?php
    // Verifica si se encontraron proveedores
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>
                <!-- Título: Encabezados de la tabla -->
                <th>ID</th> <!-- Título: ID del proveedor -->
                <th>Nombre Proveedor</th> <!-- Título: Nombre del proveedor -->
                <th>Dirección Proveedor</th> <!-- Título: Dirección del proveedor -->
                <th>RUT Proveedor</th> <!-- Título: RUT del proveedor -->
                <th>Teléfono Proveedor</th> <!-- Título: Teléfono del proveedor -->
                <th>Email Proveedor</th> <!-- Título: Email del proveedor -->
                <th>Cargo Proveedor</th> <!-- Título: Cargo del proveedor -->
                <th>Comuna Proveedor</th> <!-- Título: Comuna del proveedor -->
                <th>Ciudad Proveedor</th> <!-- Título: Ciudad del proveedor -->
                <th>Tipo Proveedor</th> <!-- Título: Tipo del proveedor -->
                <th>Empresa</th> <!-- Título: Empresa del proveedor -->
                <th>RUT Empresa</th> <!-- Título: RUT de la empresa -->
                <th>Dirección Empresa</th> <!-- Título: Dirección de la empresa -->
                <th>Teléfono Empresa</th> <!-- Título: Teléfono de la empresa -->
                <th>Email Empresa</th> <!-- Título: Email de la empresa -->
                <th>Comuna Empresa</th> <!-- Título: Comuna de la empresa -->
                <th>Ciudad Empresa</th> <!-- Título: Ciudad de la empresa -->
                <th>Giro Empresa</th> <!-- Título: Giro de la empresa -->
              </tr>";
        
        // Mostrar datos de cada fila
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id_proveedor"] . "</td>"; <!-- Título: ID del proveedor -->
            echo "<td>" . $row["nombre_proveedor"] . "</td>"; <!-- Título: Nombre del proveedor -->
            echo "<td>" . $row["direccion_proveedor"] . "</td>"; <!-- Título: Dirección del proveedor -->
            echo "<td>" . $row["rut_proveedor"] . "</td>"; <!-- Título: RUT del proveedor -->
            echo "<td>" . $row["telefono_proveedor"] . "</td>"; <!-- Título: Teléfono del proveedor -->
            echo "<td>" . $row["email_proveedor"] . "</td>"; <!-- Título: Email del proveedor -->
            echo "<td>" . $row["cargo_proveedor"] . "</td>"; <!-- Título: Cargo del proveedor -->
            echo "<td>" . $row["comuna_proveedor"] . "</td>"; <!-- Título: Comuna del proveedor -->
            echo "<td>" . $row["ciudad_proveedor"] . "</td>"; <!-- Título: Ciudad del proveedor -->
            echo "<td>" . $row["tipo_proveedor"] . "</td>"; <!-- Título: Tipo del proveedor -->
            echo "<td>" . $row["empresa_proveedor"] . "</td>"; <!-- Título: Empresa del proveedor -->
            echo "<td>" . $row["rut_empresa_proveedor"] . "</td>"; <!-- Título: RUT de la empresa -->
            echo "<td>" . $row["direccion_empresa_proveedor"] . "</td>"; <!-- Título: Dirección de la empresa -->
            echo "<td>" . $row["telefono_empresa_proveedor"] . "</td>"; <!-- Título: Teléfono de la empresa -->
            echo "<td>" . $row["email_empresa_proveedor"] . "</td>"; <!-- Título: Email de la empresa -->
            echo "<td>" . $row["comuna_empresa_proveedor"] . "</td>"; <!-- Título: Comuna de la empresa -->
            echo "<td>" . $row["ciudad_empresa_proveedor"] . "</td>"; <!-- Título: Ciudad de la empresa -->
            echo "<td>" . $row["giro_proveedor"] . "</td>"; <!-- Título: Giro de la empresa -->
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron proveedores.";
    }
    ?>
</div>
</body>
</html>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa crear proveedor .PHP ----------------------------------------
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