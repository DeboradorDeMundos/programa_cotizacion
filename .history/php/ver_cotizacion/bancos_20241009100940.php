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
    ------------------------------------- INICIO ITred Spa bancos .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

     <?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');
?>
<div class="barcode-contenedor">

<table>
    <tr>
        <?php foreach ($bancos as $banco): ?>
        <td>
            <strong>BANCO:</strong> <?php echo $banco['nombre_banco']; ?><br>
            <strong>TIPO CUENTA:</strong> <?php echo $banco['tipocuenta']; ?><br>
            <strong>N° CUENTA:</strong> <?php echo $banco['numero_cuenta']; ?><br>
            <strong>RUT:</strong> <?php echo $banco['rut_titular']; ?><br>
            <strong>TITULAR:</strong> <?php echo $banco['nombre_titular']; ?><br>
            <strong>ENVIAR EMAIL A:</strong> <?php echo $banco['email_banco']; ?>
        </td>
        <?php endforeach; ?>
    </tr>
</table>

</div>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa  bancos .PHP -----------------------------------
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
