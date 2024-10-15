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
$sql = "SELECT id_proveedor, nombre_proveedor, empresa_proveedor, rut_proveedor, direccion_proveedor, lugar_proveedor, telefono_proveedor, email_proveedor, cargo_proveedor, giro_proveedor, comuna_proveedor, ciudad_proveedor, tipo_proveedor FROM P_Proveedor";
$result = $mysqli->query($sql);  // Cambia $conn a $mysqli
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Proveedores</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace al archivo CSS -->
</head>
<body>
    <div class="container">
        <h1>Lista de Proveedores</h1>
        
        <?php
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Empresa</th>
                    <th>RUT</th>
                    <th>Dirección</th>
                    <th>Lugar</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Cargo</th>
                    <th>Giro</th>
                    <th>Comuna</th>
                    <th>Ciudad</th>
                    <th>Tipo</th>
                  </tr>";
            
            // Mostrar datos de cada fila
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_proveedor"] . "</td>";
                echo "<td>" . $row["nombre_proveedor"] . "</td>";
                echo "<td>" . $row["empresa_proveedor"] . "</td>";
                echo "<td>" . $row["rut_proveedor"] . "</td>";
                echo "<td>" . $row["direccion_proveedor"] . "</td>";
                echo "<td>" . $row["lugar_proveedor"] . "</td>";
                echo "<td>" . $row["telefono_proveedor"] . "</td>";
                echo "<td>" . $row["email_proveedor"] . "</td>";
                echo "<td>" . $row["cargo_proveedor"] . "</td>";
                echo "<td>" . $row["giro_proveedor"] . "</td>";
                echo "<td>" . $row["comuna_proveedor"] . "</td>";
                echo "<td>" . $row["ciudad_proveedor"] . "</td>";
                echo "<td>" . $row["tipo_proveedor"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No se encontraron proveedores en la base de datos.</p>";
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