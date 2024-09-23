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
    -------------------------------------- Inicio ITred Spa Firma .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

    document.addEventListener('DOMContentLoaded', () => {
        const autoSignatureDisplay = document.getElementById('auto-signature-display');
        const manualSignaturesContainer = document.getElementById('manual-signatures');
        const addSignatureButton = document.getElementById('add-signature');
        const signatureImageInput = document.getElementById('signature-image');
    
        const generateAutomaticSignature = () => {
            const companyName = document.getElementById('empresa_nombre').value;
            const companyArea = document.getElementById('empresa_area').value;
            const companyPhone = document.getElementById('empresa_telefono').value;
    
            if (!companyName || !companyArea || !companyPhone) {
                return "Antes debes llenar el formulario.";
            }
            return `SIN OTRO PARTICULAR, Y ESPERANDO QUE LA PRESENTE OFERTA SEA DE SU INTERÉS, SE DESPIDE ATENTAMENTE\n\n${companyName}\n\n${companyArea}\n\nTeléfono: ${companyPhone}`;
        };
    
        document.querySelectorAll('input[name="signature-option"]').forEach((input) => {
            input.addEventListener('change', () => {
                // Oculta todas las secciones de firma
                document.querySelectorAll('.signature-display').forEach((element) => {
                    element.style.display = 'none';
                });
    
                // Muestra la sección correspondiente según la opción seleccionada
                if (input.value === 'automatic') {
                    autoSignatureDisplay.innerText = generateAutomaticSignature();
                    autoSignatureDisplay.style.display = 'block';
                } else if (input.value === 'manual') {
                    manualSignaturesContainer.style.display = 'block';
                } else if (input.value === 'image') {
                    signatureImageInput.style.display = 'block';
                }
    
                // Asegúrate de ocultar el campo de imagen si se selecciona otra opción
                if (input.value !== 'image') {
                    signatureImageInput.style.display = 'none';
                }
            });
        });
    
        addSignatureButton.addEventListener('click', () => {
            const newSignatureRow = document.createElement('div');
            newSignatureRow.classList.add('signature-row');
            newSignatureRow.style.display = 'flex'; // Mantiene la fila
            newSignatureRow.style.alignItems = 'center'; // Alinea verticalmente los elementos
            newSignatureRow.innerHTML = `
                <input type="text" class="manual-signature-input" placeholder="Ingresa tu firma aquí..." style="flex: 1; margin-right: 10px;">
                <button type="button" class="remove-signature" style="background-color: red; color: white; border: none; cursor: pointer; padding: 5px 10px;">Eliminar</button>
            `;
            manualSignaturesContainer.insertBefore(newSignatureRow, addSignatureButton);
        });
    
        manualSignaturesContainer.addEventListener('click', (event) => {
            if (event.target.classList.contains('remove-signature')) {
                event.target.parentElement.remove();
            }
        });
    });
    
/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Firma .JS ---------------------------------------
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