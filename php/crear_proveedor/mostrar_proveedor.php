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
        <h1>Lista de Proveedores</h1>
        
        <?php
        // Verifica si se encontraron proveedores
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>
                    <th>ID</th>
                    <th>Nombre Proveedor</th>
                    <th>Dirección Proveedor</th>
                    <th>RUT Proveedor</th>
                    <th>Teléfono Proveedor</th>
                    <th>Email Proveedor</th>
                    <th>Cargo Proveedor</th>
                    <th>Comuna Proveedor</th>
                    <th>Ciudad Proveedor</th>
                    <th>Tipo Proveedor</th>
                    <th>Empresa</th>
                    <th>RUT Empresa</th>
                    <th>Dirección Empresa</th>
                    <th>Teléfono Empresa</th>
                    <th>Email Empresa</th>
                    <th>Comuna Empresa</th>
                    <th>Ciudad Empresa</th>
                    <th>Giro Empresa</th>
                  </tr>";
            
            // Mostrar datos de cada fila
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_proveedor"] . "</td>";
                echo "<td>" . $row["nombre_proveedor"] . "</td>";
                echo "<td>" . $row["direccion_proveedor"] . "</td>";
                echo "<td>" . $row["rut_proveedor"] . "</td>";
                echo "<td>" . $row["telefono_proveedor"] . "</td>";
                echo "<td>" . $row["email_proveedor"] . "</td>";
                echo "<td>" . $row["cargo_proveedor"] . "</td>";
                echo "<td>" . $row["comuna_proveedor"] . "</td>";
                echo "<td>" . $row["ciudad_proveedor"] . "</td>";
                echo "<td>" . $row["tipo_proveedor"] . "</td>";
                echo "<td>" . $row["empresa_proveedor"] . "</td>";
                echo "<td>" . $row["rut_empresa_proveedor"] . "</td>";
                echo "<td>" . $row["direccion_empresa_proveedor"] . "</td>";
                echo "<td>" . $row["telefono_empresa_proveedor"] . "</td>";
                echo "<td>" . $row["email_empresa_proveedor"] . "</td>";
                echo "<td>" . $row["comuna_empresa_proveedor"] . "</td>";
                echo "<td>" . $row["ciudad_empresa_proveedor"] . "</td>";
                echo "<td>" . $row["giro_proveedor"] . "</td>";
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