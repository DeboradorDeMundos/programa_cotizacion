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

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

     <?php
// Establece la conexión a la base de datos de ITred Spa
$conn = new mysqli('localhost', 'root', '', 'ITredSpa_bd');
?>
<!-- ---------------------
     -- FIN CONEXION BD --
     --------------------- -->


<div class="row">
    <div class="box-12 data-box bank-account-container">
        <h2>Agrega tu cuenta bancaria:</h2>
        <div id="bank-accounts">
            <!-- Campos de cuentas bancarias -->
            <div class="bank-account">
                
                <label for="nombre-cuenta">Nombre titular:</label>
                <input type="text" id="nombre-cuenta" name="nombre_cuenta" required>

                <label for="rut-banco">Rut titular:</label>
                <input type="text" id="rut-titular" name="rut_titular" required>

                <label for="nombre-encargado">Celular:</label>
                <input type="number" id="celular" name="celular" required>

                <label for="email-banco">Email:</label>
                <input type="email" id="email-banco" name="email_banco" required>

                <label for="id-banco">Banco:</label>
                <select id="id-banco" name="id_banco" required>
                    <!-- Opciones se llenarán con los datos de la tabla Bancos -->
                </select>

                <label for="id-tipocuenta">Tipo de Cuenta:</label>
                <select id="id-tipocuenta" name="id_tipocuenta" required>
                    <!-- Opciones se llenarán con los datos de la tabla Tipo_Cuenta -->
                </select>
            
                <label for="numero-cuenta">Número de Cuenta:</label>
                <input type="text" id="numero-cuenta" name="numero_cuenta" required>
            </div>
            <button type="button" id="add-account-button" onclick="addAccount()">Agregar otra cuenta</button>
        </div>
    </div>
</div>




<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Cuadro Rojo .PHP ----------------------------------------
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
