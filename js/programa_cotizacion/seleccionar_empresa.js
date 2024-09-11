
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
        var customSelect = document.querySelector('.custom-select');
        var selectedOption = customSelect.querySelector('.selected-option');
        var optionList = customSelect.querySelector('#option-list');
        var selectElement = customSelect.querySelector('select');
        var hiddenInput = document.getElementById('selected-empresa');

        selectedOption.addEventListener('click', function() {
            optionList.style.display = optionList.style.display === 'block' ? 'none' : 'block';
        });

        optionList.addEventListener('click', function(event) {
            var target = event.target;
            while (target && !target.hasAttribute('data-value')) {
                target = target.parentElement;
            }
            if (target) {
                var value = target.getAttribute('data-value');
                var text = target.textContent.trim();
                selectedOption.textContent = text;
                hiddenInput.value = value;
                selectElement.value = value;
                optionList.style.display = 'none';
            }
        });

        document.addEventListener('click', function(event) {
            if (!customSelect.contains(event.target)) {
                optionList.style.display = 'none';
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