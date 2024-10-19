
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
    -------------------------------------- INICIO ITred Spa Firma  .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

// Título: Cambiar alineación de la firma
// Esta función cambia la alineación del contenedor de la firma y ajusta 
// la visualización de la imagen y el texto según la alineación especificada.
function cambiarAlineacion(alineacion) {
    const contenedor = document.getElementById('firma-container'); // Obtener el contenedor de la firma
    const imagen = document.getElementById('imagen-firma'); // Obtener la imagen de la firma
    const textoFirmaContainer = document.getElementById('texto-firma-container'); // Obtener el contenedor del texto de la firma

    // Restablecer estilos iniciales
    contenedor.style.textAlign = ''; // Reiniciar la alineación del contenedor
    textoFirmaContainer.style.display = ''; // Reiniciar el tipo de visualización del texto

    // Ocultar la imagen por defecto
    if (imagen) {
        imagen.style.display = 'none'; // Ocultar imagen inicialmente
    }

    // Ajustar la alineación según el valor proporcionado
    if (alineacion === 'izquierda') {
        contenedor.style.textAlign = 'left'; // Alinear el contenedor a la izquierda
        textoFirmaContainer.style.display = 'inline-block'; // Mostrar el texto junto a la imagen
        if (imagen) {
            imagen.style.display = 'inline-block'; // Mostrar imagen a la derecha
            imagen.style.marginLeft = '10px'; // Espacio entre texto e imagen
            imagen.style.verticalAlign = 'middle'; // Alinear verticalmente la imagen
            imagen.style.height = 'auto'; // Mantener la proporción de la imagen
        }
    } else if (alineacion === 'centro') {
        contenedor.style.textAlign = 'center'; // Alinear el contenedor al centro
        textoFirmaContainer.style.display = 'block'; // Mostrar el texto en bloque
        if (imagen) {
            imagen.style.display = 'block'; // Mostrar imagen arriba del texto
            imagen.style.marginBottom = '5px'; // Espacio entre imagen y texto
            imagen.style.width = 'auto'; // Ajustar ancho automáticamente
            imagen.style.maxWidth = '150px'; // Limitar el ancho de la imagen
            imagen.style.margin = '0 auto'; // Centrar la imagen
            imagen.style.height = 'auto'; // Mantener la proporción de la imagen
        }
    } else if (alineacion === 'derecha') {
        contenedor.style.textAlign = 'right'; // Alinear el contenedor a la derecha
        textoFirmaContainer.style.display = 'inline-block'; // Mostrar el texto a la izquierda de la imagen
        if (imagen) {
            imagen.style.display = 'inline-block'; // Mostrar imagen a la derecha
            imagen.style.marginLeft = '10px'; // Espacio entre texto e imagen
            imagen.style.verticalAlign = 'middle'; // Alinear verticalmente la imagen
            imagen.style.height = 'auto'; // Mantener la proporción de la imagen
        }
    }

    // Aplicar estilo a cada texto dentro del contenedor
    const textos = contenedor.querySelectorAll('#texto-firma'); // Obtener todos los elementos de texto
    textos.forEach(texto => {
        texto.style.margin = '0'; // Eliminar márgenes para un mejor alineamiento
        texto.style.lineHeight = '1.5'; // Ajustar el interlineado del texto
    });
}

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Firma  .JS ---------------------------------------
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