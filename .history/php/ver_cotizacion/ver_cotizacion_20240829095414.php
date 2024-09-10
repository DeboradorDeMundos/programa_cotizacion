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


$id = isset($_GET['id']) ? intval($_GET['id']) : 0;  // Obtiene el parámetro 'id' de la URL y lo convierte a entero; si no está presente, asigna 0

if ($id > 0) {  // Verifica si el 'id' es mayor que 0
    $sql = "SELECT c.*, p.*, cl.*, v.*, e.*, en.*, d.*, ds.cantidad, 
    (ds.cantidad * d.precio_unitario) AS detalle_total 
    FROM Cotizaciones c
    JOIN Proyectos p ON c.id_proyecto = p.id_proyecto
    JOIN Clientes cl ON c.id_cliente = cl.id_cliente
    JOIN Vendedores v ON c.id_vendedor = v.id_vendedor
    JOIN Empresa e ON c.id_empresa = e.id_empresa
    LEFT JOIN Encargados en ON c.id_encargado = en.id_encargado
    LEFT JOIN Detalle_Cotizacion ds ON c.id_cotizacion = ds.id_cotizacion
    LEFT JOIN Descripciones d ON ds.id_descripcion = d.id_descripcion
    WHERE c.id_cotizacion = ?";  // Filtra los resultados donde 'id_cotizacion' es igual al parámetro 'id'

    $stmt = $conn->prepare($sql);  // Prepara la consulta SQL para ejecutar con parámetros
    $stmt->bind_param("i", $id);  // Vincula el parámetro 'id' a la consulta SQL como entero
    $stmt->execute();  // Ejecuta la consulta SQL
    $result = $stmt->get_result();  // Obtiene el resultado de la consulta ejecutada
    
    if ($result->num_rows > 0) {  // Verifica si hay resultados en la consulta
        $row = $result->fetch_assoc();  // Obtiene una fila de resultados como un array asociativo
    
        // Inicio del HTML para mostrar los datos
        echo "<div style='font-family: Arial, sans-serif; font-size: 12px;'>";  // Inicia un contenedor con estilo de fuente y tamaño de texto
        echo "<div style='display: flex; justify-content: space-between;'>";  // Crea un contenedor flexible para distribuir elementos
        echo "<div>";  // Contenedor para la información del encabezado
        echo "<img src='path_to_your_logo.png' alt='Logo' style='width: 100px;'>";  // Muestra el logo con un ancho de 100px
        echo "<h2 style='margin: 0; font-size: 24px;'>ITRED SPA</h2>";  // Muestra el nombre de la empresa con tamaño de fuente de 24px
        echo "<p style='margin: 0; font-size: 12px;'>TECNOLOGIA Y CONSTRUCCION</p>";  // Muestra el lema de la empresa con tamaño de fuente de 12px
        echo "<p style='margin: 0; font-size: 12px;'>DIRECCION: GUIDO RENI #4190, PEDRO AGUIRRE CERDA - SANTIAGO</p>";  // Muestra la dirección de la empresa
        echo "<p style='margin: 0; font-size: 12px;'>FONO: (+56 9) 7242 5972</p>";  // Muestra el número de teléfono
        echo "<p style='margin: 0; font-size: 12px;'>E-MAIL: CONTACTO@ITRED.CL</p>";  // Muestra el correo electrónico
        echo "</div>";
        echo "<div style='text-align: right;'>";  // Contenedor para la información alineada a la derecha
        echo "<p style='border: 2px solid red; padding: 5px; font-size: 14px;'>RUT: 77.243.277-1 <br> ORDEN DE TRABAJO<br>N°" . htmlspecialchars($row['numero_cotizacion']) ."<br>VALIDA HASTA EL " . htmlspecialchars($row['fecha_validez']) ."</p>";  // Muestra el RUT, número de cotización y fecha de validez con bordes y padding
        echo "</div>";
        echo "</div>";
        echo "<hr>";  // Inserta una línea horizontal para separar contenido

        // Muestra el título del proyecto
        echo "<h4 style='margin: 0; font-size: 18px;'>PROYECTO: INSTALACION MEMORIA RAM Y SOPORTE PC EQUIPO 1</h4>";

        // Contenedor para los detalles del proyecto
        echo "<div style='display: flex; justify-content: space-between; margin-top: 10px'>";
        
        // Primer bloque de detalles del proyecto
        echo "<div>";
        echo "<table>";
        echo "<tr><td style='font-size: 14px;'><strong>Proyecto</strong></td><td style='font-size: 12px;'>" . htmlspecialchars($row['nombre_proyecto']); // Nombre del proyecto
        echo "<tr><td style='font-size: 14px;'><strong>COD. PROY</strong></td><td style='font-size: 12px;'>" . htmlspecialchars($row['id_proyecto']); // Código del proyecto
        echo "<tr><td style='font-size: 14px;'><strong>AREA TRABAJO</strong></td><td style='font-size: 12px;'>" . htmlspecialchars($row['area_trabajo']); // Área de trabajo
        echo "<tr><td style='font-size: 14px;'><strong>RISGO TRAB.</strong></td><td style='font-size: 12px;'>" . htmlspecialchars($row['riesgo_proyecto']); // Riesgo del proyecto
        echo "</table>";
        echo "</div>";
        
        // Segundo bloque de detalles del proyecto alineado a la derecha
        echo "<div style='text-align: right; padding-right: 20px;'>";
        echo "<table>";
        echo "<tr><td style='font-size: 14px;'><strong>DIAS COMPRA</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['dias_compra']); // Días para la compra
        echo "<tr><td style='font-size: 14px;'><strong>DIAS TRABAJO</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['dias_trabajo']); // Días de trabajo
        echo "<tr><td style='font-size: 14px;'><strong>TRABAJADORES</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['trabajadores']); // Número de trabajadores
        echo "<tr><td style='font-size: 14px;'><strong>HORARIO</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['horario']); // Horario
        echo "<tr><td style='font-size: 14px;'><strong>COLACION</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['colacion']); // Colación
        echo "<tr><td style='font-size: 14px;'><strong>ENTREGA</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['entrega']); // Entrega
        echo "</table>";
        echo "</div>";

        // Fin del contenedor de detalles del proyecto
        echo "</div>";

        // Muestra el título de datos del cliente
        echo "<h3 style='margin: 0; font-size: 18px;'>DATOS CLIENTES</h3>";

        // Contenedor para los detalles del cliente
        echo "<div style='display: flex; justify-content: space-between; margin-top: 10px'>";
        
        // Primer bloque de detalles del cliente
        echo "<div>";
        echo "<table>";
        echo "<tr><td style='font-size: 14px;'><strong>SR/TA: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['nombre_cliente']); // Nombre del cliente
        echo "<tr><td style='font-size: 14px;'><strong>EMPRESA: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['empresa_cliente']); // Empresa del cliente
        echo "<tr><td style='font-size: 14px;'><strong>RUT: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['rut_cliente']); // RUT del cliente
        echo "<tr><td style='font-size: 14px;'><strong>DIRECCION: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['direccion_cliente']); // Dirección del cliente
        echo "<tr><td style='font-size: 14px;'><strong>OF./DEPTO</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['lugar_cliente']); // Oficina/departamento del cliente
        echo "<tr><td style='font-size: 14px;'><strong>FONO: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['telefono_cliente']); // Teléfono del cliente
        echo "<tr><td style='font-size: 14px;'><strong>E-MAIL: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['email_cliente']); // Correo electrónico del cliente
        echo "</table>";
        echo "</div>";

        // Segundo bloque de detalles del cliente alineado a la derecha
        echo "<div style='text-align: right; padding-right: 20px;'>";
        echo "<table>";
        echo "<tr><td style='font-size: 14px;'><strong>CARGO: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['cargo_cliente']); // Cargo del cliente
        echo "<tr><td style='font-size: 14px;'><strong>GIRO: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['giro_cliente']); // Giro del cliente
        echo "<tr><td style='font-size: 14px;'><strong>COMUNA: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['comuna_cliente']); // Comuna del cliente
        echo "<tr><td style='font-size: 14px;'><strong>CIUDAD: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['ciudad_cliente']); // Ciudad del cliente
        echo "</table>";
        echo "</div>";
        
        // Fin del contenedor de detalles del cliente
        echo "</div>";

        echo "<h3 style='margin: 20px; font-size: 18px;'>DATOS EMPRESA</h3>";  // Muestra el título "DATOS EMPRESA" con estilo de margen y tamaño de fuente

        echo "<div style='display: flex; justify-content: space-between; margin-top: 10px'>";  // Crea un contenedor flexible para los datos de la empresa
        echo "<div>";  // Contenedor para la tabla de datos del encargado
        
        echo "<table>";  // Inicia una tabla para mostrar los datos
        echo "<tr><td><strong>ENC. PROYEC.: </strong></td><td>" . htmlspecialchars($row['nombre_encargado']) ."</tr>";  // Fila de la tabla para el nombre del encargado del proyecto
        echo "<tr><td><strong>E-MAIL: </strong></td><td>" . htmlspecialchars($row['email_encargado']) . "</td></tr>";  // Fila de la tabla para el email del encargado
        echo "<tr><td><strong>FONO: </strong></td><td>" . htmlspecialchars($row['fono_encargado']) . "</td></tr>";  // Fila de la tabla para el teléfono del encargado
        echo "<tr><td><strong>WHATSAPP: </strong></td><td>" . htmlspecialchars($row['celular_encargado']) . "</td></tr>";  // Fila de la tabla para el WhatsApp del encargado
        echo "<tr><td><strong>TIPO CLIENTE: </strong></td><td>" . htmlspecialchars($row['tipo_cliente']) . "</td></tr>";  // Fila de la tabla para el tipo de cliente
        echo "<tr><td><strong>Validez</strong></td><td>" . htmlspecialchars($row['fecha_validez']) . "</td></tr>";  // Fila de la tabla para la validez de la cotización
        echo "</table>";  // Cierra la tabla
        
        echo "</div>";
        echo "<div style='text-align: right; padding-right: 20px;' >";  // Contenedor para la tabla de datos del vendedor, alineada a la derecha
        
        echo "<table>";  // Inicia una tabla para mostrar los datos del vendedor
        echo "<tr><td style='font-size: 14px;'><strong>VENDEDOR: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['nombre_vendedor']);  // Fila de la tabla para el nombre del vendedor
        echo "<tr><td style='font-size: 14px;'><strong>E-MAIL:  </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['email_vendedor']);  // Fila de la tabla para el email del vendedor
        echo "<tr><td style='font-size: 14px;'><strong>FONO:  </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['fono_vendedor']);  // Fila de la tabla para el teléfono del vendedor
        echo "<tr><td style='font-size: 14px;'><strong>WHATSAPP:  </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['celular_vendedor']);  // Fila de la tabla para el WhatsApp del vendedor
        echo "</table>";  // Cierra la tabla
        
        echo "</div>";
        echo "</div>";
        
        echo "<h3>Detalles del Servicio</h3>";  // Muestra el título "Detalles del Servicio"
        
        echo "<h4 style='margin: 0;'><strong>ESTIMADO SEÑOR(A)  :</h4>";  // Muestra el saludo con estilo de margen
        
        echo "<h5 style='margin: 0;'>DE ACUERDO A SU SOLICITUD DE COTIZACIÓN, TENEMOS EL AGRADO DE PRESENTAR NUESTRA OFERTA ECONOMICA :</h5>";  // Muestra el mensaje de presentación de la oferta económica
        
        echo "<table border='1' cellpadding='5' cellspacing='0' width='100%'>";  // Inicia una tabla con borde, padding, y ancho del 100%
        echo "<tr><th>Cantidad</th><th>Descripción</th><th>Precio Unitario</th><th>Total</th></tr>";  // Encabezado de la tabla con los nombres de las columnas
        echo "<tr>";  // Inicia una fila de la tabla
        echo "<td>" . htmlspecialchars($row['cantidad']) . "</td>";  // Muestra la cantidad del servicio
        echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";  // Muestra la descripción del servicio
        echo "<td>" . htmlspecialchars($row['precio_unitario']) . "</td>";  // Muestra el precio unitario del servicio
        echo "<td>" . htmlspecialchars($row['detalle_total']) . "</td>";  // Muestra el total del servicio (cantidad * precio unitario)
        echo "</tr>";  // Cierra la fila de la tabla
        echo "</table>";  // Cierra la tabla

        // Contenedor para la tabla de totales y descuentos
        echo "<div style='width: 100%; display: flex; justify-content: flex-end;'>"; // Inicio del contenedor flex

        // Tabla de totales y descuentos
        echo "<table border='1' cellpadding='5' cellspacing='0' width='48.9%'>"; // Inicio de la tabla

        // Fila de NETO
        echo "<tr><td colspan='3' align='right' ><strong>NETO</strong></td><td align='right'>" . htmlspecialchars($row['total']) . "</td></tr>"; // Fila de NETO

        // Fila de IVA 19%
        echo "<tr><td colspan='3' align='right'><strong>IVA 19%</strong></td><td align='right'>" . htmlspecialchars($row['iva']) . "</td></tr>"; // Fila de IVA 19%

        // Fila de TOTAL
        echo "<tr><td colspan='3' align='right'><strong>TOTAL</strong></td><td align='right'>" . htmlspecialchars($row['total']) . "</td></tr>"; // Fila de TOTAL

        // Fila de DESCUENTO 5%
        echo "<tr><td colspan='3' align='right'><strong>DESCUENTO 5%</strong></td><td align='right'>" . htmlspecialchars($row['descuento']) . "</td></tr>"; // Fila de DESCUENTO 5%

        // Cierre de la tabla
        echo "</table>"; // Fin de la tabla
        echo "</div>"; // Fin del contenedor flex

        // Contenedor para la descripción del adelanto para compra
        echo "<div style='margin-top: 40px;'>"; // Inicio del contenedor para la descripción

        // Tabla de adelanto para compra
        echo "<table border='1' cellpadding='5' cellspacing='0' width='100%'>"; // Inicio de la tabla

        // Fila de ADELANTO PARA COMPRA 30%
        echo "<tr>";
        echo "<td>ADELANTO PARA COMPRA 30%</td>"; // Celda de ADELANTO PARA COMPRA 30%
        echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>"; // Celda de descripción
        echo "</tr>"; // Fin de la fila

        // Cierre de la tabla
        echo "</table>"; // Fin de la tabla
        echo "</div>"; // Fin del contenedor para la descripción

        // Contenedor para las condiciones generales
        echo "<div style='margin-top: 40px;'>"; // Inicio del contenedor para las condiciones

        // Tabla de condiciones generales
        echo "<table>"; // Inicio de la tabla

        // Encabezado de condiciones generales
        echo "<tr><th style='background-color:lightgray'>CONDICIONES GENERALES</th></tr>"; // Encabezado de la tabla

        // Filas de condiciones generales
        echo "<tr><td>1.- VALORES EXPRESADOS SERAN FACTURADOS EN MONEDA NACIONAL.</td></tr>"; // Condición 1
        echo "<tr><td>2.- VALORES SUJETOS A VARIACION, DEBIDO A QUE LOS EQUIPOS, MATERIALES Y HERRAMIENTAS SON CALCULADOS CON EL VALOR DOLAR DIA</td></tr>"; // Condición 2
        echo "<tr><td>3.- LAS INSTALACIONES NO INCLUYEN EQUIPOS, MATERIALES, FERRETERIA U OTRO TIPO DE HERRAMIENTAS QUE SE REQUIERAN PARA EL TRABAJO, QUE NO SE ENCUENTRE DETALLADO DENTRO DE ESTA COTIZACION.</td></tr>"; // Condición 3
        echo "<tr><td>4.- GARANTIA 6 MESES, DESDE EL DIA DE LA ENTREGA, LA QUE CADUCA AUTOMATICAMENTE, EN CASO DE NO CUMPLIR LOS PAGOS, EN LAS FECHAS ACORDADAS</td></tr>"; // Condición 4
        echo "<tr><td>5.- GARANTIA 6 MESES, DESDE EL DIA DE LA ENTREGA, LA QUE CADUCA AUTOMATICAMENTE, EN CASO DE HABER MANIPULACION O INTERVENCION DE TERCEROS</td></tr>"; // Condición 5
        echo "<tr><td>6.- SI ALGUN TRABAJO, MATERIAL, PRODUCTO, EQUIPO, FERRETERIA O MANO DE OBRA, QUE NO SE ENCUENTRE EN ESTA COTIZACION, SE DEBERA COTIZAR Y AGREGAR EL VALOR A LA COTIZACION</td></tr>"; // Condición 6
        echo "<tr><td>7.- LUGAR DE TRABAJO LIBRE DE OBJETOS, QUE SE PUEDAN, ROMPER, DAÑAR O ENTORPECER EL TRABAJO, DE LO CONTRARIO, SE DEBERA COTIZAR Y AGREGAR EL MOVIMIENTO DE OBJETOS A LA COTIZACION</td></tr>"; // Condición 7
        echo "<tr><td>8.- EL CLIENTE DEBE INDICAR EL HORARIO DE ENTRADA Y DE SALIDA, CONTEMPLANDO QUE NUESTRO HORARIO DE TRABAJO ES DE LUNES A VIERNES DE 9:00 AM A 18:30HRS</td></tr>"; // Condición 8
        echo "<tr><td>9.- LOS DIAS DE TRABAJO, SON COTIZADOS DE LUNES A VIERNES DE 9:30AM A 18:30HRS., CON 1HR. DE COLACION, SI EL CLIENTE PRESENTA ALGUN PROBLEMA DE HORARIO O URGENCIAS, DEBERA DAR AVISO ANTES DE COMENZAR EL PROYECTO, PARA AGREGAR HORAS EXTRAS, VIATICOS Y TODO LO QUE CORRESPONDE PARA CUMPLIR CON LA URGENCIA DEL CLIENTE, YA SEA TRABAJO DESPUES DE LA HORA LABORAL, FIN DE SEMANA O FESTIVOS</td></tr>"; // Condición 9
        echo "<tr><td>10.- EL CLIENTE DEBE INDICAR LOS HORARIOS, EN LOS CUALES, SE PERMITE HACER RUIDOS FUERTES O INTERVENIR ENTRADAS, PASILLOS, CON MESONES, ESCALERAS, HERRAMIENTAS, ENTRE OTROS, ESTO ES MUY IMPORTANTE, PORQUE SI LOS HORARIOS SON MUY COMPLICADOS O REDUCIDOS, SE DEBERA RECALCULAR EL PRESUPUESTO</td></tr>"; // Condición 10

        // Cierre de la tabla
        echo "</table>"; // Fin de la tabla
        echo "</div>"; // Fin del contenedor para las condiciones

        // Sección de transferencias
        echo "<h2>TRANSFERENCIAS A:</h2>";  // Muestra el título "TRANSFERENCIAS A:"

        // Inicia una tabla para mostrar los detalles de las transferencias
        echo "<table>";
        echo "<tr><th>CHEQUERA ELECTRONICA ITRED SPA</th><th>CUENTA CORRIENTE PERSONAL</th><th>CUENTA RUT PERSONAL</th></tr>";  // Encabezado de la tabla con nombres de columnas para diferentes tipos de cuentas
        echo "<tr><td>BANCO: Banco Estado</td><td>BANCO: Santander</td><td>BANCO: Banco Estado</td></tr>";  // Fila de la tabla para los nombres de los bancos
        echo "<tr><td>TIPO CUENTA: Chequera electrónica</td><td>TIPO CUENTA: Cuenta corriente</td><td>TIPO CUENTA: Cuenta RUT</td></tr>";  // Fila de la tabla para los tipos de cuentas
        echo "<tr><td>NUMERO CUENTA: 902-7-053409-0</td><td>NUMERO CUENTA: 0-000-77-51325-6</td><td>NUMERO CUENTA: 15457398</td></tr>";  // Fila de la tabla para los números de cuenta
        echo "<tr><td>NOMBRE: ITRED SPA</td><td>NOMBRE: Barner Piña Jara</td><td>NOMBRE: Barner Piña Jara</td></tr>";  // Fila de la tabla para los nombres asociados a las cuentas
        echo "<tr><td>RUT: 77.243.277-1</td><td>RUT: 15.457.398-4</td><td>RUT: 15.457.398-4</td></tr>";  // Fila de la tabla para los RUTs asociados a las cuentas
        echo "<tr><td>E-MAIL: barnerp1@gmail.com</td><td>E-MAIL: barnerp1@gmail.com</td><td>E-MAIL: barnerp1@gmail.com</td></tr>";  // Fila de la tabla para los correos electrónicos asociados a las cuentas
        echo "</table>";  // Cierra la tabla

        // Mensaje de despedida
        echo "<p>SIN OTRO PARTICULAR, Y ESPERANDO QUE LA PRESENTE OFERTA SEA DE SU INTERÉS, SE DESPIDE ATENTAMENTE</p>";  // Muestra un mensaje de despedida formal
        echo "<p>BARNER PATRICIO PIÑA JARA</p>";  // Muestra el nombre del remitente
        echo "<p>JEFE DE PROYECTO TECNOLOGÍA Y CONSTRUCCIÓN</p>";  // Muestra el cargo del remitente
        echo "<p>ITRED SPA.</p>";  // Muestra el nombre de la empresa
        echo "</div>";  // Cierra el contenedor principal
    } else { // Si no se encuentra la cotización con el ID proporcionado
        echo "<p>No se encontró la cotización con el ID proporcionado.</p>"; // Mensaje de error cuando no se encuentra la cotización
    }
    $stmt->close(); // Cierra la declaración preparada
} else { // Si el ID proporcionado no es válido
    echo "<p>ID inválido.</p>"; // Mensaje de error cuando el ID es inválido
}

