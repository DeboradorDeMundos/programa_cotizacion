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
    ------------------------------------- INICIO ITred Spa Ver Cotización .PHP ---------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<?php
// Habilitar el reporte de errores para facilitar la depuración
error_reporting(E_ALL); // Muestra todos los errores
ini_set('display_errors', 1); // Habilita la visualización de errores en la pantalla

// Establecer la conexión a la base de datos usando mysqli
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd'); // Conecta a la base de datos en localhost con usuario 'root' y sin contraseña, usando la base de datos 'itredspa_bd'

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "SELECT c.*, p.*, cl.*, v.*, e.*, en.*, d.*,  ds.cantidad, 
    (ds.cantidad * d.precio_unitario) AS detalle_total 
    FROM Cotizaciones c
    JOIN Proyectos p ON c.id_proyecto = p.id_proyecto
    JOIN Clientes cl ON c.id_cliente = cl.id_cliente
    JOIN Vendedores v ON c.id_vendedor = v.id_vendedor
    JOIN Empresa e ON c.id_empresa = e.id_empresa
    LEFT JOIN Encargados en ON c.id_encargado = en.id_encargado
    LEFT JOIN Detalle_Cotizacion ds ON c.id_cotizacion = ds.id_cotizacion
    LEFT JOIN Descripciones d ON ds.id_descripcion = d.id_descripcion
    WHERE c.id_cotizacion = ?";

    $stmt = $conn->prepare($sql);   
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Inicio del HTML para mostrar los datos
        echo "<div style='font-family: Arial, sans-serif; font-size: 12px;'>";
        echo "<div style='display: flex; justify-content: space-between;'>";
        echo "<div>";
        echo "<img src='path_to_your_logo.png' alt='Logo' style='width: 100px;'>";
        echo "<h2 style='margin: 0; font-size: 24px;'>ITRED SPA</h2>";
        echo "<p style='margin: 0; font-size: 12px;'>TECNOLOGIA Y CONSTRUCCION</p>";
        echo "<p style='margin: 0; font-size: 12px;'>DIRECCION: GUIDO RENI #4190, PEDRO AGUIRRE CERDA - SANTIAGO</p>";
        echo "<p style='margin: 0; font-size: 12px;'>FONO: (+56 9) 7242 5972</p>";
        echo "<p style='margin: 0; font-size: 12px;'>E-MAIL: CONTACTO@ITRED.CL</p>";
        echo "</div>";
        echo "<div style='text-align: right;'>";
        echo "<p style='border: 2px solid red; padding: 5px; font-size: 14px;'>RUT: 77.243.277-1 <br> ORDEN DE TRABAJO<br>N°" . htmlspecialchars($row['numero_cotizacion']) ."<br>VALIDA HASTA EL " . htmlspecialchars($row['fecha_validez']) ."</p>";
        echo "</div>";
        echo "</div>";
        echo "<hr>";

        echo "<h4 style='margin: 0; font-size: 18px;'>PROYECTO: INSTALACION MEMORIA RAM Y SOPORTE PC EQUIPO 1</h4>";
        echo "<div style='display: flex; justify-content: space-between; margin-top: 10px'>";
        echo "<div>";
        echo "<table>";
        echo "<tr><td style='font-size: 14px;'><strong>Proyecto</strong></td><td style='font-size: 12px;'>" . htmlspecialchars($row['nombre_proyecto']);
        echo "<tr><td style='font-size: 14px;'><strong>COD. PROY</strong></td><td style='font-size: 12px;'>" . htmlspecialchars($row['id_proyecto']);
        echo "<tr><td style='font-size: 14px;'><strong>AREA TRABAJO</strong></td><td style='font-size: 12px;'>" . htmlspecialchars($row['area_trabajo']);
        echo "<tr><td style='font-size: 14px;'><strong>RISGO TRAB.</strong></td><td style='font-size: 12px;'>" . htmlspecialchars($row['riesgo_proyecto']);
        echo "</table>";
        echo "</div>";
        echo "<div style='text-align: right; padding-right: 20px;' >";
        echo "<table>";
        echo "<tr><td style='font-size: 14px;'><strong>DIAS COMPRA</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['dias_compra']);
        echo "<tr><td style='font-size: 14px;'><strong>DIAS TRABAJO</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['dias_trabajo']);
        echo "<tr><td style='font-size: 14px;'><strong>TRABAJADORES</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['trabajadores']);
        echo "<tr><td style='font-size: 14px;'><strong>HORARIO</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['horario']);
        echo "<tr><td style='font-size: 14px;'><strong>COLACION</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['colacion']);
        echo "<tr><td style='font-size: 14px;'><strong>ENTREGA</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['entrega']);
        echo "</table>";
        echo "</div>";
        echo "</div>";
        
        echo "<h3 style='margin: 0; font-size: 18px;'>DATOS CLIENTES</h3>";
        echo "<div style='display: flex; justify-content: space-between; margin-top: 10px'>";
        echo "<div>";
        echo "<table>";
        echo "<tr><td 'font-size: 14px;'><strong>SR/TA: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['nombre_cliente']);
        echo "<tr><td 'font-size: 14px;'><strong>EMPRESA: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['empresa_cliente']);
        echo "<tr><td 'font-size: 14px;'><strong>RUT: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['rut_cliente']);
        echo "<tr><td 'font-size: 14px;'><strong>DIRECCION: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['direccion_cliente']);
        echo "<tr><td 'font-size: 14px;'><strong>OF./DEPTO</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['lugar_cliente']);
        echo "<tr><td 'font-size: 14px;'><strong>FONO: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['telefono_cliente']);
        echo "<tr><td 'font-size: 14px;'><strong>E-MAIL: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['email_cliente']);
        echo "</table>";
        echo "</div>";
        echo "<div style='text-align: right; padding-right: 20px;' >";
        echo "<table>";
        echo "<tr><td style='font-size: 14px;'><strong>CARGO: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['cargo_cliente']);
        echo "<tr><td style='font-size: 14px;'><strong>GIRO: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['giro_cliente']);
        echo "<tr><td style='font-size: 14px;'><strong>COMUNA: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['comuna_cliente']);
        echo "<tr><td style='font-size: 14px;'><strong>CIUDAD: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['ciudad_cliente']);
        echo "</table>";
        echo "</div>";
        echo "</div>";

        echo "<h3 style='margin: 20px; font-size: 18px;'>DATOS EMPRESA</h3>";
        echo "<div style='display: flex; justify-content: space-between; margin-top: 10px'>";
        echo "<div>";
        echo "<table>";
        echo "<tr><td><strong>ENC. PROYEC.: </strong></td><td>" . htmlspecialchars($row['nombre_encargado']) ."</tr>";
        echo "<tr><td><strong>E-MAIL: </strong></td><td>" . htmlspecialchars($row['email_encargado']) . "</td></tr>";
        echo "<tr><td><strong>FONO: </strong></td><td>" . htmlspecialchars($row['fono_encargado']) . "</td></tr>";
        echo "<tr><td><strong>WHATSAPP: </strong></td><td>" . htmlspecialchars($row['celular_encargado']) . "</td></tr>";
        echo "<tr><td><strong>TIPO CLIENTE: </strong></td><td>" . htmlspecialchars($row['tipo_cliente']) . "</td></tr>";
        echo "<tr><td><strong>Validez</strong></td><td>" . htmlspecialchars($row['fecha_validez']) . "</td></tr>";
        echo "</table>";
        echo "</div>";
        echo "<div style='text-align: right; padding-right: 20px;' >";
        echo "<table>";
        echo "<tr><td style='font-size: 14px;'><strong>VENDEDOR: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['nombre_vendedor']);
        echo "<tr><td style='font-size: 14px;'><strong>E-MAIL:  </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['email_vendedor']);
        echo "<tr><td style='font-size: 14px;'><strong>FONO:  </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['fono_vendedor']);
        echo "<tr><td style='font-size: 14px;'><strong>WHATSAPP:  </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['celular_vendedor']);
        echo "</table>";
        echo "</div>";
        echo "</div>";
        
        echo "<h3>Detalles del Servicio</h3>";
        echo "<h4 style='margin: 0;'><strong>ESTIMADO SEÑOR(A)  :</h4>";
        echo "<h5 style='margin: 0;'>DE ACUERDO A SU SOLICITUD DE COTIZACIÓN, TENEMOS EL AGRADO DE PRESENTAR NUESTRA OFERTA ECONOMICA :</h5>";
        echo "<table border='1' cellpadding='5' cellspacing='0' width='100%'>";
        echo "<tr><th>Cantidad</th><th>Descripción</th><th>Precio Unitario</th><th>Total</th></tr>";
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['cantidad']) . "</td>";
        echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
        echo "<td>" . htmlspecialchars($row['precio_unitario']) . "</td>";
        echo "<td>" . htmlspecialchars($row['detalle_total']) . "</td>";
        echo "</tr>";
        echo "</table>";

        echo "<div style='width: 100%; display: flex; justify-content: flex-end;'>";
        echo "<table border='1' cellpadding='5' cellspacing='0' width='48.9%'";
        echo "<tr><td colspan='3' align='right' ><strong>NETO</strong></td><td align='right'>" . htmlspecialchars($row['total']) . "</td></tr>";
        echo "<tr><td colspan='3' align='right'><strong>IVA 19%</strong></td><td align='right'>" . htmlspecialchars($row['iva']) . "</td></tr>";
        echo "<tr><td colspan='3' align='right'><strong>TOTAL</strong></td><td align='right'>" . htmlspecialchars($row['total']) . "</td></tr>";
        echo "<tr><td colspan='3' align='right'><strong>DESCUENTO 5%</strong></td><td align='right'>" . htmlspecialchars($row['descuento']) . "</td></tr>";
        echo "<tr><td colspan='3' align='right'><strong>TOTAL CON DESCUENTO</strong></td><td align='right'>" . htmlspecialchars($row['total_con_descuento']) . "</td></tr>";
        echo "<tr><td colspan='3' align='right'><strong>ADELANTO PARA COMPRA 30%</strong></td><td align='right'>" . htmlspecialchars($row['celular_encargado']) . "</td></tr>";
        echo "</table>";
        echo "</div>";

        echo "<div style='margin-top: 40px;'>";
        echo "<table border='1' cellpadding='5' cellspacing='0' width='100%'>";
        echo "<tr>";
        echo "<td> ADELANTO PARA COMPRA 30% </td>";
        echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
        echo "</tr>";
        echo "</table>";
        echo "</div>";

        echo "<div style='margin-top: 40px;'>";
        echo "<table >";
        echo "<tr><th style='background-color:lightgray'>CONDICIONES GENERALES</th></tr>";
        echo "<tr><td>1.- VALORES EXPRESADOS SERAN FACTURADOS EN MONEDA NACIONAL.</td></tr>";
        echo "<tr><td>2.- VALORES SUJETOS A VARIACION, DEBIDO A QUE LOS EQUIPOS, MATERIALES Y HERRAMIENTAS SON CALCULADOS CON EL VALOR DOLAR DIA</td></tr>";
        echo "<tr><td>3.- LAS INSTALACIONES NO INCLUYEN EQUIPOS, MATERIALES, FERRETERIA U OTRO TIPO DE HERRAMIENTAS QUE SE REQUIERAN PARA EL TRABAJO, QUE NO SE ENCUENTRE DETALLADO DENTRO DE ESTA COTIZACION.</td></tr>";
        echo "<tr><td>4.- GARANTIA 6 MESES, DESDE EL DIA DE LA ENTREGA, LA QUE CADUCA AUTOMATICAMENTE, EN CASO DE NO CUMPLIR LOS PAGOS, EN LAS FECHAS ACORDADAS</td></tr>";
        echo "<tr><td>5.- GARANTIA 6 MESES, DESDE EL DIA DE LA ENTREGA, LA QUE CADUCA AUTOMATICAMENTE, EN CASO DE HABER MANIPULACION O INTERVENCION DE TERCEROS</td></tr>";
        echo "<tr><td>6.- SI ALGUN TRABAJO, MATERIAL, PRODUCTO, EQUIPO, FERRETERIA O MANO DE OBRA, QUE NO SE ENCUENTRE EN ESTA COTIZACION, SE DEBERA COTIZAR Y AGREGAR EL VALOR A LA COTIZACION</td></tr>";
        echo "<tr><td>7.- LUGAR DE TRABAJO LIBRE DE OBJETOS, QUE SE PUEDAN, ROMPER, DAÑAR O ENTORPECER EL TRABAJO, DE LO CONTRARIO, SE DEBERA COTIZAR Y AGREGAR EL MOVIMIENTO DE OBJETOS A LA COTIZACION</td></tr>";
        echo "<tr><td>8.- EL CLIENTE DEBE INDICAR EL HORARIO DE ENTRADA Y DE SALIDA, CONTEMPLANDO QUE NUESTRO HORARIO DE TRABAJO ES DE LUNES A VIERNES DE 9:00 AM A 18:30HRS</td></tr>";
        echo "<tr><td>9.- LOS DIAS DE TRABAJO, SON COTIZADOS DE LUNES A VIERNES DE 9:30AM A 18:30HRS., CON 1HR. DE COLACION, SI EL CLIENTE PRESENTA ALGUN PROBLEMA DE HORARIO O URGENCIAS, DEBERA DAR AVISO ANTES DE COMENZAR EL PROYECTO, PARA AGREGAR HORAS EXTRAS, VIATICOS Y TODO LO QUE CORRESPONDE PARA CUMPLIR CON LA URGENCIA DEL CLIENTE, YA SEA TRABAJO DESPUES DE LA HORA LABORAL, FIN DE SEMANA O FESTIVOS</td></tr>";
        echo "<tr><td>10.- EL CLIENTE DEBE INDICAR LOS HORARIOS, EN LOS CUALES, SE PERMITE HACER RUIDOS FUERTES O INTERVENIR ENTRADAS, PASILLOS, CON MESONES, ESCALERAS, HERRAMIENTAS, ENTRE OTROS, ESTO ES MUY IMPORTANTE, PORQUE SI LOS HORARIOS SON MUY COMPLICADOS O REDUCIDOS, SE DEBERA RECALCULAR EL PRESUPUESTO</td></tr>";
        echo "</table>";
        echo "</div>";

        // Sección de transferencias
        echo "<h2>TRANSFERENCIAS A:</h2>";
        echo "<table>";
        echo "<tr><th>CHEQUERA ELECTRONICA ITRED SPA</th><th>CUENTA CORRIENTE PERSONAL</th><th>CUENTA RUT PERSONAL</th></tr>";
        echo "<tr><td>BANCO: Banco Estado</td><td>BANCO: Santander</td><td>BANCO: Banco Estado</td></tr>";
        echo "<tr><td>TIPO CUENTA: Chequera electrónica</td><td>TIPO CUENTA: Cuenta corriente</td><td>TIPO CUENTA: Cuenta RUT</td></tr>";
        echo "<tr><td>NUMERO CUENTA: 902-7-053409-0</td><td>NUMERO CUENTA: 0-000-77-51325-6</td><td>NUMERO CUENTA: 15457398</td></tr>";
        echo "<tr><td>NOMBRE: ITRED SPA</td><td>NOMBRE: Barner Piña Jara</td><td>NOMBRE: Barner Piña Jara</td></tr>";
        echo "<tr><td>RUT: 77.243.277-1</td><td>RUT: 15.457.398-4</td><td>RUT: 15.457.398-4</td></tr>";
        echo "<tr><td>E-MAIL: barnerp1@gmail.com</td><td>E-MAIL: barnerp1@gmail.com</td><td>E-MAIL: barnerp1@gmail.com</td></tr>";
        echo "</table>";

        // Mensaje de despedida
        echo "<p>SIN OTRO PARTICULAR, Y ESPERANDO QUE LA PRESENTE OFERTA SEA DE SU INTERÉS, SE DESPIDE ATENTAMENTE</p>";
        echo "<p>BARNER PATRICIO PIÑA JARA</p>";
        echo "<p>JEFE DE PROYECTO TECNOLOGÍA Y CONSTRUCCIÓN</p>";
        echo "<p>ITRED SPA.</p>";
        echo "</div>";
    } else {
        echo "<p>No se encontró la cotización con el ID proporcionado.</p>";
    }
    $stmt->close();
} else {
    echo "<p>ID inválido.</p>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Cotización</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <ul>
        <li><a href="../crear_nuevo/crear.php">Crear Cotización</a></li>
        <li><a href="../modificar/modificar.php?id=<?php echo $id; ?>">Modificar Cotización</a></li>
        <li><a href="../eliminar/eliminar.php?id=<?php echo $id; ?>">Eliminar Cotización</a></li>
        <li><a href="../ver_listado/ver_listado.php">Volver al Listado</a></li>
    </ul>
</body>
</html>




<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa  Ver Cotización .PHP -----------------------------------
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