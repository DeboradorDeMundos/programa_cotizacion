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


let ContadorRequisitos = 0;

// Agregar Requisito
function AgregarRequisito() {
    ContadorRequisitos++;

    const contenedor = document.getElementById('contenedor-requistos');

    // Crear nueva fila de requisito
    const requisitoDiv = document.createElement('div');
    requisitoDiv.className = 'fila-requisitos';
    requisitoDiv.dataset.index = ContadorRequisitos;

    // Crear el HTML con el botón de eliminar al lado del input
    requisitoDiv.innerHTML = `
        <span class="requisito-number">${ContadorRequisitos}-. </span>
        <input type="text" name="requisito_${ContadorRequisitos}" placeholder="Ingrese requisito ${ContadorRequisitos}" oninput="QuitarCaracteresInvalidos(this)" />
        <button type="button" class="boton-eliminar-obligacion" onclick="EliminarRequisito(this)">Eliminar</button>
    `;

    contenedor.appendChild(requisitoDiv);

    // Hacer readonly el requisito anterior
    if (ContadorRequisitos > 1) {
        const RequisitoPrevio = contenedor.children[ContadorRequisitos - 2];
        const CampoInput = RequisitoPrevio.querySelector('input');
        CampoInput.setAttribute('readonly', 'readonly');
    }
}

// Función para eliminar requisitos
function EliminarRequisito(button) {
    const contenedor = document.getElementById('contenedor-requistos');
    const requisitoDiv = button.parentElement;

    if (requisitoDiv) {
        requisitoDiv.remove(); // Elimina el requisito seleccionado
        ContadorRequisitos--;

        // Ajustar la numeración
        ActualizarNumeracion(contenedor, 'requisito');
    }
}

// Función para actualizar la numeración después de eliminar
function ActualizarNumeracion(contenedor, type) {
    Array.from(contenedor.children).forEach((itemDiv, newIndex) => {
        const SpanNumeros = itemDiv.querySelector(`.${type}-number`);
        const CampoInput = itemDiv.querySelector('input');

        const ActualizarIndice = newIndex + 1;
        SpanNumeros.textContent = `${ActualizarIndice}-. `;
        CampoInput.setAttribute('name', `${type}_${ActualizarIndice}`);
        CampoInput.setAttribute('placeholder', `Ingrese ${type} ${ActualizarIndice}`);

        // Actualizar el dataset del div
        itemDiv.dataset.index = ActualizarIndice;
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