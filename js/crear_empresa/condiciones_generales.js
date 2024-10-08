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
    -------------------------------------- Inicio ITred Spa Condiciones Generales .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
    
    let ContadorCondiciones = 0;

    // Agregar Condición
    function AgregarCondicion() {
        ContadorCondiciones++;
    
        const contenedor = document.getElementById('contenedor-condiciones');
    
        // Crear nueva fila de condición
        const DivCondiciones = document.createElement('div');
        DivCondiciones.className = 'fila-condiciones';
        DivCondiciones.dataset.index = ContadorCondiciones;
    
        // Crear el HTML con el botón de eliminar al lado del input
        DivCondiciones.innerHTML = `
            <span class="condition-number">${ContadorCondiciones}-. </span>
            <input type="text" name="condition_${ContadorCondiciones}" placeholder="Ingrese condición ${ContadorCondiciones}" oninput="QuitarCaracteresInvalidos(this)"/>
            <button type="button" class="boton-eliminar-condicion" onclick="QuitarCondicion(this)">Eliminar</button>
        `;
    
        contenedor.appendChild(DivCondiciones);
    
        // Hacer readonly la condición anterior
        if (ContadorCondiciones > 1) {
            const CondicionPrevia = contenedor.children[ContadorCondiciones - 2];
            const CampoInput = CondicionPrevia.querySelector('input');
            CampoInput.setAttribute('readonly', 'readonly');
        }
    }
    
    // Función para eliminar condiciones
    function QuitarCondicion(button) {
        const contenedor = document.getElementById('contenedor-condiciones');
        const DivCondiciones = button.parentElement;
    
        if (DivCondiciones) {
            DivCondiciones.remove(); // Elimina la condición seleccionada
            ContadorCondiciones--;
    
            // Ajustar la numeración
            ActualizarNumeracion(contenedor, 'condition');
        }
    }

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Condiciones Generales .JS ---------------------------------------
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