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
    -------------------------------------- Inicio ITred Spa Firma .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

// TÍTULO: MANEJO DINÁMICO DE FIRMAS EN EL FORMULARIO DE COTIZACIÓN
    // Descripción: Este script gestiona las opciones de firma (automática, manual, con imagen, digital) dentro de un formulario de cotización, permite agregar múltiples firmas manualmente, validar campos y previsualizar una firma subida como imagen.
    document.addEventListener('DOMContentLoaded', () => {
        const DesplegarFirmaAutomatica = document.getElementById('auto-desplegar-firma');
        const ContenedorFirmaManual = document.getElementById('firma-manual');
        const InputFirmaImagen = document.getElementById('firma-imagen');
        const PrevisualizacionFirma = document.getElementById('previsualizacion-firma');
        const MensajeFirmaDigital = document.getElementById('Mensaje-Firma-Digital'); // Contenedor del mensaje de firma digital

        // Genera la firma automática basada en los campos del formulario
        const generateAutomaticSignature = () => {
        const titular_predefinido = `SIN OTRO PARTICULAR, Y ESPERANDO QUE LA PRESENTE OFERTA SEA DE SU INTERÉS, SE DESPIDE ATENTAMENTE:`;

        const nombre_encargado = document.getElementById('encargado_nombre').value;
        const cargo_encargado = document.getElementById('cargo_encargado').value;
        const empresa_nombre = document.getElementById('empresa_nombre').value;
        const empresa_direccion = document.getElementById('empresa_direccion').value;
        const empresa_ciudad = document.getElementById('empresa_ciudad').value;
        const empresa_pais = document.getElementById('empresa_pais').value;
        const telefono_encargado = document.getElementById('encargado_fono').value;
        const celular_encargado = document.getElementById('encargado_celular').value;
        const email_encargado = document.getElementById('encargado_email').value;
        const web_empresa = document.getElementById('empresa_web').value;
        const logo = document.getElementById('subir-logo').src;

        // Verifica que todos los campos necesarios estén llenos
        if (!nombre_encargado || !cargo_encargado || !empresa_nombre || !empresa_direccion || !empresa_ciudad || !empresa_pais || !telefono_encargado || !celular_encargado || !email_encargado || !web_empresa) {
            return "Antes debes llenar todos los campos del formulario.";
        }

        // Retorna la firma automática
        return `
            ${titular_predefinido} 
            \n\n${nombre_encargado} 
            \n${cargo_encargado} - ${empresa_nombre} 
            \n${empresa_direccion} 
            \n${empresa_ciudad}, ${empresa_pais} 
            \nTeléfono: ${telefono_encargado} 
            \nCelular: ${celular_encargado} 
            \nEmail: ${email_encargado} 
            \nWeb: ${web_empresa}`;
        };

        // Escucha los cambios en las opciones de firma
        document.querySelectorAll('input[name="opcion-firma"]').forEach((input) => {
        input.addEventListener('change', () => {
            // Oculta todas las secciones de firma
            document.querySelectorAll('.desplegar-firma').forEach((element) => {
                element.style.display = 'none';
            });

            // Muestra la sección correspondiente según la opción seleccionada
            if (input.value === 'automatic') {
                DesplegarFirmaAutomatica.innerText = generateAutomaticSignature();
                DesplegarFirmaAutomatica.style.display = 'block';
            } else if (input.value === 'manual') {
                ContenedorFirmaManual.style.display = 'block';
            } else if (input.value === 'image') {
                InputFirmaImagen.style.display = 'block';
            } else if (input.value === 'digital') {
                MensajeFirmaDigital.style.display = 'block'; // Muestra el mensaje de firma digital
            }

            // Asegúrate de ocultar el campo de imagen si se selecciona otra opción
            if (input.value !== 'image') {
                InputFirmaImagen.style.display = 'none';
                PrevisualizacionFirma.style.display = 'none'; // Oculta la previsualización de la imagen si se elige otra opción
            }
        });
    });

    // Evento para manejar la subida de la imagen y mostrar la previsualización
    InputFirmaImagen.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file && file.type === 'image/png') {
            const Lector = new FileReader();
            Lector.onload = (e) => {
                PrevisualizacionFirma.src = e.target.result;
                PrevisualizacionFirma.style.display = 'block';
            };
            Lector.readAsDataURL(file);
        } else {
            alert('Por favor selecciona un archivo PNG válido.');
        }
    });

    document.getElementById('BotonAgregarFirma').addEventListener('click', function() {
        // Obtener todos los inputs dentro del contenedor de firmas
        const inputs = document.querySelectorAll('#firma-manual input');
        
        // Validar que cada input no esté vacío
        for (const input of inputs) {
            if (input.value.trim() === '') {
                alert('Por favor, completa todos los campos antes de agregar una firma.');
                input.focus(); // Enfoca el campo vacío
                return; // Detiene la ejecución si hay algún campo vacío
            }
        }
    
        // Si todos los campos están completos, se agrega una nueva fila de firma
        const NuevaFilaFirma = document.createElement('div');
        NuevaFilaFirma.classList.add('signature-row');
        NuevaFilaFirma.style.display = 'flex'; 
        NuevaFilaFirma.style.flexDirection = 'column'; 
        NuevaFilaFirma.style.marginBottom = '10px'; 
    
        // Añadir los campos a la nueva fila
        NuevaFilaFirma.innerHTML = `
            <input type="text" class="manual-signature-input" name="nombre_encargado[]" placeholder="Nombre del Encargado" style="margin-bottom: 5px;">
            <input type="text" class="manual-signature-input" name="cargo_encargado[]" placeholder="Cargo del Encargado" style="margin-bottom: 5px;">
            <input type="text" class="manual-signature-input" name="nombre_empresa[]" placeholder="Nombre de la Empresa" style="margin-bottom: 5px;">
            <input type="text" class="manual-signature-input" name="area_empresa[]" placeholder="Área de la Empresa" style="margin-bottom: 5px;">
            <input type="text" class="manual-signature-input" name="telefono[]" placeholder="Teléfono" style="margin-bottom: 5px;">
            <input type="email" class="manual-signature-input" name="email[]" placeholder="Email" style="margin-bottom: 5px;">
            <input type="text" class="manual-signature-input" name="direccion[]" placeholder="Dirección" style="margin-bottom: 5px;">
            <input type="text" class="manual-signature-input" name="rut[]" placeholder="RUT" style="margin-bottom: 5px;">
            <button type="button" class="remove-signature" style="background-color: red; color: white; border: none; cursor: pointer; padding: 5px 10px;">Eliminar</button>
        `;
    
        // Agregar la nueva fila antes del botón de agregar más firmas
        document.getElementById('firma-manual').insertBefore(NuevaFilaFirma, BotonAgregarFirma);
    
        // Agregar funcionalidad para eliminar una fila
        const BotonQuitar = NuevaFilaFirma.querySelector('.remove-signature');
        BotonQuitar.addEventListener('click', () => {
            document.getElementById('firma-manual').removeChild(NuevaFilaFirma);
        });
    });

    // Evento para eliminar la firma manualmente ingresada
    ContenedorFirmaManual.addEventListener('click', (event) => {
        if (event.target.classList.contains('remove-signature')) {
            event.target.parentElement.remove();
        }
    });
});

