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
    ------------------------------------- INICIO ITred Spa Formulario encargado .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
    <link rel="stylesheet" href="../../css/crear_empresa/formulario_encargado.css">

<!-- Tabla para agregar encargados -->
<fieldset class="box-12 data-box"> 
    <legend>Datos encargado</legend>
    <table id="tabla-encargados" class="tabla-estilizada">
        <thead>
            <tr>
                <th>RUT del Encargado</th>
                <th>Nombre del Encargado</th>
                <th>Cargo</th>
                <th>Email del Encargado</th>
                <th>Teléfono del Encargado</th>
                <th>Celular del Encargado</th>
                <th>Acción</th> <!-- Nueva columna para eliminar -->
            </tr>
        </thead>
        <tbody id="formulario-contenedor">
            <tr>
                <td><input type="text" name="encargado_rut[]" required minlength="3" maxlength="20" 
                    pattern="^[0-9]+[-kK0-9]{1}$" placeholder="Ejemplo: 12345678-9" oninput="formatoRut(this)"></td>
                <td><input type="text" name="encargado_nombre[]" required minlength="3" maxlength="255" 
                    pattern="^[A-Za-zÀ-ÿ\s.-]+$" placeholder="Ejemplo: Juan Pérez" oninput="QuitarCaracteresInvalidos(this)"></td>
                <td>
                    <select name="cargo_encargado[]" required>
                        <option value="" disabled selected>Selecciona un cargo</option>
                        <option value="gerente">Gerente</option>
                        <option value="director">Director</option>
                        <option value="ejecutivo">Ejecutivo</option>
                        <option value="supervisor">Supervisor</option>
                    </select>
                </td>
                <td><input type="email" name="encargado_email[]" placeholder="ejemplo@empresa.com" maxlength="255" required></td>
                <td><input type="text" name="encargado_fono[]" placeholder="+56 9 1234 1234" maxlength="11" required></td>
                <td><input type="text" name="encargado_celular[]" placeholder="+56 9 1234 1234" maxlength="11" required></td>
                <td><button type="button" class="eliminar-fila" onclick="eliminarFila(this)">Eliminar</button></td>
            </tr>
        </tbody>
    </table>
    <button type="button" onclick="agregarNuevaFila()">Agregar otro encargado</button>
</fieldset>

<!-- Js correspondiente a formulario_encargado -->
<script src="../../js/crear_empresa/formulario_encargado.js"></script>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $encargados_rut = $_POST['encargado_rut'];
    $encargados_nombre = $_POST['encargado_nombre'];
    $encargados_cargo = $_POST['cargo_encargado'];
    $encargados_email = $_POST['encargado_email'];
    $encargados_fono = $_POST['encargado_fono'];
    $encargados_celular = $_POST['encargado_celular'];

    // Recorre los datos y realiza la inserción en la base de datos
    for ($i = 0; $i < count($encargados_rut); $i++) {
        $rut_encargado = $encargados_rut[$i];
        $nombre_encargado = $encargados_nombre[$i];
        $cargo_encargado = $encargados_cargo[$i];
        $email_encargado = $encargados_email[$i];
        $fono_encargado = $encargados_fono[$i];
        $celular_encargado = $encargados_celular[$i];

        // Inserta cada encargado en la base de datos
        $sql_encargado = "INSERT INTO E_Encargados (rut_encargado, nombre_encargado, cargo_encargado, email_encargado, fono_encargado, celular_encargado, id_empresa)
                          VALUES ('$rut_encargado', '$nombre_encargado', '$cargo_encargado', '$email_encargado', '$fono_encargado', '$celular_encargado', $id_empresa)";
        $mysqli->query($sql_encargado);
    }

    echo "Encargados creados correctamente.";
}
?>
<!-- ----------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Formulario encargado  .PHP ----------------------------------------
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
