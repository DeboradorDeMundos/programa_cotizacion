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
    ------------------------------------- INICIO ITred Spa mostrar cliente.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
  

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Clientes</title>
    <link rel="stylesheet" href="../../css/crear_cliente/mostrar_clientes.css">

</head>
<body>

<!-- Título para el contenedor principal de la lista de clientes -->
<div class="contenedor">
    <h1>Listado de Clientes</h1>

    <!-- Título para el contenedor de la tabla de clientes -->
    <div class="tabla-contenedor-lista">
        <table>
            <!-- Título para el encabezado de la tabla -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>RUT Empresa</th>
                    <th>Nombre Empresa</th>
                    <th>Email</th>
                    <th>Giro</th>
                    <th>Comuna</th>
                    <th>Dirección</th>
                    <th>RUT Encargado</th>
                    <th>Nombre Encargado</th>
                    <th>Cargo Encargado</th>
                    <th>Teléfono Encargado</th>
                    <th>Email Encargado</th>
                    <th>Estado Encargado</th>
                    <th>Estado Empresa</th>
                </tr>
            </thead>
            <!-- Título para el cuerpo de la tabla donde se muestran los datos -->
            <tbody>
                <?php
                // Título: Consulta para obtener los datos de los clientes desde la base de datos
                $resultado = $mysqli->query("SELECT * FROM C_Clientes");

                // Título: Verificar si la consulta retorna algún resultado
                if ($resultado->num_rows > 0) {
                    // Título: Iterar sobre cada cliente y generar una fila en la tabla
                    while ($cliente = $resultado->fetch_assoc()) {
                        echo "<tr>
                                <td>{$cliente['id_cliente']}</td>
                                <td>{$cliente['rut_empresa_cliente']}</td>
                                <td>{$cliente['nombre_empresa_cliente']}</td>
                                <td>{$cliente['email_empresa_cliente']}</td>
                                <td>{$cliente['giro_empresa_cliente']}</td>
                                <td>{$cliente['comuna_empresa_cliente']}</td>
                                <td>{$cliente['direccion_empresa_cliente']}</td>
                                <td>{$cliente['rut_encargado_cliente']}</td>
                                <td>{$cliente['nombre_encargado_cliente']}</td>
                                <td>{$cliente['cargo_encargado_cliente']}</td>
                                <td>{$cliente['telefono_encargado_cliente']}</td>
                                <td>{$cliente['email_encargado_cliente']}</td>
                                <td>{$cliente['estado_encargado_cliente']}</td>
                                <td>{$cliente['estado_empresa_cliente']}</td>
                              </tr>";
                    }
                } else {
                    // Título: Caso en que no hay clientes registrados
                    echo "<tr><td colspan='17'>No hay clientes registrados.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../../js/crear_cliente/mostrar_clientes.js"></script>
</body>






<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa mostrar cliente .PHP ----------------------------------------
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