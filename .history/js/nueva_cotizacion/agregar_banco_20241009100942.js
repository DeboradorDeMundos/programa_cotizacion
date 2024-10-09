
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
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('formulario-cotizacion').addEventListener('submit', function(event) {
        event.preventDefault();

    document.addEventListener('DOMContentLoaded', function() {
        let IndiceCuentas = 1;
        const contenedor = document.getElementById('bank-cuentas');
    
        function CargarOpcionSeleccionada() {
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
    
        function Agregarcuenta() {
            if (IndiceCuentas < 3) { // Limitar a un máximo de 3 cuentas
                IndiceCuentas++;
                const NuevaCuenta = document.createElement('div');
                NuevaCuenta.className = 'cuenta-bancaria';
                NuevaCuenta.innerHTML = `
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
                contenedor.appendChild(NuevaCuenta);
    
                // Cargar opciones para los nuevos selects
                CargarOpcionSeleccionada();
            } else {
                alert('No se pueden agregar más de 3 cuentas bancarias.');
            }
        }
    
        document.getElementById('add-account-btn').addEventListener('click', Agregarcuenta);
    
        // Inicializar las opciones de selección en la carga de la página
        CargarOpcionSeleccionada();
    });
    

});
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