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
    ------------------------------------- INICIO ITred Spa Procesar creacion empresa .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

<?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');
?>
<!-- ---------------------
     -- FIN CONEXION BD --
     --------------------- -->
<?php
    // Recibir datos adicionales del formulario para la cotización
    $numero_cotizacion = $_POST['numero_cotizacion'];
    $validez_cotizacion = $_POST['validez_cotizacion'];
      

    // Obtener el último número de cotización para la empresa específica
    $sql_last_cot = "SELECT numero_cotizacion FROM c_cotizaciones WHERE id_empresa = ? ORDER BY id_cotizacion DESC LIMIT 1";
    $stmt_last_cot = $mysqli->prepare($sql_last_cot);
    $stmt_last_cot->bind_param("i", $id_empresa);
    $stmt_last_cot->execute();
    $stmt_last_cot->bind_result($last_num_cotizacion);
    $stmt_last_cot->fetch();
    $stmt_last_cot->close();

    if ($last_num_cotizacion) {
        $numero_cotizacion = (int)$last_num_cotizacion + 1; // Incrementa para mantener el correlativo dentro de la empresa
    } else {
        $numero_cotizacion = $numero_cotizacion; // Si no hay registros, empieza desde 1
    }

    // Insertar la cotización inicial en la base de datos con solo los campos básicos
    $sql_cotizacion = "INSERT INTO c_cotizaciones (
        numero_cotizacion, fecha_emision , fecha_validez, id_cliente, id_proyecto, id_empresa, id_vendedor, 
        id_encargado
    ) VALUES (?, NULL ,NULL, NULL, NULL, ?, NULL, NULL)"; // Los campos que no tienes aún pueden ser NULL

    $stmt_cotizacion = $mysqli->prepare($sql_cotizacion);
    if ($stmt_cotizacion === false) {
        die("Error en la preparación de la consulta de cotización: " . $mysqli->error);
    }

    $stmt_cotizacion->bind_param("si", 
        $numero_cotizacion,
        $id_empresa
        
    );

    $stmt_cotizacion->execute();
    if ($stmt_cotizacion->error) {
        die("Error en la ejecución de la consulta de cotización: " . $stmt_cotizacion->error);
    }

    echo "Cotización creada correctamente con el ID: " . $mysqli->insert_id . "<br>";



    // Cierra la declaración de cotización
    $stmt_cotizacion->close();




    // Redirigir a una página de éxito
    header('Location: ../../programa_cotizacion.php'); // Cambia 'exito.php' por la página a la que quieras redirigir
    exit();
?>

<!-- ---------------------
-- INICIO CIERRE CONEXION BD --
     --------------------- -->
<?php
     $mysqli->close();
?>
<!-- ---------------------
     -- FIN CIERRE CONEXION BD --
     --------------------- -->

<!-- ------------------------------------------------------------------------------------------------------------
-------------------------------------- FIN ITred Spa Procesar Creacion Empresa .PHP -----------------------------------
------------------------------------------------------------------------------------------------------------- -->

<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Agui Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa
BPPJ
-->