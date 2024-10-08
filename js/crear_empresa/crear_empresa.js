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
    -------------------------------------- INICIO ITred Spa crear_empresa .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
    
    function formatoRut(input) {
        // Obtiene el valor del campo y elimina los caracteres no numéricos
        let rut = input.value.replace(/\D/g, '');
    
        // Verifica si la longitud total supera el máximo permitido
        if (rut.length > 9) {
            rut = rut.slice(0, 9); // Limita a 8 dígitos
        }
    
        // Aplica el formato de RUT
        if (rut.length > 1) {
            rut = rut.slice(0, -1).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '-' + rut.slice(-1);
        }
    
        // Asigna el valor formateado de vuelta al campo de entrada
        input.value = rut;
    
        // Limitar longitud total considerando el formato
        if (input.value.length > 12) {
            input.value = input.value.slice(0, 12); // Asegura que no exceda el formato esperado
        }
    }
    
    // Configurar los botones de agregar
    document.getElementById('boton-agregar-requisito').addEventListener('click', AgregarRequisito);
    document.getElementById('boton-agregar-obligacion').addEventListener('click', AgregarObligacion);
    document.getElementById('boton-agregar-condicion').addEventListener('click', AgregarCondicion);
    
    document.getElementById('formulario-cotizacion').addEventListener('submit', function(event) {
        event.preventDefault();
    
        // Crear cadenas delimitadas para cada tipo de datos
        let StringCondiciones = '';
        document.querySelectorAll('#contenedor-condiciones .fila-condiciones').forEach((DivCondiciones, index) => {
            const CampoInput = DivCondiciones.querySelector('input');
            if (CampoInput) {
                StringCondiciones += (index > 0 ? '|' : '') + CampoInput.value;
            }
        });
    
        let requisitosString = '';
        document.querySelectorAll('#contenedor-requistos .fila-requisitos').forEach((requisitoDiv, index) => {
            const CampoInput = requisitoDiv.querySelector('input');
            if (CampoInput) {
                requisitosString += (index > 0 ? '|' : '') + CampoInput.value;
            }
        });
    
        let obligacionesString = '';
        document.querySelectorAll('#obligaciones-contenedor .fila-obligaciones').forEach((obligacionesDiv, index) => {
            const CampoInput = obligacionesDiv.querySelector('input');
            if (CampoInput) {
                obligacionesString += (index > 0 ? '|' : '') + CampoInput.value;
            }
        });
    
        // Verificar si hay cuentas bancarias antes de enviar el formulario
        if (cuentas.length === 0) {
            alert('Debe agregar al menos una cuenta bancaria antes de enviar el formulario.');
            return;
        }
    
        // Crear cadena delimitada para cuentas bancarias
        let cuentasString = '';
        cuentas.forEach((account, index) => {
            cuentasString += (index > 0 ? '|' : '') +
                `${account.nombre},${account.rut},${account.celular},${account.email},${account.banco},${account.tipoCuenta},${account.numeroCuenta}`;
        });
    
        // Crear campos ocultos en el formulario con los datos
        const InputsOcultosCuentas = document.createElement('input');
        InputsOcultosCuentas.type = 'hidden';
        InputsOcultosCuentas.name = 'cuentas_bancarias';
        InputsOcultosCuentas.value = cuentasString;
        this.appendChild(InputsOcultosCuentas);
    
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
    
        // Enviar el formulario
        this.submit();
    });

    // Función para verificar si hay una firma seleccionada
    function VerificarSeleccionFirma() {
        const OpcionFirma = document.querySelectorAll('input[name="opcion-firma"]');
        const HayAlgoSeleccionado = Array.from(OpcionFirma).some(option => option.checked);
        
        // Desactiva el botón si no hay firma seleccionada
        document.getElementById('boton-subir').disabled = !HayAlgoSeleccionado || cuentas.length === 0;
    }

    // Agrega un event listener para cada opción de firma
    const OpcionFirma = document.querySelectorAll('input[name="opcion-firma"]');
    OpcionFirma.forEach(option => {
        option.addEventListener('change', VerificarSeleccionFirma);
    });

    // Llama a la función al cargar la página para establecer el estado inicial del botón
    VerificarSeleccionFirma();
    
    /* --------------------------------------------------------------------------------------------------------------
        ---------------------------------------- FIN ITred Spa crear_empresa .JS ---------------------------------------
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