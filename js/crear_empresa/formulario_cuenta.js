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
    
// TÍTULO PARA LA GESTIÓN DE CUENTAS BANCARIAS
    // Este script permite agregar, validar y mostrar cuentas bancarias en una tabla, limitando el número de cuentas y haciendo que los campos sean opcionales después de agregar la primera cuenta.
    let cuentas = []; // Array para almacenar las cuentas bancarias
    let cuenta = false; // Variable para verificar si al menos una cuenta ha sido agregada

// TÍTULO PARA AGREGARCUENTA
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

// TÍTULO PARA HACERCAMPOOPCIONAL
    // Función para hacer que los campos de cuenta sean opcionales
    function HacerCampoOpcional() {
        const campos = ['nombre-cuenta', 'rut-titular', 'celular', 'email-banco', 'id-banco', 'id-tipocuenta', 'numero-cuenta'];
        campos.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            field.removeAttribute('required'); // Elimina el atributo requerido de cada campo
        });
    }

// TÍTULO PARA ACTUALIZARTABLA
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
// TÍTULO PARA ACTUALIZAR CAMPOS OCULTOS
    // Función para actualizar los campos ocultos con la información de las cuentas
    function ActualizarCamposOcultos() {
        const hiddenInput = document.getElementById('hidden-cuentas');
        hiddenInput.value = cuentas.map(account => 
            `${account.nombre}|${account.rut}|${account.celular}|${account.email}|${account.banco}|${account.tipoCuenta}|${account.numeroCuenta}`
        ).join(';'); // Convierte el array de cuentas en una cadena separada por ';'
    }

// TÍTULO PARA VALIDARNOMBRE
    // Función para validar el nombre ingresado, eliminando caracteres no permitidos
    function ValidarNombre(input) {
        // Eliminar caracteres no permitidos (números y caracteres especiales)
        input.value = input.value.replace(/[^a-zA-ZÀ-ÿ\s]/g, '');
    }

// TÍTULO PARA DOCUMENT.ADD_EVENTLISTENER('DOMCONTENLOADED')
    // Función para inicializar la carga de elementos del DOM
    document.addEventListener('DOMContentLoaded', function() {

// TÍTULO PARA CARGAR BANCOS
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
// TÍTULO PARA CARGAR TIPO CUENTA
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

// TÍTULO PARA ASEGURAR MAS
    // Función para asegurar que el '+' esté presente y detectar el país
    function asegurarMas(input) {
        // Verificar si el valor actual comienza con '+'
        if (!input.value.startsWith('+')) {
            input.value = '+' + input.value.replace(/^\+/, ''); // Agregar '+' al inicio si no está presente
        }

        // Permitir solo números después del '+' y mantener el '+'
        const validCharacters = input.value.replace(/[^0-9]/g, ''); // Eliminar caracteres no válidos, excepto '+'
        input.value = input.value[0] + validCharacters; // Mantener el '+' y agregar solo los números
    }


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