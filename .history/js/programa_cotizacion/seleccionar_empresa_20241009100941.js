
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
  
    document.addEventListener('DOMContentLoaded', function() {
        var customSelect = document.querySelector('.custom-select');
        var OpcionSeleccionada = customSelect.querySelector('.selected-option');
        var ListaDeOpciones = customSelect.querySelector('#option-list');
        var ElementoSeleccionado = customSelect.querySelector('select');
        var InputOculto = document.getElementById('selected-empresa');

        OpcionSeleccionada.addEventListener('click', function() {
            ListaDeOpciones.style.display = ListaDeOpciones.style.display === 'block' ? 'none' : 'block';
        });

        ListaDeOpciones.addEventListener('click', function(event) {
            var target = event.target;
            while (target && !target.hasAttribute('data-value')) {
                target = target.parentElement;
            }
            if (target) {
                var value = target.getAttribute('data-value');
                var text = target.textContent.trim();
                OpcionSeleccionada.textContent = text;
                InputOculto.value = value;
                ElementoSeleccionado.value = value;
                ListaDeOpciones.style.display = 'none';
            }
        });

        document.addEventListener('click', function(event) {
            if (!customSelect.contains(event.target)) {
                ListaDeOpciones.style.display = 'none';
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