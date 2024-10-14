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
    ------------------------------------- INICIO ITred Spa Marca de agua .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
<?php
// Establecer la conexión a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');

// Comprobar conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_cotizacion = (int) $_GET['id'];
} else {
    die("Error: ID de cotización no válida.");
}

// Consulta para obtener los datos de la empresa, cliente y detalles de la cotización
$query = "
    SELECT 
        cot.id_empresa,
        cot.numero_cotizacion,
        e.nombre_empresa,
        e.area_empresa,
        e.direccion_empresa,
        e.telefono_empresa,
        e.email_empresa,
        e.web_empresa,
        e.rut_empresa,
        e.id_foto,
        c.nombre_cliente,
        c.rut_cliente,
        c.direccion_cliente,
        c.giro_cliente,
        c.comuna_cliente,
        c.ciudad_cliente,
        c.telefono_cliente,
        cot.fecha_emision,
        cot.fecha_validez,
        enc.nombre_encargado,
        enc.rut_encargado,
        enc.email_encargado,
        enc.fono_encargado,
        enc.celular_encargado,
        ven.nombre_vendedor,
        ven.rut_vendedor,
        ven.email_vendedor,
        ven.fono_vendedor,
        ven.celular_vendedor
    FROM C_Cotizaciones cot
    JOIN C_Clientes c ON cot.id_cliente = c.id_cliente
    JOIN E_Empresa e ON cot.id_empresa = e.id_empresa
    JOIN C_Encargados enc ON cot.id_encargado = enc.id_encargado 
    JOIN C_Vendedores ven ON cot.id_vendedor = ven.id_vendedor 
    WHERE cot.id_cotizacion = ?
";

// Preparar la consulta
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id_cotizacion);

// Ejecutar la consulta
$stmt->execute();

// Obtener los resultados
$result = $stmt->get_result();

