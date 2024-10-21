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
    ------------------------------------- INICIO ITred Spa Formulario Vendedor.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
<link rel="stylesheet" href="../../css/crear_empresa/formulario_vendedor.css">

<!-- TÍTULO: TABLA PARA AGREGAR VENDEDORES -->
<fieldset class="box-12 data-box"> 
    <legend>Datos Vendedor</legend>
    
    <!-- TÍTULO: TABLA QUE CONTIENE LOS DATOS DE LOS VENDEDORES -->
        <table id="tabla-vendedores" class="tabla-estilizada">
            <thead>
                <tr>
                    <!-- TÍTULO: ENCABEZADO PARA EL RUT DEL VENDEDOR -->
                        <th>RUT del Vendedor</th>
                    <!-- TÍTULO: ENCABEZADO PARA EL NOMBRE DEL VENDEDOR -->
                        <th>Nombre del Vendedor</th>
                    <!-- TÍTULO: ENCABEZADO PARA EL EMAIL DEL VENDEDOR -->
                        <th>Email del Vendedor</th>
                    <!-- TÍTULO: ENCABEZADO PARA EL TELÉFONO DEL VENDEDOR -->
                        <th>Teléfono del Vendedor</th>
                    <!-- TÍTULO: ENCABEZADO PARA EL CELULAR DEL VENDEDOR -->
                        <th>Celular del Vendedor</th>
                    <!-- TÍTULO: ENCABEZADO PARA LA ACCIÓN DE ELIMINAR -->
                        <th>Acción</th> <!-- Columna para eliminar -->
                </tr>
            </thead>
            <tbody id="formulario-contenedor-vendedores">
                <tr>
                    <!-- TÍTULO: CAMPO DE ENTRADA PARA EL RUT DEL VENDEDOR -->
                        <td><input type="text" name="vendedor_rut[]" required minlength="3" maxlength="20" 
                            pattern="^[0-9]+[-kK0-9]{1}$" placeholder="Ejemplo: 12345678-9" oninput="formatoRut(this)"></td>
                    <!-- TÍTULO: CAMPO DE ENTRADA PARA EL NOMBRE DEL VENDEDOR -->
                        <td><input type="text" name="vendedor_nombre[]" required minlength="3" maxlength="255" 
                            pattern="^[A-Za-zÀ-ÿ\s.-]+$" placeholder="Ejemplo: Juan Pérez" oninput="QuitarCaracteresInvalidos(this)"></td>
                    <!-- TÍTULO: CAMPO DE ENTRADA PARA EL EMAIL DEL VENDEDOR -->
                        <td><input type="email" name="vendedor_email[]" placeholder="ejemplo@empresa.com" maxlength="100" required></td>
                    <!-- TÍTULO: CAMPO DE ENTRADA PARA EL TELÉFONO DEL VENDEDOR -->
                        <td><input type="text" name="vendedor_fono[]" placeholder="+56 9 1234 1234" maxlength="20" required></td>
                    <!-- TÍTULO: CAMPO DE ENTRADA PARA EL CELULAR DEL VENDEDOR -->
                        <td><input type="text" name="vendedor_celular[]" placeholder="+56 9 1234 1234" maxlength="20" required></td>
                    <!-- TÍTULO: BOTÓN PARA ELIMINAR LA FILA CORRESPONDIENTE -->
                        <td><button type="button" class="eliminar-fila" onclick="eliminarFila(this)" style="background-color: red; color: white;">Eliminar</button></td>
                </tr>
            </tbody>
        </table>
    <!-- TÍTULO: BOTÓN PARA AGREGAR OTRO VENDEDOR -->
        <button type="button" onclick="agregarNuevaFilaVendedor()">Agregar otro vendedor</button>
</fieldset>

<script src="../../js/crear_empresa/formulario_vendedor.js"></script>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vendedores_rut = $_POST['vendedor_rut'];
    $vendedores_nombre = $_POST['vendedor_nombre'];
    $vendedores_email = $_POST['vendedor_email'];
    $vendedores_fono = $_POST['vendedor_fono'];
    $vendedores_celular = $_POST['vendedor_celular'];

    // Recorre los datos y realiza la inserción en la base de datos
    for ($i = 0; $i < count($vendedores_rut); $i++) {
        $rut_vendedor = $vendedores_rut[$i];
        $nombre_vendedor = $vendedores_nombre[$i];
        $email_vendedor = $vendedores_email[$i];
        $fono_vendedor = $vendedores_fono[$i];
        $celular_vendedor = $vendedores_celular[$i];

        // Inserta cada vendedor en la base de datos
        $sql_vendedor = "INSERT INTO C_Vendedores (rut_vendedor, nombre_vendedor, email_vendedor, fono_vendedor, celular_vendedor)
                          VALUES ('$rut_vendedor', '$nombre_vendedor', '$email_vendedor', '$fono_vendedor', '$celular_vendedor')";
        $mysqli->query($sql_vendedor);
    }

    echo "Vendedores creados correctamente.";
}
?>

<!-- ----------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Formulario Vendedor .PHP ----------------------------------------
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
