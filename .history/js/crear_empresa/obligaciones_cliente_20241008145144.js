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
        -------------------------------------- Inicio ITred Spa Obligaciones cliente .JS --------------------------------------
        ------------------------------------------------------------------------------------------------------------- */

        let ContadorObligaciones = 0;

        // Agregar Obligaciones
        function AgregarObligacion() {
            ContadorObligaciones++;
        
            const contenedor_o = document.getElementById('obligaciones-contenedor');
        
            // Crear nueva fila de obligación
            const obligacionesDiv = document.createElement('div');
            obligacionesDiv.className = 'fila-obligaciones';
            obligacionesDiv.dataset.index = ContadorObligaciones;
        
            // Crear el HTML con el botón de eliminar al lado del input
            obligacionesDiv.innerHTML = `
                <span class="numero-obligaciones">${ContadorObligaciones}-. </span>
                <input type="text" name="obligacion_${ContadorObligaciones}" placeholder="Ingrese obligación ${ContadorObligaciones}" oninput="QuitarCaracteresInvalidos(this)"s />
                <button type="button" class="boton-eliminar-obligacion" onclick="QuitarObligacion(this)">Eliminar</button>
            `;
        
            contenedor_o.appendChild(obligacionesDiv);
        
            // Hacer readonly la obligación anterior
            if (ContadorObligaciones > 1) {
                const ObligacionPrevia = contenedor_o.children[ContadorObligaciones - 2];
                const CampoInput = ObligacionPrevia.querySelector('input');
                CampoInput.setAttribute('readonly', 'readonly');
            }
        }
        
        // Función para eliminar obligaciones
        function QuitarObligacion(button) {
            const contenedor_o = document.getElementById('obligaciones-contenedor');
            const obligacionesDiv = button.parentElement;
        
            if (obligacionesDiv) {
                obligacionesDiv.remove(); // Elimina la obligación seleccionada
                ContadorObligaciones--;
        
                // Ajustar la numeración
                ActualizarNumeracion(contenedor_o, 'obligacion');
            }
        }
        
    /* --------------------------------------------------------------------------------------------------------------
        ---------------------------------------- FIN ITred Spa Obligaciones cliente .JS ---------------------------------------
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