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
        -------------------------------------- Inicio ITred Spa Obligaciones cliente .JS --------------------------------------
        ------------------------------------------------------------------------------------------------------------- */

    // Inicializa el contador de obligaciones
    let ContadorObligaciones = 0;

    // Función para agregar una nueva obligación
    function AgregarObligacion() {
        ContadorObligaciones++; // Incrementa el contador de obligaciones

        const contenedor_o = document.getElementById('obligaciones-contenedor');

        // Crear un nuevo contenedor para la obligación
        const obligacionesDiv = document.createElement('div');
        obligacionesDiv.className = 'fila-obligaciones'; // Asigna una clase para el estilo
        obligacionesDiv.dataset.index = ContadorObligaciones; // Asigna un índice a la obligación

        // Crear el HTML con el botón de eliminar al lado del input
        obligacionesDiv.innerHTML = `
            <span class="numero-obligaciones">${ContadorObligaciones}-. </span>
            <input type="text" name="obligacion_${ContadorObligaciones}" placeholder="Ingrese obligación ${ContadorObligaciones}" oninput="QuitarCaracteresInvalidos(this)" />
            <button type="button" class="boton-eliminar-obligacion" onclick="QuitarObligacion(this)">Eliminar</button>
        `;

        // Añadir la nueva obligación al contenedor
        contenedor_o.appendChild(obligacionesDiv);

        // Hacer readonly la obligación anterior si hay más de una
        if (ContadorObligaciones > 1) {
            const ObligacionPrevia = contenedor_o.children[ContadorObligaciones - 2];
            const CampoInput = ObligacionPrevia.querySelector('input'); // Selecciona el input de la obligación previa
            CampoInput.setAttribute('readonly', 'readonly'); // Establece el input anterior como solo lectura
        }
    }

    // Función para eliminar obligaciones
    function QuitarObligacion(button) {
        const contenedor_o = document.getElementById('obligaciones-contenedor');
        const obligacionesDiv = button.parentElement; // Obtiene el contenedor de la obligación a eliminar

        if (obligacionesDiv) {
            obligacionesDiv.remove(); // Elimina la obligación seleccionada
            ContadorObligaciones--; // Decrementa el contador de obligaciones

            // Ajustar la numeración de las obligaciones restantes
            ActualizarNumeraciones(contenedor_o, 'obligaciones');
        }
    }

    function ActualizarNumeraciones(contenedor, type) {
        // Convierte la colección de hijos en un array y actualiza la numeración
        Array.from(contenedor.children).forEach((itemDiv, newIndex) => {
            const SpanNumeros = itemDiv.querySelector(`.numero-${type}`); // Selecciona el span de la numeración
            const CampoInput = itemDiv.querySelector('input'); // Selecciona el input

            const ActualizarIndice = newIndex + 1; // Calcula el nuevo índice
            SpanNumeros.textContent = `${ActualizarIndice}-. `; // Actualiza el texto del span
            CampoInput.setAttribute('name', `${type}_${ActualizarIndice}`); // Actualiza el nombre del input
            CampoInput.setAttribute('placeholder', `Ingrese ${type} ${ActualizarIndice}`); // Actualiza el placeholder del input

            // Actualizar el dataset del div
            itemDiv.dataset.index = ActualizarIndice; // Actualiza el índice en el dataset
        });
    }
    /* --------------------------------------------------------------------------------------------------------------
        ---------------------------------------- FIN ITred Spa Obligaciones cliente .JS ---------------------------------------
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