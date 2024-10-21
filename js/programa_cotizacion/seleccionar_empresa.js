
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
    -------------------------------------- INICIO ITred Spa menu .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
  
// Título: Inicialización del select personalizado
//  Espera a que todo el contenido del DOM se haya cargado antes de ejecutar la lógica para el select personalizado.
document.addEventListener('DOMContentLoaded', function() {
    // Título: Seleccionar el contenedor del select personalizado
    //  Obtiene el elemento que contiene el select personalizado para su manipulación.
    var customSelect = document.querySelector('.custom-select');
    
    // Título: Seleccionar la opción seleccionada
    //  Obtiene el elemento que muestra la opción actualmente seleccionada en el select personalizado.
    var OpcionSeleccionada = customSelect.querySelector('.selected-option');
    
    // Título: Seleccionar la lista de opciones
    //  Obtiene el contenedor que muestra las opciones disponibles del select personalizado.
    var ListaDeOpciones = customSelect.querySelector('#option-list');
    
    // Título: Seleccionar el elemento <select> original
    //  Obtiene el elemento <select> HTML original que se está reemplazando con el select personalizado.
    var ElementoSeleccionado = customSelect.querySelector('select');
    
    // Título: Seleccionar el input oculto para el valor seleccionado
    //  Obtiene el input oculto que contendrá el valor del elemento seleccionado para enviar en el formulario.
    var InputOculto = document.getElementById('selected-empresa');

    // Título: Mostrar/ocultar la lista de opciones
    //  Agrega un evento click a la opción seleccionada para alternar la visibilidad de la lista de opciones.
    OpcionSeleccionada.addEventListener('click', function() {
        ListaDeOpciones.style.display = ListaDeOpciones.style.display === 'block' ? 'none' : 'block';
    });

    // Título: Manejar la selección de una opción
    //  Agrega un evento click a la lista de opciones para actualizar la opción seleccionada y cerrar la lista.
    ListaDeOpciones.addEventListener('click', function(event) {
        var target = event.target;
        
        // Título: Buscar el elemento con el atributo 'data-value'
        //  Verifica si el elemento clicado tiene el atributo 'data-value', y si no, sube en la jerarquía de elementos.
        while (target && !target.hasAttribute('data-value')) {
            target = target.parentElement; // Ir al padre si no tiene el atributo
        }
        
        // Si se encontró un objetivo válido
        if (target) {
            var value = target.getAttribute('data-value'); // Obtener el valor del atributo
            var text = target.textContent.trim(); // Obtener el texto de la opción
            
            // Título: Actualizar la opción seleccionada y los inputs correspondientes
            //  Asigna el texto y el valor de la opción seleccionada a los elementos relevantes.
            OpcionSeleccionada.textContent = text; // Actualizar la opción seleccionada
            InputOculto.value = value; // Establecer el valor en el input oculto
            ElementoSeleccionado.value = value; // Establecer el valor en el elemento <select>
            ListaDeOpciones.style.display = 'none'; // Ocultar la lista de opciones
        }
    });

    // Título: Cerrar la lista de opciones al hacer clic fuera
    //  Agrega un evento click al documento para ocultar la lista de opciones si se hace clic fuera del contenedor.
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
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
*/