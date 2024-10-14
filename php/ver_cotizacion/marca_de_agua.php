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

    <link rel="stylesheet" href="../../css/ver_cotizacion/marca_de_agua.css">
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
            display: none; /* Inicialmente oculto */
        }
        .horizontal-watermark {
            background-size: 150px; /* Ajusta el tamaño de la imagen de fondo */
            background-position: center; /* Centrar la imagen */
            filter: grayscale(100%); /* Aplicar filtro en blanco y negro */
        }
        .vertical-watermark {
            background-size: 150px; /* Ajusta el tamaño de la imagen de fondo */
            background-position: center; /* Centrar la imagen */
            transform: rotate(90deg);
            transform-origin: center; /* Asegura que la rotación sea desde el centro */
            filter: grayscale(100%); /* Aplicar filtro en blanco y negro */
        }
        .diagonal-watermark {
            background-size: 150px; /* Ajusta el tamaño de la imagen de fondo */
            transform: rotate(-45deg); /* Ajusta la rotación para diagonal */
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
            white-space: nowrap; /* Evita que el texto se divida en varias líneas */
        }

                /* Estilos para impresión */
        @media print {
            #form-marca-agua {
                display: none; /* Ocultar el formulario al imprimir */
            }
            .watermark {
                display: block; /* Asegurarse de que la marca de agua se muestre */
            }
        }
    </style>

    <div class="watermark horizontal-watermark"></div> <!-- Clase por defecto -->
    <div id="textoPersonalizado" class="texto-personalizado"></div> <!-- Div para texto personalizado -->

    <!-- Formulario para cambiar la marca de agua -->
    <form id="form-marca-agua" method="POST" action="" enctype="multipart/form-data">
        <label for="marca_agua">Seleccionar marca de agua:</label><br>
        
        <input type="radio" id="nombre_empresa" name="marca_agua" value="nombre_empresa" onchange="actualizarMarcaAgua()" checked>
        <label for="nombre_empresa">Nombre de la empresa</label><br>

        <input type="radio" id="foto_empresa" name="marca_agua" value="foto_empresa" onchange="actualizarMarcaAgua()">
        <label for="foto_empresa">Foto de la empresa</label><br>

        <input type="radio" id="imagen_personalizada" name="marca_agua" value="imagen_personalizada" onchange="subirImagen()">
        <label for="imagen_personalizada">Imagen Personalizada:</label>
        <input type="file" id="input_imagen_personalizada" name="imagen_personalizada" accept="image/*" style="display:none;">
        
        <input type="radio" id="texto_personalizado" name="marca_agua" value="texto_personalizado" onchange="activarTextoPersonalizado()">
        <label for="texto_personalizado">Texto Personalizado:</label>
        <input type="text" id="input_texto_personalizado" name="texto_personalizado" placeholder="Ingresa tu texto aquí" oninput="actualizarTexto()" style="display:none;">

        <br><br>
        <label for="disposicion">Disposición de la marca de agua:</label>
        <select name="disposicion" id="disposicion" onchange="actualizarMarcaAgua()">
            <option value="patron" selected>Patrón</option>
            <option value="centro">Centrado</option>
        </select>

        <label for="tipo_patron">Tipo de Patrón:</label>
        <select name="tipo_patron" id="tipo_patron" onchange="actualizarMarcaAgua()">
            <option value="horizontal" selected>Horizontal</option>
            <option value="vertical">Vertical</option>
            <option value="diagonal">Diagonal</option>
        </select>

        <label for="tamano">Tamaño de la marca de agua (en píxeles):</label>
        <input type="range" name="tamano" id="tamano" value="30" min="10" max="1000" oninput="actualizarTamano(this.value)">
        <span id="tamanoValor">30</span> px
    </form>

    <script>
        let imagenSubida = null;

        function activarTextoPersonalizado() {
            document.getElementById('input_texto_personalizado').style.display = 'inline';
            document.getElementById('input_imagen_personalizada').style.display = 'none'; // Asegúrate de ocultar la carga de imagen
        }

        function actualizarMarcaAgua() {
            const marcaAguaSeleccionada = document.querySelector('input[name="marca_agua"]:checked').value;
            const disposicionSeleccionada = document.getElementById('disposicion').value;
            const tipoPatronSeleccionado = document.getElementById('tipo_patron').value;

            // Ocultar todas las marcas de agua
            document.querySelector('.watermark').style.display = 'none'; 
            const watermark = document.querySelector('.watermark');
            const textoPersonalizadoDiv = document.getElementById('textoPersonalizado');
            
            // Limpiar el fondo de la marca de agua
            watermark.style.backgroundImage = 'none';
            textoPersonalizadoDiv.innerHTML = ''; // Limpiar texto personalizado

            // Establecer propiedades de la marca de agua seleccionada
            if (marcaAguaSeleccionada === 'nombre_empresa') {
                textoPersonalizadoDiv.innerHTML = '<?php echo $items[0]["nombre_empresa"]; ?>';
                textoPersonalizadoDiv.style.display = 'block'; // Mostrar texto
            } else if (marcaAguaSeleccionada === 'foto_empresa') {
                watermark.style.backgroundImage = 'url(<?php echo $ruta_foto; ?>)';
            } else if (marcaAguaSeleccionada === 'texto_personalizado') {
                textoPersonalizadoDiv.innerHTML = document.getElementById('input_texto_personalizado').value;
                textoPersonalizadoDiv.style.display = 'block'; // Mostrar texto
            }

            // Aplicar disposición
            if (disposicionSeleccionada === 'patron') {
                if (tipoPatronSeleccionado === 'horizontal') {
                    watermark.classList.add('horizontal-watermark');
                    watermark.classList.remove('vertical-watermark', 'diagonal-watermark');
                } else if (tipoPatronSeleccionado === 'vertical') {
                    watermark.classList.add('vertical-watermark');
                    watermark.classList.remove('horizontal-watermark', 'diagonal-watermark');
                } else if (tipoPatronSeleccionado === 'diagonal') {
                    watermark.classList.add('diagonal-watermark');
                    watermark.classList.remove('horizontal-watermark', 'vertical-watermark');
                }
            } else if (disposicionSeleccionada === 'centro') {
                watermark.classList.remove('horizontal-watermark', 'vertical-watermark', 'diagonal-watermark');
            } else {
                watermark.classList.remove('horizontal-watermark', 'vertical-watermark', 'diagonal-watermark');
            }

            // Mostrar la marca de agua
            watermark.style.display = 'block';
            actualizarTamano(document.getElementById('tamano').value); // Aplicar tamaño
        }

        function subirImagen() {
            const inputImagen = document.getElementById('input_imagen_personalizada');
            inputImagen.click(); // Abrir el diálogo de carga de imagen
            inputImagen.onchange = function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const watermark = document.querySelector('.watermark');
                        watermark.style.backgroundImage = 'url(' + e.target.result + ')';
                        watermark.style.display = 'block'; // Mostrar la marca de agua
                    }
                    reader.readAsDataURL(file);
                }
            }
        }

        function actualizarTamano(tamano) {
            const watermark = document.querySelector('.watermark');
            watermark.style.backgroundSize = tamano + 'px'; // Ajustar el tamaño
            document.getElementById('tamanoValor').textContent = tamano; // Actualizar el valor mostrado

            // Ajustar el tamaño del texto
            const textoPersonalizadoDiv = document.getElementById('textoPersonalizado');
            textoPersonalizadoDiv.style.fontSize = tamano + 'px'; // Actualiza el tamaño del texto
        }

        function actualizarTexto() {
            const textoPersonalizadoDiv = document.getElementById('textoPersonalizado');
            textoPersonalizadoDiv.innerHTML = document.getElementById('input_texto_personalizado').value;
        }

        // Inicializar la marca de agua al cargar
        window.onload = function() {
            actualizarMarcaAgua();
        };
    </script>



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
