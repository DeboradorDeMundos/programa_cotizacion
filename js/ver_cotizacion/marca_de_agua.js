
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
    -------------------------------------- INICIO ITred Spa Marca de agua .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
    function cambiarMarcaAgua(tipo) {
        const marcaAguaDiv = document.getElementById('marca-agua');
        const fotoInput = document.getElementById('foto-personalizada-input');
        const textoInput = document.getElementById('texto-personalizado-input');
        const textoMarcaAgua = document.getElementById('texto-marca-agua');
    
        // Ocultar todos los elementos de marca de agua
        textoMarcaAgua.style.display = 'none';
        marcaAguaDiv.querySelector('.foto-marca-agua')?.remove();
    
        if (tipo === 'nombre_empresa') {
            // Mostrar el nombre de la empresa
            textoMarcaAgua.style.display = 'block';
        } else if (tipo === 'foto_empresa') {
            // Mostrar la foto de la empresa
            const fotoSrc = textoMarcaAgua.getAttribute('data-foto-empresa');
            if (fotoSrc) {
                const img = document.createElement('img');
                img.src = fotoSrc;
                img.alt = "Foto de la empresa";
                img.classList.add('foto-marca-agua');
                marcaAguaDiv.appendChild(img);
            }
        } else if (tipo === 'foto_personalizada' && fotoInput.files.length > 0) {
            // Mostrar la foto personalizada
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = "Foto personalizada";
                img.classList.add('foto-marca-agua');
                marcaAguaDiv.appendChild(img);
            };
            reader.readAsDataURL(fotoInput.files[0]);
        } else if (tipo === 'texto_personalizado' && textoInput.value.trim() !== '') {
            // Mostrar el texto personalizado
            textoMarcaAgua.textContent = textoInput.value.trim();
            textoMarcaAgua.style.display = 'block';
        }
    }
/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Marca de agua .JS ---------------------------------------
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