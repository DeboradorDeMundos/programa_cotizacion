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
    -------------------------------------- INICIO ITred Spa crear_empresa .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
    
    // Función para formatear un RUT (número de identificación chileno) en el campo de entrada
    function formatoRut(input) {
        // Obtiene el valor del campo y elimina cualquier carácter que no sea numérico
        let rut = input.value.replace(/\D/g, '');

        // Si el RUT tiene más de 9 caracteres, se limita a los primeros 9 (incluyendo el dígito verificador)
        if (rut.length > 9) {
            rut = rut.slice(0, 9);
        }

        // Aplica el formato al RUT. Si tiene más de 1 dígito, coloca un punto cada 3 dígitos y un guion antes del último
        if (rut.length > 1) {
            rut = rut.slice(0, -1).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '-' + rut.slice(-1);
        }

        // Establece el valor del input formateado
        input.value = rut;

        // Limita la longitud total del input, asegurándose de que no exceda el formato esperado (12 caracteres)
        if (input.value.length > 12) {
            input.value = input.value.slice(0, 12);
        }
    }

    // Configura el botón de agregar requisitos
    document.getElementById('boton-agregar-requisito').addEventListener('click', AgregarRequisito);

    // Configura el botón de agregar obligaciones
    document.getElementById('boton-agregar-obligacion').addEventListener('click', AgregarObligacion);

    // Configura el botón de agregar condiciones
    document.getElementById('boton-agregar-condicion').addEventListener('click', AgregarCondicion);

    // Al enviar el formulario de cotización, crea las cadenas de datos formateadas
    document.getElementById('formulario-cotizacion').addEventListener('submit', function(event) {
        event.preventDefault(); // Evita el envío automático del formulario

        // Crear una cadena delimitada para las condiciones
        let StringCondiciones = '';
        document.querySelectorAll('#contenedor-condiciones .fila-condiciones').forEach((DivCondiciones, index) => {
            const CampoInput = DivCondiciones.querySelector('input');
            if (CampoInput) {
                StringCondiciones += (index > 0 ? '|' : '') + CampoInput.value; // Añade el valor del input a la cadena
            }
        });

        // Crear una cadena delimitada para los requisitos
        let requisitosString = '';
        document.querySelectorAll('#contenedor-requistos .fila-requisitos').forEach((requisitoDiv, index) => {
            const CampoInput = requisitoDiv.querySelector('input');
            if (CampoInput) {
                requisitosString += (index > 0 ? '|' : '') + CampoInput.value;
            }
        });

        // Crear una cadena delimitada para las obligaciones
        let obligacionesString = '';
        document.querySelectorAll('#obligaciones-contenedor .fila-obligaciones').forEach((obligacionesDiv, index) => {
            const CampoInput = obligacionesDiv.querySelector('input');
            if (CampoInput) {
                obligacionesString += (index > 0 ? '|' : '') + CampoInput.value;
            }
        });

        // Verifica si hay cuentas bancarias agregadas; si no, muestra una alerta
        if (cuentas.length === 0) {
            alert('Debe agregar al menos una cuenta bancaria antes de enviar el formulario.');
            return; // Detiene el envío del formulario si no hay cuentas
        }

        // Crear una cadena delimitada para las cuentas bancarias
        let cuentasString = '';
        cuentas.forEach((account, index) => {
            cuentasString += (index > 0 ? '|' : '') +
                `${account.nombre},${account.rut},${account.celular},${account.email},${account.banco},${account.tipoCuenta},${account.numeroCuenta}`;
        });

        // Crea inputs ocultos en el formulario para enviar las cadenas de datos
        const InputsOcultosCuentas = document.createElement('input');
        InputsOcultosCuentas.type = 'hidden';
        InputsOcultosCuentas.name = 'cuentas_bancarias';
        InputsOcultosCuentas.value = cuentasString;
        this.appendChild(InputsOcultosCuentas); // Añade el input oculto al formulario

        const InputsOcultosCondiciones = document.createElement('input');
        InputsOcultosCondiciones.type = 'hidden';
        InputsOcultosCondiciones.name = 'condiciones';
        InputsOcultosCondiciones.value = StringCondiciones;
        this.appendChild(InputsOcultosCondiciones);

        const InputsOcultosRequisitos = document.createElement('input');
        InputsOcultosRequisitos.type = 'hidden';
        InputsOcultosRequisitos.name = 'requisitos';
        InputsOcultosRequisitos.value = requisitosString;
        this.appendChild(InputsOcultosRequisitos);

        const InputsOcultosObligaciones = document.createElement('input');
        InputsOcultosObligaciones.type = 'hidden';
        InputsOcultosObligaciones.name = 'obligaciones';
        InputsOcultosObligaciones.value = obligacionesString;
        this.appendChild(InputsOcultosObligaciones);

        // Finalmente, envía el formulario con los datos completos
        this.submit();
    });

    // Función para verificar si se ha seleccionado una opción de firma
    function VerificarSeleccionFirma() {
        // Obtiene todas las opciones de firma
        const OpcionFirma = document.querySelectorAll('input[name="opcion-firma"]');
        // Verifica si alguna opción de firma está seleccionada
        const HayAlgoSeleccionado = Array.from(OpcionFirma).some(option => option.checked);

        // Si no hay una firma seleccionada o no hay cuentas bancarias, desactiva el botón de subir
        document.getElementById('boton-subir').disabled = !HayAlgoSeleccionado || cuentas.length === 0;
    }

    // Agrega un listener a cada opción de firma para verificar la selección cuando se cambia
    const OpcionFirma = document.querySelectorAll('input[name="opcion-firma"]');
    OpcionFirma.forEach(option => {
        option.addEventListener('change', VerificarSeleccionFirma); // Ejecuta la verificación cada vez que el usuario cambia de opción
    });

    // Llama a la función de verificación al cargar la página para asegurarse de que el botón tenga el estado correcto
    VerificarSeleccionFirma();
    
    /* --------------------------------------------------------------------------------------------------------------
        ---------------------------------------- FIN ITred Spa crear_empresa .JS ---------------------------------------
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