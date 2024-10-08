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
    ------------------------------------- INICIO ITred Spa Formulario Cuenta.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
    <!-- Otros campos del formulario -->
    <link rel="stylesheet" href="../../css/crear_empresa/formulario_cuenta.css">
    <div class="row">
        <div class="box-12 data-box contenedor-cuentas-bancarias">
            <h2>Agrega tu cuenta bancaria:</h2>
            <div id="bank-cuentas">
                <!-- Campos de cuentas bancarias -->
                <div class="cuenta-bancaria">
                    <label for="nombre-cuenta">Nombre titular:</label>
                    <input type="text" id="nombre-cuenta" name="nombre_cuenta" 
                        placeholder="Ingresa el nombre del titular" 
                        maxlength="50" 
                        required 
                        oninput="ValidarNombre(this)" 
                        title="Por favor, ingresa solo letras y espacios.">

                    <label for="rut-titular">Rut titular:</label>
                    <input type="text" id="rut-titular" placeholder="Ej: 12.345.678-9" name="rut_titular" required oninput="formatoRut(this)">

                    <label for="celular">Celular:</label>
                    <input type="text" id="celular" name="celular"
                        placeholder="+56 9 1234 1234" 
                        maxlength="11" 
                        required 
                        pattern="^\+\d{2}\s\d{1}\s\d{4}\s\d{4}$" 
                        title="Formato válido: +56 9 1234 1234 (código de país, seguido de número)"
                        oninput="FormatearNumeroTelefono(this)">

                    <label for="email-banco">Email:</label>
                    <input type="email" id="email-banco" name="email_banco" 
                        placeholder="ejemplo@empresa.com" 
                        maxlength="255" 
                        title="Ingresa un correo electrónico válido, como ejemplo@empresa.com" 
                        onblur="CompletarEmail(this)">

                    <label for="id-banco">Banco:</label>
                    <select id="id-banco" name="id_banco" required>
                        <!-- Opciones se llenarán con los datos de la tabla Bancos -->
                    </select>

                    <label for="id-tipocuenta">Tipo de Cuenta:</label>
                    <select id="id-tipocuenta" name="id_tipocuenta" required>
                        <!-- Opciones se llenarán con los datos de la tabla Tipo_Cuenta -->
                    </select>

                    <label for="numero-cuenta">Número de Cuenta:</label>
                    <input type="text" id="numero-cuenta" name="numero_cuenta" required oninput="QuitarCaracteresInvalidos(this)">
                </div>
                
                <button type="button" id="boton-agregar-boton" onclick="AgregarCuenta()">Agregar otra cuenta</button>
            </div>
        </div>
    </div>

    <input type="hidden" id="hidden-cuentas" name="hidden_accounts" value="">

<script src="../../js/crear_empresa/formulario_cuenta.js"></script>
<script src="../../js/nueva_cotizacion/load_bancos.js"></script> 
<script src="../../js/nueva_cotizacion/loadTipoCuenta.js"></script> 
<script src="../../js/nueva_cotizacion/agregar_banco.js"></script>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener las cuentas bancarias del formulario
    $cuentasString = isset($_POST['cuentas_bancarias']) ? $_POST['cuentas_bancarias'] : '';

    // Función para obtener el ID de un banco basado en el nombre
    function getIdBanco($mysqli, $nombreBanco) {
        $stmt = $mysqli->prepare("SELECT id_banco FROM e_bancos WHERE nombre_banco = ?");
        $stmt->bind_param("s", $nombreBanco);
        $stmt->execute();
        $stmt->bind_result($id_banco);
        $stmt->fetch();
        $stmt->close();
        return $id_banco;
    }

    // Función para obtener el ID de un tipo de cuenta basado en el nombre
    function getIdTipoCuenta($mysqli, $nombreTipoCuenta) {
        $stmt = $mysqli->prepare("SELECT id_tipocuenta FROM e_tipo_cuenta WHERE tipocuenta = ?");
        $stmt->bind_param("s", $nombreTipoCuenta);
        $stmt->execute();
        $stmt->bind_result($id_tipocuenta);
        $stmt->fetch();
        $stmt->close();
        return $id_tipocuenta;
    }

    // Verificamos que haya datos de cuentas bancarias
    if (!empty($cuentasString)) {
        $cuentasArray = explode('|', $cuentasString);

        foreach ($cuentasArray as $cuenta) {
            $datosCuenta = explode(',', $cuenta);

            if (count($datosCuenta) == 7) {
                $nombre_titular = $datosCuenta[0];
                $rut_titular = $datosCuenta[1];
                $celular = $datosCuenta[2];
                $email_banco = $datosCuenta[3];
                $nombre_banco = $datosCuenta[4];
                $nombre_tipocuenta = $datosCuenta[5];
                $numero_cuenta = $datosCuenta[6];

                // Obtener los IDs de banco y tipo de cuenta
                $id_banco = getIdBanco($mysqli, $nombre_banco);
                $id_tipocuenta = getIdTipoCuenta($mysqli, $nombre_tipocuenta);

                // Verificar que se obtuvieron los IDs correctamente
                if ($id_banco && $id_tipocuenta) {
                    // Insertar la cuenta bancaria con el id_empresa recién creado
                    $sql = "INSERT INTO E_Cuenta_Bancaria (nombre_titular, rut_titular, id_banco, id_tipocuenta, numero_cuenta, celular, email_banco, id_empresa)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                    $stmt = $mysqli->prepare($sql);
                    if ($stmt === false) {
                        die("Error en la preparación de la consulta: " . $mysqli->error);
                    }

                    // Vincular los parámetros y ejecutar la consulta
                    $stmt->bind_param("ssiisssi", $nombre_titular, $rut_titular, $id_banco, $id_tipocuenta, $numero_cuenta, $celular, $email_banco, $id_empresa);

                    if ($stmt->execute()) {
                        echo "Cuenta bancaria insertada correctamente. ID: " . $stmt->insert_id . "<br>";
                    } else {
                        echo "Error al insertar la cuenta bancaria: " . $stmt->error . "<br>";
                    }

                    $stmt->close();
                } else {
                    echo "Error: No se pudo obtener el ID del banco o del tipo de cuenta.<br>";
                }
            } else {
                echo "Error: Formato incorrecto en los datos de la cuenta bancaria.<br>";
            }
        }
    } else {
        echo "No se proporcionaron cuentas bancarias.<br>";
    }
}
?>
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Formulario Cuenta .PHP ----------------------------------------
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
