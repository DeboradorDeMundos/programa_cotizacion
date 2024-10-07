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
        const mostrarFirmaAutomatica = document.getElementById('mostrar-firma-automatica');
        const contenedorFirmasManuales = document.getElementById('firma-manual');
        const inputImagenFirma = document.getElementById('imagen-firma');
        const previsualizacionFirma = document.getElementById('previsualizacion-firma');
        const mensajeFirmaDigital = document.getElementById('mensaje-firma-digital');
    
        const generarFirmaAutomatica = () => {
            const titularPredefinido = `SIN OTRO PARTICULAR, Y ESPERANDO QUE LA PRESENTE OFERTA SEA DE SU INTERÉS, SE DESPIDE ATENTAMENTE:`;
    
            const nombreEncargado = document.querySelector('input[name="nombre-encargado-firma"]').value;
            const cargoEncargado = document.querySelector('input[name="cargo-encargado-firma"]').value;
            const nombreEmpresa = document.querySelector('input[name="nombre-empresa-firma"]').value;
            const direccionEmpresa = document.querySelector('input[name="direccion-firma"]').value;
            const telefonoEncargado = document.querySelector('input[name="telefono-encargado-firma"]').value;
            const celularEncargado = document.querySelector('input[name="telefono-empresa-firma"]').value;
            const emailEncargado = document.querySelector('input[name="email-firma"]').value;
            const webEmpresa = document.querySelector('input[name="area-empresa-firma"]').value; // Asumí que esta variable se refiere al web de la empresa.
    
            if (!nombreEncargado || !cargoEncargado || !nombreEmpresa || !direccionEmpresa || !telefonoEncargado || !celularEncargado || !emailEncargado || !webEmpresa) {
                return "Antes debes llenar todos los campos del formulario.";
            }
    
            return `
                ${titularPredefinido} 
                \n\n${nombreEncargado} 
                \n${cargoEncargado} - ${nombreEmpresa} 
                \n${direccionEmpresa} 
                \nTeléfono: ${telefonoEncargado} 
                \nCelular: ${celularEncargado} 
                \nEmail: ${emailEncargado} 
                \nWeb: ${webEmpresa}`;
        };
    
        document.querySelectorAll('input[name="opcion-firma"]').forEach((input) => {
            input.addEventListener('change', () => {
                // Oculta todas las secciones de firma
                document.querySelectorAll('.display-firma').forEach((element) => {
                    element.style.display = 'none';
                });
    
                // Muestra la sección correspondiente según la opción seleccionada
                if (input.value === 'automatica') {
                    mostrarFirmaAutomatica.innerText = generarFirmaAutomatica();
                    mostrarFirmaAutomatica.style.display = 'block';
                } else if (input.value === 'manual') {
                    contenedorFirmasManuales.style.display = 'block';
                } else if (input.value === 'imagen') {
                    inputImagenFirma.style.display = 'block';
                } else if (input.value === 'digital') {
                    mensajeFirmaDigital.style.display = 'block'; // Muestra el mensaje de firma digital
                }
    
                // Asegúrate de ocultar el campo de imagen si se selecciona otra opción
                if (input.value !== 'imagen') {
                    inputImagenFirma.style.display = 'none';
                    previsualizacionFirma.style.display = 'none'; // Oculta la previsualización de la imagen si se elige otra opción
                }
            });
        });
    
        // Evento para manejar la subida de la imagen y mostrar la previsualización
        inputImagenFirma.addEventListener('change', (event) => {
            const archivo = event.target.files[0];
            if (archivo && archivo.type === 'image/png') {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previsualizacionFirma.src = e.target.result;
                    previsualizacionFirma.style.display = 'block';
                };
                reader.readAsDataURL(archivo);
            } else {
                alert('Por favor selecciona un archivo PNG válido.');
            }
        });
    
        const botonAgregarFirma = document.getElementById('add-signature');
    
        // Escuchar el evento para agregar una nueva fila de firma manual
        document.addEventListener('DOMContentLoaded', () => {
         
            const contenedorFirmasManuales = document.getElementById('firma-manual'); // Asegúrate de que este ID sea correcto
        
            // Escuchar el evento para agregar una nueva fila de firma manual
            botonAgregarFirma.addEventListener('click', () => {
                const nuevaFilaFirma = document.createElement('div');
                nuevaFilaFirma.classList.add('fila-firma'); // Cambia a 'fila-firma' si lo deseas
                nuevaFilaFirma.style.display = 'flex';
                nuevaFilaFirma.style.flexDirection = 'column';
                nuevaFilaFirma.style.marginBottom = '10px';
        
                // Crear campos para nombre, cargo, empresa, área, teléfono, email, dirección y RUT
                nuevaFilaFirma.innerHTML = `
                    <input type="text" name="titulo-firma" placeholder="Título de la firma" oninput="quitarCaracteresInvalidos(this)">
                    <input type="text" name="nombre-encargado-firma" placeholder="Nombre del Encargado" oninput="quitarCaracteresInvalidos(this)">
                    <input type="text" name="cargo-encargado-firma" placeholder="Cargo del Encargado" oninput="quitarCaracteresInvalidos(this)">
                    <input type="text" name="telefono-encargado-firma" placeholder="Teléfono del Encargado" oninput="quitarCaracteresInvalidos(this)">
                    <input type="text" name="nombre-empresa-firma" placeholder="Nombre de la Empresa" oninput="quitarCaracteresInvalidos(this)">
                    <input type="text" name="area-empresa-firma" placeholder="Área de la Empresa" oninput="quitarCaracteresInvalidos(this)">
                    <input type="text" name="telefono-empresa-firma" placeholder="Teléfono de la Empresa" oninput="quitarCaracteresInvalidos(this)">
                    <input type="email" name="email-firma" placeholder="Email" onblur="completarEmail(this)">
                    <input type="text" name="direccion-firma" placeholder="Dirección" oninput="quitarCaracteresInvalidos(this)">
                    <input type="text" name="rut-firma" placeholder="RUT" minlength="3" maxlength="20" pattern="^[0-9]+[-kK0-9]{1}$" title="Por favor, ingrese un RUT válido." oninput="formatearRut(this)" oninput="quitarCaracteresInvalidos(this)">
                    <button type="button" class="remove-signature" style="background-color: red; color: white; border: none; cursor: pointer; padding: 5px 10px;">Eliminar</button>
                `;
        
                // Agregar la nueva fila al contenedor de firmas manuales
                contenedorFirmasManuales.appendChild(nuevaFilaFirma);
        
                // Agregar funcionalidad para eliminar una fila
                const botonEliminar = nuevaFilaFirma.querySelector('.remove-signature');
                botonEliminar.addEventListener('click', () => {
                    contenedorFirmasManuales.removeChild(nuevaFilaFirma);
                });
            });
        
            // Evento para eliminar la firma manualmente ingresada
            contenedorFirmasManuales.addEventListener('click', (event) => {
                if (event.target.classList.contains('remove-signature')) {
                    event.target.parentElement.remove();
                }
            });
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