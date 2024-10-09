/* 
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ 
*/


/* --------------------------------------------------------------------------------------------------------------
    -------------------------------------- Inicio ITred Spa Formulario Cuenta .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
    
    let cuentas = []; // Array para almacenar las cuentas bancarias
    let cuenta = false; // Variable para verificar si al menos una cuenta ha sido agregada
    
    // Función para agregar una cuenta
    function AgregarCuenta() {
        // Obtiene los valores de los campos de entrada
        const nombreCuenta = document.getElementById('nombre-cuenta').value;
        const rutTitular = document.getElementById('rut-titular').value;
        const celular = document.getElementById('celular').value;
        const emailBanco = document.getElementById('email-banco').value;
        const idBanco = document.getElementById('id-banco').options[document.getElementById('id-banco').selectedIndex].text;
        const tipoCuenta = document.getElementById('id-tipocuenta').options[document.getElementById('id-tipocuenta').selectedIndex].text;
        const numeroCuenta = document.getElementById('numero-cuenta').value;
    
        // Verifica que todos los campos estén llenos
        if (nombreCuenta && rutTitular && celular && emailBanco && idBanco && tipoCuenta && numeroCuenta) {
            // Limita el número de cuentas a 4
            if (cuentas.length >= 4) {
                alert('Solo puedes agregar un máximo de 4 cuentas bancarias.');
                return; // Termina la función si se alcanza el límite
            }
    
            // Agrega la nueva cuenta al array de cuentas
            cuentas.push({
                nombre: nombreCuenta,
                rut: rutTitular,
                celular: celular,
                email: emailBanco,
                banco: idBanco,
                tipoCuenta: tipoCuenta,
                numeroCuenta: numeroCuenta
            });
    
            // Actualiza la tabla que muestra las cuentas
            ActualizarTabla();
    
            // Limpia los campos de entrada
            document.getElementById('nombre-cuenta').value = '';
            document.getElementById('rut-titular').value = '';
            document.getElementById('celular').value = '';
            document.getElementById('email-banco').value = '';
            document.getElementById('id-banco').selectedIndex = 0;
            document.getElementById('id-tipocuenta').selectedIndex = 0;
            document.getElementById('numero-cuenta').value = '';
    
            // Marca que al menos una cuenta ha sido agregada y hace que los campos sean opcionales
            if (!cuenta) {
                cuenta = true;
                HacerCampoOpcional();
            }
    
            // Verifica la selección de firma
            VerificarSeleccionFirma();
    
            // Actualiza los campos ocultos con la información de las cuentas
            ActualizarCamposOcultos();
        } else {
            alert('Por favor, complete todos los campos.'); // Mensaje de advertencia si falta información
        }
    }
    
    // Función para hacer que los campos de cuenta sean opcionales
    function HacerCampoOpcional() {
        const campos = ['nombre-cuenta', 'rut-titular', 'celular', 'email-banco', 'id-banco', 'id-tipocuenta', 'numero-cuenta'];
        campos.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            field.removeAttribute('required'); // Elimina el atributo requerido de cada campo
        });
    }
    
    // Función para actualizar la tabla de cuentas
    function ActualizarTabla() {
        const table = document.getElementById('tabla-cuentas');
        table.innerHTML = ''; // Limpia la tabla antes de agregar nuevos datos
    
        if (cuentas.length === 0) return; // Si no hay cuentas, no hace nada
    
        // Crea una fila de encabezado para la tabla
        const FilaCabecera = document.createElement('tr');
        cuentas.forEach(account => {
            const th = document.createElement('th');
            th.innerText = `${account.tipoCuenta} - ${account.nombre}`; // Agrega el tipo y nombre de cuenta al encabezado
            FilaCabecera.appendChild(th);
        });
        table.appendChild(FilaCabecera); // Añade el encabezado a la tabla
    
        // Array de títulos de filas para la tabla
        const rows = [
            'Banco',
            'Tipo de Cuenta',
            'Número de Cuenta',
            'Nombre de la Cuenta',
            'RUT',
            'Email'
        ];
    
        // Agrega los datos de cada cuenta a la tabla
        rows.forEach(rowTitle => {
            const row = document.createElement('tr');
            cuentas.forEach(account => {
                const cell = document.createElement('td');
                switch (rowTitle) {
                    case 'Banco':
                        cell.innerText = 'Banco: ' + account.banco; // Muestra el nombre del banco
                        break;
                    case 'Tipo de Cuenta':
                        cell.innerText = 'Tipo de cuenta: ' + account.tipoCuenta; // Muestra el tipo de cuenta
                        break;
                    case 'Número de Cuenta':
                        cell.innerText = 'Numero de cuenta: ' + account.numeroCuenta; // Muestra el número de cuenta
                        break;
                    case 'Nombre de la Cuenta':
                        cell.innerText = 'Nombre de cuenta: ' + account.nombre; // Muestra el nombre de la cuenta
                        break;
                    case 'RUT':
                        cell.innerText = 'Rut: ' + account.rut; // Muestra el RUT
                        break;
                    case 'Email':
                        cell.innerText = 'Email: ' + account.email; // Muestra el email
                        break;
                }
                row.appendChild(cell); // Añade la celda a la fila
            });
            table.appendChild(row); // Añade la fila a la tabla
        });
    }
    
    // Actualiza los campos ocultos con la información de las cuentas
    function ActualizarCamposOcultos() {
        const hiddenInput = document.getElementById('hidden-cuentas');
        hiddenInput.value = cuentas.map(account => 
            `${account.nombre}|${account.rut}|${account.celular}|${account.email}|${account.banco}|${account.tipoCuenta}|${account.numeroCuenta}`
        ).join(';'); // Convierte el array de cuentas en una cadena separada por ';'
    }
    
    // Función para validar el nombre ingresado, eliminando caracteres no permitidos
    function ValidarNombre(input) {
        // Eliminar caracteres no permitidos (números y caracteres especiales)
        input.value = input.value.replace(/[^a-zA-ZÀ-ÿ\s]/g, '');
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Función para llenar el select de bancos
        function CargarBancos() {
            // Realiza una solicitud para obtener la lista de bancos desde el servidor
            fetch('../../php/crear_empresa/get_bancos.php')
                .then(response => response.text())  // Leer el contenido de la respuesta como texto (HTML)
                .then(data => {
                    const select = document.getElementById('id-banco'); // Obtener el elemento select por su ID
                    select.innerHTML = data;  // Insertar directamente las opciones generadas en el select
                })
                .catch(error => console.error('Error al cargar bancos:', error)); // Manejar errores de la solicitud
        }
    
        // Cargar bancos al cargar la página
        CargarBancos(); // Llamar a la función para cargar los bancos
    });

    
    document.addEventListener('DOMContentLoaded', function() {
        // Función para cargar los tipos de cuenta
        function CargarTipoCuenta() {
            // Realiza una solicitud para obtener la lista de tipos de cuenta desde el servidor
            fetch('../../php/crear_empresa/get_tipos_cuenta.php')
                .then(response => response.text())  // Leer el contenido de la respuesta como texto (HTML)
                .then(data => {
                    const select = document.getElementById('id-tipocuenta'); // Obtener el elemento select por su ID
                    select.innerHTML = data;  // Insertar directamente las opciones generadas en el select
                })
                .catch(error => console.error('Error al cargar tipo de cuenta:', error)); // Manejar errores de la solicitud
        }
    
        // Cargar tipos de cuenta al cargar la página
        CargarTipoCuenta(); // Llamar a la función para cargar los tipos de cuenta
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Agregar un evento de escucha para el envío del formulario de cotización
        document.getElementById('formulario-cotizacion').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevenir el envío del formulario para manejarlo manualmente
        });

        // Configurar variables y contenedor para las cuentas bancarias
        let IndiceCuentas = 1; // Contador de cuentas
        const contenedor = document.getElementById('bank-cuentas'); // Contenedor de cuentas bancarias

        // Función para cargar las opciones seleccionadas en los selects
        function CargarOpcionSeleccionada() {
            fetch('get_select_options.php') // Hacer una solicitud para obtener opciones
                .then(response => response.json()) // Parsear la respuesta como JSON
                .then(data => {
                    // Inicializar las opciones en todos los selects ya existentes
                    document.querySelectorAll('select[name="id_banco[]"]').forEach(select => {
                        select.innerHTML = '<option value="">Seleccione un Banco</option>'; // Opción predeterminada
                        data.bancos.forEach(banco => { // Recorrer los bancos recibidos
                            const option = document.createElement('option'); // Crear una nueva opción
                            option.value = banco.id_banco; // Asignar valor
                            option.textContent = banco.nombre_banco; // Asignar texto visible
                            select.appendChild(option); // Agregar la opción al select
                        });
                    });

                    // Similar para los tipos de cuenta
                    document.querySelectorAll('select[name="id_tipocuenta[]"]').forEach(select => {
                        select.innerHTML = '<option value="">Seleccione un Tipo de Cuenta</option>'; // Opción predeterminada
                        data.tiposCuenta.forEach(tipo => { // Recorrer los tipos de cuenta recibidos
                            const option = document.createElement('option'); // Crear una nueva opción
                            option.value = tipo.id_tipocuenta; // Asignar valor
                            option.textContent = tipo.nombre_tipocuenta; // Asignar texto visible
                            select.appendChild(option); // Agregar la opción al select
                        });
                    });
                })
                .catch(error => console.error('Error al cargar las opciones:', error)); // Manejo de errores
        }

        // Función para agregar una nueva cuenta bancaria
        function Agregarcuenta() {
            if (IndiceCuentas < 3) { // Limitar a un máximo de 3 cuentas
                IndiceCuentas++; // Incrementar el contador
                const NuevaCuenta = document.createElement('div'); // Crear un nuevo div para la cuenta
                NuevaCuenta.className = 'cuenta-bancaria'; // Asignar clase al div
                NuevaCuenta.innerHTML = ` // Establecer el contenido HTML de la nueva cuenta
                    <label for="nombre-cuenta-${IndiceCuentas}">Nombre de la Cuenta:</label>
                    <input type="text" id="nombre-cuenta-${IndiceCuentas}" name="nombre_cuenta[]" required>

                    <label for="id-banco-${IndiceCuentas}">Banco:</label>
                    <select id="id-banco-${IndiceCuentas}" name="id_banco[]" required>
                        <!-- Opciones se llenarán con los datos de la tabla Bancos -->
                    </select>

                    <label for="id-tipocuenta-${IndiceCuentas}">Tipo de Cuenta:</label>
                    <select id="id-tipocuenta-${IndiceCuentas}" name="id_tipocuenta[]" required>
                        <!-- Opciones se llenarán con los datos de la tabla Tipo_Cuenta -->
                    </select>

                    <label for="numero-cuenta-${IndiceCuentas}">Número de Cuenta:</label>
                    <input type="text" id="numero-cuenta-${IndiceCuentas}" name="numero_cuenta[]" required>

                    <label for="nombre-encargado-${IndiceCuentas}">Nombre del Encargado:</label>
                    <input type="text" id="nombre-encargado-${IndiceCuentas}" name="nombre_encargado[]" required>

                    <label for="rut-banco-${IndiceCuentas}">RUT del Banco:</label>
                    <input type="text" id="rut-banco-${IndiceCuentas}" name="rut_banco[]" required>

                    <label for="email-banco-${IndiceCuentas}">Email del Banco:</label>
                    <input type="email" id="email-banco-${IndiceCuentas}" name="email_banco[]" required>
                `;
                contenedor.appendChild(NuevaCuenta); // Agregar la nueva cuenta al contenedor

                // Cargar opciones para los nuevos selects
                CargarOpcionSeleccionada(); // Llamar a la función para llenar los selects
            } else {
                alert('No se pueden agregar más de 3 cuentas bancarias.'); // Mensaje de alerta si se excede el límite
            }
        }

        // Agregar evento para el botón de agregar cuenta
        document.getElementById('add-account-btn').addEventListener('click', Agregarcuenta);

        // Inicializar las opciones de selección en la carga de la página
        CargarOpcionSeleccionada(); // Llamar a la función al cargar la página
    });



/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Formulario Cuenta .JS ---------------------------------------
    ------------------------------------------------------------------------------------------------------------- */


/*
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
*/