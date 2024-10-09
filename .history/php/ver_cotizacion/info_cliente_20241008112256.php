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
    ------------------------------------- INICIO ITred Spa info cliente .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

     <?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');
?>
<table class="customer-info">
    <tbody>
        <tr>
            <td>
                <strong>SEÑOR(ES):</strong> <?php echo $items[0]['nombre_cliente']; ?><br>
                <strong>RUT:</strong> <?php echo $items[0]['rut_cliente']; ?><br>
                <strong>DIRECCIÓN:</strong> <?php echo $items[0]['direccion_cliente']; ?><br>
                <strong>GIRO:</strong> <?php echo $items[0]['giro_cliente']; ?><br>
                <strong>COMUNA:</strong> <?php echo $items[0]['comuna_cliente']; ?><br>
                <strong>CIUDAD:</strong> <?php echo $items[0]['ciudad_cliente']; ?><br>
                <strong>TELÉFONO:</strong> <?php echo $items[0]['telefono_cliente']; ?><br>
                <strong>FORMA PAGO:</strong> <!-- Aquí iría la forma de pago (déjalo vacío) -->
            </td>
            <td>
                <strong>F. EMISIÓN:</strong> <?php echo $items[0]['fecha_emision']; ?><br>
                <strong>F. VENCIMIENTO:</strong> <?php echo $items[0]['fecha_validez']; ?><br>
                <strong>CABECERA:</strong><br>
                <strong>CABECERA1:</strong> <!-- Aquí puedes agregar más información si es necesario -->
            </td>
        </tr>
        <tr>
            <td colspan="1">
                <strong>ENCARGADO:</strong><br>
                <strong>NOMBRE:</strong> <?php echo $items[0]['nombre_encargado']; ?><br>
                <strong>RUT:</strong> <?php echo $items[0]['rut_encargado']; ?><br>
                <strong>EMAIL:</strong> <?php echo $items[0]['email_encargado']; ?><br>
                <strong>TELÉFONO:</strong> <?php echo $items[0]['fono_encargado']; ?><br>
                <strong>CELULAR:</strong> <?php echo $items[0]['celular_encargado']; ?><br>
            </td>
            <td colspan="1">
                <strong>VENDEDOR:</strong><br>
                <strong>NOMBRE:</strong> <?php echo $items[0]['nombre_vendedor']; ?><br>
                <strong>RUT:</strong> <?php echo $items[0]['rut_vendedor']; ?><br>
                <strong>EMAIL:</strong> <?php echo $items[0]['email_vendedor']; ?><br>
                <strong>TELÉFONO:</strong> <?php echo $items[0]['fono_vendedor']; ?><br>
                <strong>CELULAR:</strong> <?php echo $items[0]['celular_vendedor']; ?><br>
            </td>
        </tr>
    </tbody>
</table>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa  info cliente .PHP -----------------------------------
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