$conn->close(); // Cierra la conexión a la base de datos
?> 

<!DOCTYPE html> <!-- Define el tipo de documento como HTML5 -->
<html lang="es"> <!-- Define el idioma del contenido como español -->
<head>
    <meta charset="UTF-8"> <!-- Establece la codificación de caracteres a UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura el viewport para dispositivos móviles -->
    <title>Detalles de la Cotización</title> <!-- Define el título de la página que aparece en la pestaña del navegador -->
    <link rel="stylesheet" href="../../css/ver_cotizacion/ver_cotizacion.css"> <!-- Vincula el archivo de estilos CSS -->
</head>
<body>
    <ul> <!-- Crea una lista desordenada -->
        <li><a href="../formulario_cotizacion/formulario_cotizacion.php">Crear Cotización</a></li> <!-- Enlace para crear una nueva cotización -->
        <li><a href="../modificar_cotizacion/modificar_cotizacion.php?id=<?php echo $id; ?>">Modificar Cotización</a></li> <!-- Enlace para modificar la cotización actual, con ID incluido -->
        <li><a href="../eliminar_cotizacion/eliminar_cotizacion.php?id=<?php echo $id; ?>">Eliminar Cotización</a></li> <!-- Enlace para eliminar la cotización actual, con ID incluido -->
        <li><a href="../ver_listado/ver_listado.php">Volver al Listado</a></li> <!-- Enlace para volver al listado de cotizaciones -->
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