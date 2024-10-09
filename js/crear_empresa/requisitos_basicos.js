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
        -------------------------------------- Inicio ITred Spa Requisitos basicos .JS --------------------------------------
        ------------------------------------------------------------------------------------------------------------- */

    // Inicializa el contador de requisitos
    let ContadorRequisitos = 0;

    // Función para agregar un nuevo requisito
    function AgregarRequisito() {
        ContadorRequisitos++; // Incrementa el contador de requisitos

        const contenedor = document.getElementById('contenedor-requistos');

        // Crear un nuevo contenedor para el requisito
        const requisitoDiv = document.createElement('div');
        requisitoDiv.className = 'fila-requisitos'; // Asigna una clase para el estilo
        requisitoDiv.dataset.index = ContadorRequisitos; // Asigna un índice al requisito

        // Crear el HTML con el botón de eliminar al lado del input
        requisitoDiv.innerHTML = `
            <span class="requisito-number">${ContadorRequisitos}-. </span>
            <input type="text" name="requisito_${ContadorRequisitos}" placeholder="Ingrese requisito ${ContadorRequisitos}" oninput="QuitarCaracteresInvalidos(this)" />
            <button type="button" class="boton-eliminar-obligacion" onclick="EliminarRequisito(this)">Eliminar</button>
        `;

        // Añadir el nuevo requisito al contenedor
        contenedor.appendChild(requisitoDiv);

        // Hacer readonly el requisito anterior si hay más de uno
        if (ContadorRequisitos > 1) {
            const RequisitoPrevio = contenedor.children[ContadorRequisitos - 2];
            const CampoInput = RequisitoPrevio.querySelector('input'); // Selecciona el input del requisito previo
            CampoInput.setAttribute('readonly', 'readonly'); // Establece el input anterior como solo lectura
        }
    }

    // Función para eliminar requisitos
    function EliminarRequisito(button) {
        const contenedor = document.getElementById('contenedor-requistos');
        const requisitoDiv = button.parentElement; // Obtiene el contenedor del requisito a eliminar

        if (requisitoDiv) {
            requisitoDiv.remove(); // Elimina el requisito seleccionado
            ContadorRequisitos--; // Decrementa el contador de requisitos

            // Ajustar la numeración de los requisitos restantes
            ActualizarNumeracion(contenedor, 'requisito');
        }
    }

    // Función para actualizar la numeración después de eliminar
    function ActualizarNumeracion(contenedor, type) {
        // Convierte la colección de hijos en un array y actualiza la numeración
        Array.from(contenedor.children).forEach((itemDiv, newIndex) => {
            const SpanNumeros = itemDiv.querySelector(`.${type}-number`); // Selecciona el span de la numeración
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
    ---------------------------------------- FIN ITred Spa Requisitos basicos .JS ---------------------------------------
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