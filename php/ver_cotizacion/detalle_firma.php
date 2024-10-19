<?php
// Conexión a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'ITredSpa_bd');


// Obtener el ID de la cotización desde la URL
$id_cotizacion = isset($_GET['id']) ? (int) $_GET['id'] : 0;

echo $id_cotizacion;

// Inicializar variables
$nombre_empresa = $rut_empresa = $direccion_empresa = $telefono_empresa = $email_empresa = $area_empresa = '';
$nombre_encargado = $email_encargado = $telefono_encargado = '';
$estado_aprobacion = 'Aprobada'; // Estado de aprobación predeterminado

// Validar si el ID es válido
if ($id_cotizacion > 0) {
    // Consultar cotización
    $sql_cotizacion = "SELECT 
        e.nombre_empresa,
        e.rut_empresa,
        e.direccion_empresa,
        e.telefono_empresa,
        e.email_empresa,
        e.area_empresa,
        en.nombre_encargado,
        en.email_encargado,
        en.fono_encargado
    FROM 
        C_Cotizaciones ct
        JOIN E_Empresa e ON ct.id_empresa = e.id_empresa
        JOIN C_Encargados en ON ct.id_encargado = en.id_encargado
    WHERE ct.id_cotizacion = ?";
    
    $stmt = $mysqli->prepare($sql_cotizacion);
    $stmt->bind_param("i", $id_cotizacion);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Datos de la empresa
        $nombre_empresa = $row['nombre_empresa'];
        $rut_empresa = $row['rut_empresa'];
        $direccion_empresa = $row['direccion_empresa'];
        $telefono_empresa = $row['telefono_empresa'];
        $email_empresa = $row['email_empresa'];
        $area_empresa = $row['area_empresa'];

        // Datos del encargado
        $nombre_encargado = $row['nombre_encargado'];
        $email_encargado = $row['email_encargado'];
        $telefono_encargado = $row['fono_encargado'];
    } else {
        echo "<p class='error'>Aún no has creado la cotización.</p>";
        exit;
    }
    $stmt->close();
} else {
    echo "<p class='error'>ID de cotización no válido.</p>";
    exit;
}
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de la Firma</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .contenedor {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .firma {
            text-align: center;
            margin-top: 20px;
        }
        .firma p {
            font-size: 18px;
            margin: 5px 0;
            color: #555;
        }
        .firma .status {
            font-weight: bold;
            color: green;
            margin-top: 10px;
        }
        .firma .status-icon {
            display: inline-block;
            margin-left: 10px;
            vertical-align: middle;
        }
        .firma .status-icon img {
            width: 30px;
            height: 30px;
        }
        .firma .firma-data {
            text-align: left;
            margin-top: 30px;
        }
        .firma-data p {
            margin: 8px 0;
            color: #333;
        }
        .boton {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .boton:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="contenedor"> <!-- Título: Contenedor principal de la firma -->
    <h1>Firma de la Empresa</h1> <!-- Título: Encabezado principal de la firma -->

    <div class="firma"> <!-- Título: Contenedor de información de la empresa -->
        <!-- Título: Nombre de la empresa -->
        <p><strong>Título: Nombre de la empresa</strong> <?php echo htmlspecialchars($nombre_empresa); ?></p> 
        
        <!-- Título: RUT de la empresa -->
        <p><strong>Título: RUT de la empresa</strong> <?php echo htmlspecialchars($rut_empresa); ?></p> 
        
        <!-- Título: Dirección de la empresa -->
        <p><strong>Título: Dirección de la empresa</strong> <?php echo htmlspecialchars($direccion_empresa); ?></p> 
        
        <!-- Título: Teléfono de la empresa -->
        <p><strong>Título: Teléfono de la empresa</strong> <?php echo htmlspecialchars($telefono_empresa); ?></p> 
        
        <!-- Título: Email de la empresa -->
        <p><strong>Título: Email de la empresa</strong> <?php echo htmlspecialchars($email_empresa); ?></p> 
        
        <!-- Título: Área de la empresa -->
        <p><strong>Título: Área de la empresa</strong> <?php echo htmlspecialchars($area_empresa); ?></p> 

        <!-- Título: Estado de aprobación -->
        <p class="status">
            <strong>Título: Estado de Aprobación</strong>: <?php echo htmlspecialchars($estado_aprobacion); ?>
            <span class="status-icon">
                <img src="https://cdn-icons-png.flaticon.com/512/845/845646.png" alt="Aprobado">
            </span>
        </p>

        <div class="firma-data"> <!-- Título: Contenedor de datos del encargado -->
            <h2>Datos del Encargado</h2> <!-- Título: Encabezado de datos del encargado -->
            
            <!-- Título: Nombre del encargado -->
            <p><strong>Título: Nombre del Encargado</strong> <?php echo htmlspecialchars($nombre_encargado); ?></p> 
            
            <!-- Título: Email del encargado -->
            <p><strong>Título: Email del Encargado</strong> <?php echo htmlspecialchars($email_encargado); ?></p> 
            
            <!-- Título: Teléfono del encargado -->
            <p><strong>Título: Teléfono del Encargado</strong> <?php echo htmlspecialchars($telefono_encargado); ?></p> 
        </div>

        <!-- Título: Botón para ver la cotización -->
        <a href="ver_cotizacion.php?id=<?php echo $id_cotizacion; ?>" class="boton"><strong>Título: Ver Cotización</strong></a>
    </div>
</div>
</body>
</html>