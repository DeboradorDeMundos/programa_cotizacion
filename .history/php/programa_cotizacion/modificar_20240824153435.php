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

// Obtener el ID de la cotización desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario
    $nombre = $_POST['nombre'];
    $codigo_prov = $_POST['codigo_prov'];
    $cliente_empresa = $_POST['cliente_empresa'];
    $cliente_rut = $_POST['cliente_rut'];
    $cliente_direccion = $_POST['cliente_direccion'];
    $cliente_fono = $_POST['cliente_fono'];
    $cliente_email = $_POST['cliente_email'];
    $cantidad = $_POST['cantidad'];
    $descripcion = $_POST['descripcion'];
    $precio_unitario = $_POST['precio_unitario'];
    $total = $cantidad * $precio_unitario; // Calcular el total

    // Preparar la consulta para actualizar la cotización
    $sql_cotizacion = "UPDATE Cotizaciones SET
                Nombre = ?, 
                CodigoProv = ?
            WHERE ID = ?";
    $stmt_cotizacion = $conn->prepare($sql_cotizacion);
    $stmt_cotizacion->bind_param(
        "ssi",
        $nombre,
        $codigo_prov,
        $id
    );

    // Preparar la consulta para actualizar los detalles del servicio
    $sql_detalle = "UPDATE DetalleServicios SET
                Cantidad = ?, 
                Descripcion = ?, 
                Precio_Unitario = ?, 
                Total = ?
            WHERE ID_Cotizacion = ?";
    $stmt_detalle = $conn->prepare($sql_detalle);
    $stmt_detalle->bind_param(
        "isddi",
        $cantidad,
        $descripcion,
        $precio_unitario,
        $total,
        $id
    );

    // Ejecutar las consultas de actualización
    $exito_cotizacion = $stmt_cotizacion->execute();
    $exito_detalle = $stmt_detalle->execute();

    if ($exito_cotizacion && $exito_detalle) {
        $mensaje = "<p>Cotización actualizada con éxito.</p>";
    } else {
        $mensaje = "<p>Error al actualizar la cotización.</p>";
    }
    $stmt_cotizacion->close();
    $stmt_detalle->close();
} else if ($id > 0) {
    // Preparar la consulta para obtener los detalles de la cotización
    $sql = "SELECT 
               c.id_cotizacion AS ID, 
               c.numero_cotizacion AS Numero, 
               c.fecha_emision AS FechaEmision, 
               c.fecha_validez AS FechaValidez, 
               c.dias_compra AS DiasCompra, 
               c.dias_trabajo AS DiasTrabajo, 
               c.trabajadores AS Trabajadores, 
               c.horario AS Horario, 
               c.colacion AS Colacion, 
               c.entrega AS Entrega, 
               c.id_cliente AS ClienteID, 
               c.id_proyecto AS ProyectoID, 
               c.id_empresa AS EmpresaID, 
               c.id_vendedor AS VendedorID, 
               c.id_encargado AS EncargadoID,
               c.total AS TotalGeneral, 
               c.descuento AS Descuento, 
               c.iva AS IVA, 
               c.total_con_descuento AS TotalConDescuento,
               
               cl.nombre_cliente AS ClienteNombre, 
               cl.empresa_cliente AS ClienteEmpresa, 
               cl.rut_cliente AS ClienteRUT, 
               cl.direccion_cliente AS ClienteDireccion, 
               cl.lugar_cliente AS ClienteLugar, 
               cl.telefono_cliente AS ClienteTelefono, 
               cl.email_cliente AS ClienteEmail, 
               cl.cargo_cliente AS ClienteCargo, 
               cl.giro_cliente AS ClienteGiro, 
               cl.comuna_cliente AS ClienteComuna, 
               cl.ciudad_cliente AS ClienteCiudad, 
               cl.tipo_cliente AS ClienteTipo,
               
               p.nombre_proyecto AS ProyectoNombre, 
               p.codigo_proyecto AS ProyectoCodigo, 
               p.tipo_trabajo AS ProyectoTipoTrabajo,
               p.area_trabajo AS ProyectoAreaTrabajo,
               p.riesgo_proyecto AS ProyectoRiesgo,

               e.nombre_encargado AS EncargadoNombre,
               e.email_encargado AS EncargadoEmail,
               e.fono_encargado AS EncargadoTelefono,
               e.celular_encargado AS EncargadoCelular,

               v.nombre_vendedor AS VendedorNombre,
               v.email_vendedor AS VendedorEmail,
               v.fono_vendedor AS VendedorTelefono,
               v.celular_vendedor AS VendedorCelular,
               
               emp.rut_empresa AS EmpresaRUT,
               emp.nombre_empresa AS EmpresaNombre,
               emp.area_empresa AS EmpresaArea,
               emp.direccion_empresa AS EmpresaDireccion,
               emp.telefono_empresa AS EmpresaTelefono,
               emp.email_empresa AS EmpresaEmail,
               
               ds.cantidad AS Cantidad, 
               d.descripcion AS DetalleDescripcion, 
               d.precio_unitario AS PrecioUnitario, 
               ds.cantidad * d.precio_unitario AS TotalDetalle
        FROM Cotizaciones c
        JOIN Clientes cl ON c.id_cliente = cl.id_cliente
        JOIN Proyectos p ON c.id_proyecto = p.id_proyecto
        JOIN Empresa emp ON c.id_empresa = emp.id_empresa
        LEFT JOIN Vendedores v ON c.id_vendedor = v.id_vendedor
        LEFT JOIN Encargados e ON c.id_encargado = e.id_encargado
        LEFT JOIN Detalle_Cotizacion ds ON c.id_cotizacion = ds.id_cotizacion
        LEFT JOIN Descripciones d ON ds.id_descripcion = d.id_descripcion
        WHERE c.id_cotizacion = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        $mensaje = "<p>No se encontró la cotización con el ID proporcionado.</p>";
    }
    $stmt->close();
} else {
    $mensaje = "<p>ID inválido.</p>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Cotización</title>
    <link rel="stylesheet" href="../../css/modificar/modificar.css">
</head>
<body>
    <?php echo isset($mensaje) ? $mensaje : ''; ?>
    
    <?php if (isset($row)): ?>
    <h1>Modificar Cotización</h1>
    <form method="POST" action="procesar_modificacion.php" enctype="multipart/form-data">
        <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                
            <div class="box-6 logo-box"> <!-- Crea una caja para el logo o foto de perfil, ocupando 6 de las 12 columnas disponibles en el diseño -->
                <!-- Imagen del logo o foto de perfil -->
                <label for="logo-upload" class="logo-container"> <!-- Etiqueta para el campo de carga de imagen. El atributo "for" enlaza con el input de archivo -->
                    <img src="http://localhost/Cotizacion_css_ITred_Spa_/imagenes/cotizacion/logo.png" alt="Logo de la Empresa" class="logo" id="logo-preview"> <!-- Muestra una imagen previa del logo con un texto alternativo en caso de que no se cargue la imagen -->
                    <input type="file" id="logo-upload" name="logo_upload" accept="image/*" style="display:none;"> <!-- Campo oculto para cargar el archivo del logo. Acepta solo archivos de imagen -->
                    <span>Cargar Logo de Empresa</span> <!-- Texto que aparece junto a la imagen para instruir al usuario a cargar el logo -->
                </label>
            </div>
                
            <div class="box-6 data-box data-box-red"> <!-- Crea una caja para ingresar datos, ocupando otras 6 columnas. Se aplica una clase adicional para estilo -->
                <label for="empresa_rut">RUT de la Empresa:</label> <!-- Etiqueta para el campo de entrada del RUT de la empresa -->
                <input type="text" id="empresa_rut" name="empresa_rut" value="<?php echo htmlspecialchars($row['EmpresaRUT']); ?>" required> <!-- Campo de texto para ingresar el RUT de la empresa. El atributo "required" hace que el campo sea obligatorio -->
                
                <input type="hidden" id="rut_empresa_original" name="rut_empresa_original" value="<?php echo htmlspecialchars($row['EmpresaRUT']); ?>">

                <label for="numero_cotizacion">Número de Cotización:</label> <!-- Etiqueta para el campo de entrada del número de cotización -->
                <input type="text" id="numero_cotizacion" name="numero_cotizacion" value="<?php echo htmlspecialchars($row['Numero']); ?>" required> <!-- Campo de texto para ingresar el número de cotización. También es obligatorio -->
                    
                <label for="validez_cotizacion">Validez de la Cotización:</label> <!-- Etiqueta para el campo de entrada de la validez de la cotización -->
                <input type="number" id="validez_cotizacion" name="validez_cotizacion" value="<?php echo htmlspecialchars($row['FechaValidez']); ?>" required> <!-- Campo de número para ingresar la validez de la cotización en días. El atributo "required" asegura que no se deje vacío -->
                    
                <label for="fecha_emision">Fecha de Emisión:</label> <!-- Etiqueta para el campo de entrada de la fecha de emisión -->
                <input type="date" id="fecha_emision" name="fecha_emision" value="<?php echo htmlspecialchars($row['FechaEmision']); ?>" required> <!-- Campo de fecha para seleccionar la fecha de emisión. Es obligatorio -->
            </div>
                
        </div> <!-- Cierra la fila -->

        <!-- Fila 2 -->
        <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
            <div class="box-12 data-box"> <!-- Crea una caja para ingresar datos, ocupando las 12 columnas disponibles en el diseño. Esta caja contiene varios campos de entrada de datos -->
        
                <label for="empresa_nombre">Nombre de la Empresa:</label> <!-- Etiqueta para el campo de entrada del nombre de la empresa -->
                <input type="text" id="empresa_nombre" name="empresa_nombre" value="<?php echo htmlspecialchars($row['EmpresaNombre']); ?>" required> <!-- Campo de texto para ingresar el nombre de la empresa. El atributo "required" hace que el campo sea obligatorio -->
        
                <label for="empresa_area">Área de la Empresa:</label> <!-- Etiqueta para el campo de entrada del área de la empresa -->
                <input type="text" id="empresa_area" name="empresa_area" value="<?php echo htmlspecialchars($row['EmpresaArea']); ?>"> <!-- Campo de texto para ingresar el área de la empresa. Este campo no es obligatorio -->
        
                <label for="empresa_direccion">Dirección de la Empresa:</label> <!-- Etiqueta para el campo de entrada de la dirección de la empresa -->
                <input type="text" id="empresa_direccion" name="empresa_direccion" value="<?php echo htmlspecialchars($row['EmpresaDireccion']); ?>"> <!-- Campo de texto para ingresar la dirección de la empresa. Este campo no es obligatorio -->
        
                <label for="empresa_telefono">Teléfono de la Empresa:</label> <!-- Etiqueta para el campo de entrada del teléfono de la empresa -->
                <input type="text" id="empresa_telefono" name="empresa_telefono" value="<?php echo htmlspecialchars($row['EmpresaTelefono']); ?>"> <!-- Campo de texto para ingresar el teléfono de la empresa. Este campo no es obligatorio -->
        
                <label for="empresa_email">Email de la Empresa:</label> <!-- Etiqueta para el campo de entrada del email de la empresa -->
                <input type="email" id="empresa_email" name="empresa_email" value="<?php echo htmlspecialchars($row['EmpresaEmail']); ?>"> <!-- Campo de correo electrónico para ingresar el email de la empresa. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
        
            </div> <!-- Cierra la caja de datos -->
        </div> <!-- Cierra la fila -->

        <!-- Fila 3 -->
        <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
            <div class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
                <label for="proyecto_nombre">Nombre del Proyecto:</label> <!-- Etiqueta para el campo de entrada del nombre del proyecto -->
                <input type="text" id="proyecto_nombre" name="proyecto_nombre" value="<?php echo htmlspecialchars($row['ProyectoNombre']); ?>" required> <!-- Campo de texto para ingresar el nombre del proyecto. El atributo "required" hace que el campo sea obligatorio -->
        
                <label for="proyecto_codigo">Código del Proyecto:</label> <!-- Etiqueta para el campo de entrada del código del proyecto -->
                <input type="text" id="proyecto_codigo" name="proyecto_codigo" value="<?php echo htmlspecialchars($row['ProyectoCodigo']); ?>" required> <!-- Campo de texto para ingresar el código del proyecto. También es obligatorio -->
        
                <input type="hidden" id="proyecto_codigo_original" name="proyecto_codigo_original" value="<?php echo htmlspecialchars($row['ProyectoCodigo']); ?>">

                <label for="area_trabajo">Área de Trabajo:</label> <!-- Etiqueta para el campo de entrada del área de trabajo -->
                <input type="text" id="area_trabajo" name="area_trabajo" value="<?php echo htmlspecialchars($row['ProyectoAreaTrabajo']); ?>" required> <!-- Campo de texto para ingresar el área de trabajo. Este campo es obligatorio -->
        
                <label for="tipo_trabajo">Tipo de Trabajo:</label> <!-- Etiqueta para el campo de entrada del tipo de trabajo -->
                <input type="text" id="tipo_trabajo" name="tipo_trabajo" value="<?php echo htmlspecialchars($row['ProyectoTipoTrabajo']); ?>" required> <!-- Campo de texto para ingresar el tipo de trabajo. También es obligatorio -->
        
                <label for="riesgo">Riesgo:</label> <!-- Etiqueta para el campo de entrada del riesgo asociado al proyecto -->
                <input type="text" id="riesgo" name="riesgo" value="<?php echo htmlspecialchars($row['ProyectoRiesgo']); ?>" required> <!-- Campo de texto para ingresar el nivel o tipo de riesgo. Este campo es obligatorio -->
            </div>
            <div class="box-6 data-box data-box-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "data-box-left" para estilo -->
                <label for="dias_compra">Días de Compra:</label> <!-- Etiqueta para el campo de entrada de los días de compra -->
                <input type="number" id="dias_compra" name="dias_compra" value="<?php echo htmlspecialchars($row['DiasCompra']); ?>"> <!-- Campo de número para ingresar la cantidad de días de compra. Este campo no es obligatorio -->
        
                <label for="dias_trabajo">Días de Trabajo:</label> <!-- Etiqueta para el campo de entrada de los días de trabajo -->
                <input type="number" id="dias_trabajo" name="dias_trabajo" value="<?php echo htmlspecialchars($row['DiasTrabajo']); ?>"> <!-- Campo de número para ingresar la cantidad de días de trabajo. No es obligatorio -->
        
                <label for="trabajadores">Número de Trabajadores:</label> <!-- Etiqueta para el campo de entrada del número de trabajadores -->
                <input type="number" id="trabajadores" name="trabajadores" value="<?php echo htmlspecialchars($row['Trabajadores']); ?>"> <!-- Campo de número para ingresar la cantidad de trabajadores. Este campo no es obligatorio -->
        
                <label for="horario">Horario:</label> <!-- Etiqueta para el campo de entrada del horario -->
                <input type="text" id="horario" name="horario" value="<?php echo htmlspecialchars($row['Horario']); ?>"> <!-- Campo de texto para ingresar el horario. Este campo no es obligatorio -->
        
                <label for="colacion">Colación:</label> <!-- Etiqueta para el campo de entrada de colación -->
                <input type="text" id="colacion" name="colacion" value="<?php echo htmlspecialchars($row['Colacion']); ?>"> <!-- Campo de texto para ingresar la información sobre la colación. No es obligatorio -->
        
                <label for="entrega">Entrega:</label> <!-- Etiqueta para el campo de entrada de la entrega -->
                <input type="text" id="entrega" name="entrega" value="<?php echo htmlspecialchars($row['Entrega']); ?>"> <!-- Campo de texto para ingresar detalles sobre la entrega. Este campo no es obligatorio -->
            </div>
        </div> <!-- Cierra la fila -->

        <!-- Fila 4 -->
        <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
            <div class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
                <label for="cliente_nombre">Nombre del Cliente:</label> <!-- Etiqueta para el campo de entrada del nombre del cliente -->
                <input type="text" id="cliente_nombre" name="cliente_nombre" value="<?php echo htmlspecialchars($row['ClienteNombre']); ?>" required> <!-- Campo de texto para ingresar el nombre del cliente. El atributo "required" hace que el campo sea obligatorio -->
        
                <label for="cliente_rut">RUT del Cliente:</label> <!-- Etiqueta para el campo de entrada del RUT del cliente -->
                <input type="text" id="cliente_rut" name="cliente_rut" value="<?php echo htmlspecialchars($row['ClienteRUT']); ?>" required> <!-- Campo de texto para ingresar el RUT del cliente. También es obligatorio -->
        
                <input type="hidden" id="cliente_rut_original" name="cliente_rut_original" value="<?php echo htmlspecialchars($row['ClienteRUT']); ?>" required>

                <label for="cliente_empresa">Empresa del Cliente:</label> <!-- Etiqueta para el campo de entrada de la empresa del cliente -->
                <input type="text" id="cliente_empresa" name="cliente_empresa" value="<?php echo htmlspecialchars($row['ClienteEmpresa']); ?>"> <!-- Campo de texto para ingresar el nombre de la empresa del cliente. Este campo no es obligatorio -->
        
                <label for="cliente_direccion">Dirección del Cliente:</label> <!-- Etiqueta para el campo de entrada de la dirección del cliente -->
                <input type="text" id="cliente_direccion" name="cliente_direccion" value="<?php echo htmlspecialchars($row['ClienteDireccion']); ?>"> <!-- Campo de texto para ingresar la dirección del cliente. No es obligatorio -->
        
                <label for="cliente_lugar">Lugar del Cliente:</label> <!-- Etiqueta para el campo de entrada del lugar del cliente -->
                <input type="text" id="cliente_lugar" name="cliente_lugar" value="<?php echo htmlspecialchars($row['ClienteLugar']); ?>"> <!-- Campo de texto para ingresar el lugar del cliente. Este campo no es obligatorio -->
        
                <label for="cliente_fono">Teléfono del Cliente:</label> <!-- Etiqueta para el campo de entrada del teléfono del cliente -->
                <input type="text" id="cliente_fono" name="cliente_fono" value="<?php echo htmlspecialchars($row['ClienteTelefono']); ?>"> <!-- Campo de texto para ingresar el teléfono del cliente. Este campo no es obligatorio -->
            </div>
            <div class="box-6 data-box data-box-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "data-box-left" para estilo -->
                <label for="cliente_email">Email del Cliente:</label> <!-- Etiqueta para el campo de entrada del email del cliente -->
                <input type="email" id="cliente_email" name="cliente_email" value="<?php echo htmlspecialchars($row['ClienteEmail']); ?>"> <!-- Campo de correo electrónico para ingresar el email del cliente. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
        
                <label for="cliente_cargo">Cargo del Cliente:</label> <!-- Etiqueta para el campo de entrada del cargo del cliente -->
                <input type="text" id="cliente_cargo" name="cliente_cargo" value="<?php echo htmlspecialchars($row['ClienteCargo']); ?>"> <!-- Campo de texto para ingresar el cargo del cliente. Este campo no es obligatorio -->
        
                <label for="cliente_giro">Giro del Cliente:</label> <!-- Etiqueta para el campo de entrada del giro del cliente -->
                <input type="text" id="cliente_giro" name="cliente_giro" value="<?php echo htmlspecialchars($row['ClienteGiro']); ?>"> <!-- Campo de texto para ingresar el giro o sector del cliente. No es obligatorio -->
        
                <label for="cliente_comuna">Comuna del Cliente:</label> <!-- Etiqueta para el campo de entrada de la comuna del cliente -->
                <input type="text" id="cliente_comuna" name="cliente_comuna" value="<?php echo htmlspecialchars($row['ClienteComuna']); ?>"> <!-- Campo de texto para ingresar la comuna del cliente. Este campo no es obligatorio -->
        
                <label for="cliente_ciudad">Ciudad del Cliente:</label> <!-- Etiqueta para el campo de entrada de la ciudad del cliente -->
                <input type="text" id="cliente_ciudad" name="cliente_ciudad" value="<?php echo htmlspecialchars($row['ClienteCiudad']); ?>"> <!-- Campo de texto para ingresar la ciudad del cliente. No es obligatorio -->
        
                <label for="cliente_tipo">Tipo de Cliente:</label> <!-- Etiqueta para el campo de entrada del tipo de cliente -->
                <input type="text" id="cliente_tipo" name="cliente_tipo" value="<?php echo htmlspecialchars($row['ClienteTipo']); ?>"> <!-- Campo de texto para ingresar el tipo de cliente. Este campo no es obligatorio -->
            </div>
        </div> <!-- Cierra la fila -->

        <!-- Fila 5 -->
        <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
            <div class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
                <label for="enc_nombre">Nombre del Encargado:</label> <!-- Etiqueta para el campo de entrada del nombre del encargado -->
                <input type="text" id="enc_nombre" name="enc_nombre" value="<?php echo htmlspecialchars($row['EncargadoNombre']); ?>"> <!-- Campo de texto para ingresar el nombre del encargado. Este campo no es obligatorio -->
        
                <label for="enc_email">Email del Encargado:</label> <!-- Etiqueta para el campo de entrada del email del encargado -->
                <input type="email" id="enc_email" name="enc_email" value="<?php echo htmlspecialchars($row['EncargadoEmail']); ?>"> <!-- Campo de correo electrónico para ingresar el email del encargado. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
        
                <label for="enc_fono">Teléfono del Encargado:</label> <!-- Etiqueta para el campo de entrada del teléfono del encargado -->
                <input type="text" id="enc_fono" name="enc_fono" value="<?php echo htmlspecialchars($row['EncargadoTelefono']); ?>"> <!-- Campo de texto para ingresar el teléfono del encargado. Este campo no es obligatorio -->
            </div>
            <div class="box-6 data-box data-box-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "data-box-left" para estilo -->
                <label for="enc_celular">Celular del Encargado:</label> <!-- Etiqueta para el campo de entrada del celular del encargado -->
                <input type="text" id="enc_celular" name="enc_celular" value="<?php echo htmlspecialchars($row['EncargadoCelular']); ?>"> <!-- Campo de texto para ingresar el número de celular del encargado. Este campo no es obligatorio -->
        
                <label for="enc_proyecto">Proyecto Asignado:</label> <!-- Etiqueta para el campo de entrada del proyecto asignado al encargado -->
                <input type="text" id="enc_proyecto" name="enc_proyecto" > <!-- Campo de texto para ingresar el nombre del proyecto asignado al encargado. No es obligatorio -->
            </div>
        </div> <!-- Cierra la fila -->

        <!-- Fila 6 -->
        <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
            <div class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
                <label for="vendedor_nombre">Nombre del Vendedor:</label> <!-- Etiqueta para el campo de entrada del nombre del vendedor -->
                <input type="text" id="vendedor_nombre" name="vendedor_nombre" value="<?php echo htmlspecialchars($row['VendedorNombre']); ?>" required> <!-- Campo de texto para ingresar el nombre del vendedor. El atributo "required" hace que el campo sea obligatorio -->
        
                <label for="vendedor_email">Email del Vendedor:</label> <!-- Etiqueta para el campo de entrada del email del vendedor -->
                <input type="email" id="vendedor_email" name="vendedor_email" value="<?php echo htmlspecialchars($row['VendedorEmail']); ?>" required> <!-- Campo de correo electrónico para ingresar el email del vendedor. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico. También es obligatorio -->
            </div>
            <div class="box-6 data-box data-box-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "data-box-left" para estilo -->
                <label for="vendedor_telefono">Teléfono del Vendedor:</label> <!-- Etiqueta para el campo de entrada del teléfono del vendedor -->
                <input type="text" id="vendedor_telefono" name="vendedor_telefono" value="<?php echo htmlspecialchars($row['VendedorTelefono']); ?>"> <!-- Campo de texto para ingresar el teléfono del vendedor. Este campo no es obligatorio -->
        
                <label for="vendedor_celular">Celular del Vendedor:</label> <!-- Etiqueta para el campo de entrada del celular del vendedor -->
                <input type="text" id="vendedor_celular" name="vendedor_celular" value="<?php echo htmlspecialchars($row['VendedorCelular']); ?>"> <!-- Campo de texto para ingresar el número de celular del vendedor. Este campo no es obligatorio -->
            </div>
        </div> <!-- Cierra la fila -->

            
        <!-- sección para Detalle de Cotización -->
        <fieldset> <!-- Define un grupo de campos relacionados en un formulario, usualmente con una leyenda para agrupar la información -->
            <legend>Detalle de la Cotización</legend> <!-- Proporciona un título para el grupo de campos dentro del fieldset -->
            <div id="detalle-container"> <!-- Crea un contenedor para los detalles de la cotización. Este contenedor se utilizará para agregar dinámicamente secciones de detalle -->
                <!-- Sección de Títulos -->
                <div class="detalle-section"> <!-- Define una sección dentro del contenedor para agregar títulos y otros detalles relacionados con la cotización -->
                    <button type="button" onclick="addDetailSection()">Agregar un nuevo título</button> <!-- Botón que permite agregar una nueva sección de detalle. La función JavaScript "addDetailSection()" se ejecutará cuando se haga clic en el botón -->
                </div>
            </div> <!-- Cierra el contenedor de detalles -->
        </fieldset> <!-- Cierra el fieldset -->

        <!-- Sección para los cálculos finales -->
        <div id="calculos-finales"> <!-- Crea un contenedor para mostrar los cálculos finales de la cotización -->
            <fieldset> <!-- Define un grupo de campos relacionados en un formulario -->
                <legend>Cálculos Finales</legend> <!-- Proporciona un título para el grupo de campos dentro del fieldset -->
                <table class="detalle-table"> <!-- Crea una tabla para mostrar los cálculos finales de la cotización -->
                    <thead> <!-- Define el encabezado de la tabla -->
                        <tr> <!-- Fila de encabezado de la tabla -->
                            <th>NETO</th> <!-- Encabezado de columna para el valor neto -->
                            <th>DESCUENTO</th> <!-- Encabezado de columna para el descuento aplicado -->
                            <th>IVA 19%</th> <!-- Encabezado de columna para el IVA del 19% -->
                            <th>TOTAL</th> <!-- Encabezado de columna para el total final -->
                        </tr>
                    </thead>
                    <tbody> <!-- Define el cuerpo de la tabla -->
                        <tr> <!-- Fila de datos de la tabla -->
                            <td><input type="number" id="detalle_neto" step="1" min="1" readonly></td> <!-- Campo de entrada para el valor neto. Solo lectura -->
                            <td><input type="number" id="detalle_descuento" step="0" min="0" value="0" oninput="calculateTotals()"></td> <!-- Campo de entrada para el descuento. Permite entrada y actualiza cálculos con la función "calculateTotals()" -->
                            <td><input type="number" id="detalle_iva" readonly></td> <!-- Campo de entrada para el IVA calculado. Solo lectura -->
                            <td><input type="number" id="detalle_total" step="0" min="0" readonly></td> <!-- Campo de entrada para el total final. Solo lectura -->
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </div>

        <button type="submit">Generar Cotización</button> <!-- Botón para enviar el formulario y generar la cotización -->
        </form> <!-- Cierra el formulario -->
        </div> <!-- Cierra el contenedor principal -->

        <!-- Fila 7 -->
        <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
            <div class="box-12 data-box"> <!-- Crea una caja para ingresar datos, ocupando las 12 columnas disponibles en el diseño -->
                <label for="observaciones">Observaciones Adicionales:</label> <!-- Etiqueta para el campo de entrada de observaciones adicionales -->
                <textarea id="observaciones" name="observaciones" rows="4" cols="50"></textarea> <!-- Campo de texto para ingresar observaciones adicionales. Permite múltiples líneas -->
            </div>
        </div>

        <!-- Botón de envío -->
        <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
            <div class="box-12"> <!-- Crea una caja para el botón de envío, ocupando las 12 columnas disponibles en el diseño -->
                <button type="submit" id="btnEnviar">Enviar Cotización</button> <!-- Botón para enviar el formulario y procesar la cotización -->
            </div>
        </div>
        
    <?php endif; ?>

    <ul>
        <li><a href="../prediseñados/ver_cotizacion.php?id=<?php echo $id; ?>">Ver Cotización</a></li>
        <li><a href="../ver_listado/ver_listado.php">Volver al Listado</a></li>
    </ul>
</body>
</html>
