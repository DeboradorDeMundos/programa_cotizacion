
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
    -------------------------------------- INICIO ITred Spa Agregar Banco .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
    
    // Esperar a que el contenido del DOM esté completamente cargado
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
    ---------------------------------------- FIN ITred Spa Agregar Banco .JS ---------------------------------------
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