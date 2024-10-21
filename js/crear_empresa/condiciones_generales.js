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
    -------------------------------------- Inicio ITred Spa Condiciones Generales .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
    
// Titulo: Contador de condiciones dinámico
// Lleva el conteo de las condiciones agregadas.
let ContadorCondiciones = 0;

// Titulo: Agregar nueva condición
// Añade una nueva fila de condición con un campo de texto y un botón para eliminarla.
function AgregarCondicion() {
    // Incrementa el contador de condiciones para asignar un número único
    ContadorCondiciones++;

    // Obtiene el contenedor donde se agregarán las nuevas condiciones
    const contenedor = document.getElementById('contenedor-condiciones');

    // Crea un nuevo contenedor <div> para una fila de condición
    const DivCondiciones = document.createElement('div');
    DivCondiciones.className = 'fila-condiciones';  // Asigna una clase al nuevo div
    DivCondiciones.dataset.index = ContadorCondiciones;  // Guarda el índice de la condición como atributo de datos

    // Define el HTML que incluye el número de la condición, un input para la condición y un botón para eliminarla
    DivCondiciones.innerHTML = `
        <span class="condition-number">${ContadorCondiciones}-. </span>
        <input type="text" name="condition_${ContadorCondiciones}" placeholder="Ingrese condición ${ContadorCondiciones}" oninput="QuitarCaracteresInvalidos(this)"/>
        <button type="button" class="boton-eliminar-condicion" onclick="QuitarCondicion(this)">Eliminar</button>
    `;

    // Añade la nueva fila de condición al contenedor de condiciones
    contenedor.appendChild(DivCondiciones);

    // Si ya hay más de una condición, hacer que el input de la condición anterior sea de solo lectura
    if (ContadorCondiciones > 1) {
        const CondicionPrevia = contenedor.children[ContadorCondiciones - 2];  // Obtiene la condición previa
        const CampoInput = CondicionPrevia.querySelector('input');  // Selecciona el input de la condición previa
        CampoInput.setAttribute('readonly', 'readonly');  // Marca el campo como de solo lectura
    }
}

// Titulo: Eliminar condición
// Elimina una fila de condición y ajusta la numeración.
function QuitarCondicion(button) {
    // Obtiene el contenedor de todas las condiciones
    const contenedor = document.getElementById('contenedor-condiciones');
    
    // Selecciona el div que contiene la condición que será eliminada (el padre del botón que se presionó)
    const DivCondiciones = button.parentElement;

    if (DivCondiciones) {
        // Elimina la condición seleccionada del DOM
        DivCondiciones.remove();
        ContadorCondiciones--;  // Disminuye el contador de condiciones

        // Actualiza la numeración de las condiciones que quedan
        ActualizarNumeracion(contenedor, 'condition');
    }
}

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Condiciones Generales .JS ---------------------------------------
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