// Verificar si hay resultados
if ($result->num_rows > 0) {
    $items = $result->fetch_all(MYSQLI_ASSOC);
    $id_empresa = $items[0]['id_empresa']; // Guardar id_empresa para la siguiente consulta
    $id_foto = $items[0]['id_foto']; // Guardar id_foto para cargar la imagen

    $query_foto = "SELECT ruta_foto FROM e_fotosperfil WHERE id_foto = ?";
    $stmt_foto = $mysqli->prepare($query_foto);
    $stmt_foto->bind_param("i", $id_foto);
    
    // Ejecutar la consulta para la foto
    $stmt_foto->execute();
    $result_foto = $stmt_foto->get_result();
    
    // Verificar si se encontró la foto
    if ($result_foto->num_rows > 0) {
        $foto = $result_foto->fetch_assoc();
        $ruta_foto = $foto['ruta_foto']; // Obtener la ruta de la foto
    } else {
        $ruta_foto = null; // No se encontró la foto
    }
} else {
    echo "No se encontró la cotización o la empresa relacionada.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/ver_cotizacion/marca_de_agua.css">
    <title>Marca de Agua</title>
    <style>
        .watermark {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.1; /* Ajusta la opacidad según sea necesario */
            background-repeat: repeat;
            pointer-events: none; /* Asegúrate de que no interfiera con otros elementos */
        }
        .horizontal-watermark {
            background-image: url('<?php echo $ruta_foto; ?>');
            background-size: 150px; /* Ajusta el tamaño de la imagen de fondo */
            background-position: center; /* Centrar la imagen */
            filter: grayscale(100%); /* Aplicar filtro en blanco y negro */
        }
        .diagonal-watermark {
            background-image: url('<?php echo $ruta_foto; ?>');
            background-size: 150px; /* Ajusta el tamaño de la imagen de fondo */
            background-position: center; /* Centrar la imagen */
            transform: rotate(-45deg);
            transform-origin: center; /* Asegura que la rotación sea desde el centro */
            filter: grayscale(100%); /* Aplicar filtro en blanco y negro */
        }
        .texto-personalizado {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            color: rgba(0, 0, 0, 0.1); /* Color y opacidad */
            font-size: 30px; /* Tamaño de fuente por defecto */
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="watermark <?php echo $ruta_foto ? 'horizontal-watermark' : ''; ?>"></div> <!-- Aplica la clase horizontal por defecto -->
    <div id="textoPersonalizado" class="texto-personalizado"></div> <!-- Div para texto personalizado -->

    <!-- Formulario para cambiar la marca de agua -->
    <form id="form-marca-agua" method="POST" action="" enctype="multipart/form-data">
        <label for="nombre_empresa">Nombre de la empresa:</label>
        <input type="checkbox" id="nombre_empresa" name="nombre_empresa" checked onchange="actualizarMarcaAgua()">
        
        <label for="foto_empresa">Foto de la empresa:</label>
        <input type="checkbox" id="foto_empresa" name="foto_empresa" checked onchange="actualizarMarcaAgua()">
        
        <label for="imagen_personalizada">Imagen Personalizada:</label>
        <input type="file" id="imagen_personalizada" name="imagen_personalizada" accept="image/*" onchange="subirImagen()">
        
        <label for="texto_personalizado">Texto Personalizado:</label>
        <input type="text" id="texto_personalizado" name="texto_personalizado" placeholder="Ingresa tu texto aquí" oninput="actualizarTexto()">
        
        <label for="disposicion">Disposición de la marca de agua:</label>
        <select name="disposicion" id="disposicion" onchange="actualizarMarcaAgua()">
            <option value="horizontal" selected>Horizontal</option>
            <option value="diagonal">Diagonal</option>
        </select>

        <label for="tamano">Tamaño de la marca de agua (en píxeles):</label>
        <input type="range" name="tamano" id="tamano" value="30" min="10" max="100" oninput="actualizarTamano(this.value)">
        <span id="tamanoValor">30</span> px

        <input type="submit" value="Aplicar">
    </form>

    <script>
        let imagenSubida = null;

        function actualizarMarcaAgua() {
            const disposicion = document.getElementById('disposicion').value;
            const fotoEmpresa = document.getElementById('foto_empresa').checked;
            const nombreEmpresa = document.getElementById('nombre_empresa').checked;
            
            const watermarkDiv = document.querySelector('.watermark');

            // Cambiar clase de disposición
            watermarkDiv.className = 'watermark ' + (disposicion === 'diagonal' ? 'diagonal-watermark' : 'horizontal-watermark');

            // Mostrar u ocultar la foto de la empresa
            if (!fotoEmpresa) {
                watermarkDiv.style.backgroundImage = 'none';
            } else {
                watermarkDiv.style.backgroundImage = `url('<?php echo $ruta_foto; ?>')`;
            }

            // Mostrar u ocultar el nombre de la empresa
            if (nombreEmpresa) {
                document.getElementById('textoPersonalizado').innerText = "<?php echo $items[0]['nombre_empresa']; ?>"; // Cambia por el nombre real
            } else {
                document.getElementById('textoPersonalizado').innerText = "";
            }
        }

        function subirImagen() {
            const fileInput = document.getElementById('imagen_personalizada');
            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                imagenSubida = e.target.result;
                const watermarkDiv = document.querySelector('.watermark');
                watermarkDiv.style.backgroundImage = `url(${imagenSubida})`;
                watermarkDiv.style.filter = 'none'; // Remover filtro en blanco y negro si hay imagen personalizada
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function actualizarTexto() {
            const textoPersonalizado = document.getElementById('texto_personalizado').value;
            document.getElementById('textoPersonalizado').innerText = textoPersonalizado;
        }

        function actualizarTamano(tamano) {
            document.getElementById('tamanoValor').innerText = tamano;
            document.getElementById('textoPersonalizado').style.fontSize = tamano + 'px';
        }
    </script>
</body>
</html>
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa  Marca de agua .PHP -----------------------------------
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
