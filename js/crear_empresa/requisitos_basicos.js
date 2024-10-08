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
        -------------------------------------- Inicio ITred Spa Requisitos basicos .JS --------------------------------------
        ------------------------------------------------------------------------------------------------------------- */


let requisitoCount = 0;

// Agregar Requisito
function addRequisito() {
    requisitoCount++;

    const contenedor = document.getElementById('requisito-contenedor');

    // Crear nueva fila de requisito
    const requisitoDiv = document.createElement('div');
    requisitoDiv.className = 'requisito-row';
    requisitoDiv.dataset.index = requisitoCount;

    // Crear el HTML con el botón de eliminar al lado del input
    requisitoDiv.innerHTML = `
        <span class="requisito-number">${requisitoCount}-. </span>
        <input type="text" name="requisito_${requisitoCount}" placeholder="Ingrese requisito ${requisitoCount}" oninput="removeInvalidChars(this)" />
        <button type="button" class="remove-requisito-btn" onclick="removeRequisito(this)">Eliminar</button>
    `;

    contenedor.appendChild(requisitoDiv);

    // Hacer readonly el requisito anterior
    if (requisitoCount > 1) {
        const previousrequisito = contenedor.children[requisitoCount - 2];
        const inputField = previousrequisito.querySelector('input');
        inputField.setAttribute('readonly', 'readonly');
    }
}

// Función para eliminar requisitos
function removeRequisito(button) {
    const contenedor = document.getElementById('requisito-contenedor');
    const requisitoDiv = button.parentElement;

    if (requisitoDiv) {
        requisitoDiv.remove(); // Elimina el requisito seleccionado
        requisitoCount--;

        // Ajustar la numeración
        updateNumeration(contenedor, 'requisito');
    }
}

// Función para actualizar la numeración después de eliminar
function updateNumeration(contenedor, type) {
    Array.from(contenedor.children).forEach((itemDiv, newIndex) => {
        const numberSpan = itemDiv.querySelector(`.${type}-number`);
        const inputField = itemDiv.querySelector('input');

        const updatedIndex = newIndex + 1;
        numberSpan.textContent = `${updatedIndex}-. `;
        inputField.setAttribute('name', `${type}_${updatedIndex}`);
        inputField.setAttribute('placeholder', `Ingrese ${type} ${updatedIndex}`);

        // Actualizar el dataset del div
        itemDiv.dataset.index = updatedIndex;
    });
}

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Requisitos basicos .JS ---------------------------------------
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