// TÍTULO: PARA MANEJO DE LA PREVISUALIZACION DE LA FIRMA DE IMAGEN 
    // Configura la previsualización de una firma de imagen seleccionada por el usuario y habilita o deshabilita el botón de envío según la selección de firma.
    document.getElementById('firma-imagen').addEventListener('change', function(event) {
        const Lector = new FileReader();
        Lector.onload = function() {
            const Previsualizacion = document.getElementById('previsualizacion-firma');
            Previsualizacion.src = Lector.result;
            Previsualizacion.style.display = 'block';
        };
        Lector.readAsDataURL(event.target.files[0]);
    });

// TÍTULO PARA VERIFICAR LA SELECCIÓN DE FIRMA Y HABILITAR/DESHABILITAR EL BOTÓN DE SUBIR
    // Verifica si se ha seleccionado una opción de firma y activa el botón de envío en función de la selección.
    function VerificarSeleccionFirma() {
        const BotonSubir = document.getElementById('boton-subir');
        const OpcionSeleccionada = document.querySelector('input[name="opcion-firma"]:checked');
        
        // Habilitar o deshabilitar el botón de envío según la selección
        if (OpcionSeleccionada) {
            BotonSubir.disabled = false; // Habilitar si hay una selección
        } else {
            BotonSubir.disabled = true; // Deshabilitar si no hay selección
        }
    }

    

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Firma .JS ---------------------------------------
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