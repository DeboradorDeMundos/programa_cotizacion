document.addEventListener('DOMContentLoaded', function() {
    let accountIndex = 1;
    const container = document.getElementById('bank-accounts');

    function loadSelectOptions() {
        fetch('get_select_options.php')
            .then(response => response.json())
            .then(data => {
                // Inicializar las opciones en todos los selects ya existentes
                document.querySelectorAll('select[name="id_banco[]"]').forEach(select => {
                    select.innerHTML = '<option value="">Seleccione un Banco</option>';
                    data.bancos.forEach(banco => {
                        const option = document.createElement('option');
                        option.value = banco.id_banco;
                        option.textContent = banco.nombre_banco;
                        select.appendChild(option);
                    });
                });

                document.querySelectorAll('select[name="id_tipocuenta[]"]').forEach(select => {
                    select.innerHTML = '<option value="">Seleccione un Tipo de Cuenta</option>';
                    data.tiposCuenta.forEach(tipo => {
                        const option = document.createElement('option');
                        option.value = tipo.id_tipocuenta;
                        option.textContent = tipo.nombre_tipocuenta;
                        select.appendChild(option);
                    });
                });
            })
            .catch(error => console.error('Error al cargar las opciones:', error));
    }

    function addAccount() {
        if (accountIndex < 3) { // Limitar a un máximo de 3 cuentas
            accountIndex++;
            const newAccount = document.createElement('div');
            newAccount.className = 'bank-account';
            newAccount.innerHTML = `
                <label for="nombre-cuenta-${accountIndex}">Nombre de la Cuenta:</label>
                <input type="text" id="nombre-cuenta-${accountIndex}" name="nombre_cuenta[]" required>

                <label for="id-banco-${accountIndex}">Banco:</label>
                <select id="id-banco-${accountIndex}" name="id_banco[]" required>
                    <!-- Opciones se llenarán con los datos de la tabla Bancos -->
                </select>

                <label for="id-tipocuenta-${accountIndex}">Tipo de Cuenta:</label>
                <select id="id-tipocuenta-${accountIndex}" name="id_tipocuenta[]" required>
                    <!-- Opciones se llenarán con los datos de la tabla Tipo_Cuenta -->
                </select>

                <label for="numero-cuenta-${accountIndex}">Número de Cuenta:</label>
                <input type="text" id="numero-cuenta-${accountIndex}" name="numero_cuenta[]" required>

                <label for="nombre-encargado-${accountIndex}">Nombre del Encargado:</label>
                <input type="text" id="nombre-encargado-${accountIndex}" name="nombre_encargado[]" required>

                <label for="rut-banco-${accountIndex}">RUT del Banco:</label>
                <input type="text" id="rut-banco-${accountIndex}" name="rut_banco[]" required>

                <label for="email-banco-${accountIndex}">Email del Banco:</label>
                <input type="email" id="email-banco-${accountIndex}" name="email_banco[]" required>
            `;
            container.appendChild(newAccount);

            // Cargar opciones para los nuevos selects
            loadSelectOptions();
        } else {
            alert('No se pueden agregar más de 3 cuentas bancarias.');
        }
    }

    document.getElementById('add-account-btn').addEventListener('click', addAccount);

    // Inicializar las opciones de selección en la carga de la página
    loadSelectOptions();
});

/* 
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Agui Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ 
*/


/* --------------------------------------------------------------------------------------------------------------
    -------------------------------------- INICIO ITred Spa agregar .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */



/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Crear Proveedor .JS ---------------------------------------
    ------------------------------------------------------------------------------------------------------------- */


/*
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Agui Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
*/