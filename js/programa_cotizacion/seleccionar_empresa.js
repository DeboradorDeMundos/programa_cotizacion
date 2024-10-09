
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
    -------------------------------------- INICIO ITred Spa menu .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
  
    document.addEventListener('DOMContentLoaded', function() {
        // Seleccionar el contenedor del select personalizado
        var customSelect = document.querySelector('.custom-select');
        // Seleccionar el elemento que muestra la opción seleccionada
        var OpcionSeleccionada = customSelect.querySelector('.selected-option');
        // Seleccionar la lista de opciones
        var ListaDeOpciones = customSelect.querySelector('#option-list');
        // Seleccionar el elemento <select> original
        var ElementoSeleccionado = customSelect.querySelector('select');
        // Seleccionar el input oculto que contendrá el valor seleccionado
        var InputOculto = document.getElementById('selected-empresa');
    
        // Agregar un evento click a la opción seleccionada para mostrar/ocultar la lista de opciones
        OpcionSeleccionada.addEventListener('click', function() {
            ListaDeOpciones.style.display = ListaDeOpciones.style.display === 'block' ? 'none' : 'block';
        });
    
        // Agregar un evento click a la lista de opciones
        ListaDeOpciones.addEventListener('click', function(event) {
            var target = event.target;
            // Buscar el elemento que tiene el atributo 'data-value'
            while (target && !target.hasAttribute('data-value')) {
                target = target.parentElement; // Ir al padre si no tiene el atributo
            }
            // Si se encontró un objetivo válido
            if (target) {
                var value = target.getAttribute('data-value'); // Obtener el valor del atributo
                var text = target.textContent.trim(); // Obtener el texto de la opción
                OpcionSeleccionada.textContent = text; // Actualizar la opción seleccionada
                InputOculto.value = value; // Establecer el valor en el input oculto
                ElementoSeleccionado.value = value; // Establecer el valor en el elemento <select>
                ListaDeOpciones.style.display = 'none'; // Ocultar la lista de opciones
            }
        });
    
        // Agregar un evento click al documento para cerrar la lista de opciones al hacer clic fuera
        document.addEventListener('click', function(event) {
            if (!customSelect.contains(event.target)) {
                ListaDeOpciones.style.display = 'none'; // Ocultar la lista si se hace clic fuera
            }
        });
    });
    
/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa menu .JS ---------------------------------------
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