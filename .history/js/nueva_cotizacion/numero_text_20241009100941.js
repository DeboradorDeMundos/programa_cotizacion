
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
    -------------------------------------- INICIO ITred Spa Numero text .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

    function numeroATexto(numero) {
        const unidades = [
            '', 'uno', 'dos', 'tres', 'cuatro', 'cinco',
            'seis', 'siete', 'ocho', 'nueve', 'diez',
            'once', 'doce', 'trece', 'catorce', 'quince',
            'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve'
        ];
    
        const decenas = [
            '', '', 'veinte', 'treinta', 'cuarenta',
            'cincuenta', 'sesenta', 'setenta',
            'ochenta', 'noventa'
        ];
    
        const centenas = [
            '', 'cien', 'doscientos', 'trescientos',
            'cuatrocientos', 'quinientos',
            'seiscientos', 'setecientos',
            'ochocientos', 'novecientos'
        ];
    
        if (numero === 0) {
            return 'cero';
        } else if (numero < 20) {
            return unidades[numero];
        } else if (numero < 100) {
            const decena = Math.floor(numero / 10);
            const unidad = numero % 10;
            return decenas[decena] + (unidad > 0 ? ' y ' + unidades[unidad] : '');
        } else if (numero < 1000) {
            const centena = Math.floor(numero / 100);
            const resto = numero % 100;
            if (centena === 1 && resto > 0) {
                return 'ciento ' + numeroATexto(resto);
            }
            return centenas[centena] + (resto > 0 ? ' ' + numeroATexto(resto) : '');
        } else if (numero < 1000000) {
            const miles = Math.floor(numero / 1000);
            const resto = numero % 1000;
            if (miles === 1) {
                return 'mil' + (resto > 0 ? ' ' + numeroATexto(resto) : '');
            }
            return numeroATexto(miles) + ' mil' + (resto > 0 ? ' ' + numeroATexto(resto) : '');
        } else if (numero < 1000000000) {
            const millones = Math.floor(numero / 1000000);
            const resto = numero % 1000000;
            if (millones === 1) {
                return 'un millón' + (resto > 0 ? ' ' + numeroATexto(resto) : '');
            }
            return numeroATexto(millones) + ' millones' + (resto > 0 ? ' ' + numeroATexto(resto) : '');
        }
    
        return 'Número fuera de rango';
    }

    
// Función para obtener el valor del input y convertirlo a texto
function convertirTotalATexto() {
    const totalFinalInput = document.getElementById('total_final');
    const totalEnTextoInput = document.getElementById('total-en-texto'); // Campo oculto
    
    console.log("Valor del input:", totalFinalInput.value); // Depuración
    
    // Eliminar cualquier carácter que no sea dígito, punto o coma
    let valorLimpio = totalFinalInput.value.replace(/[^\d.,]/g, '');
    
    // Reemplazar coma por punto para asegurar un formato numérico válido
    valorLimpio = valorLimpio.replace(',', '.');
    
    console.log("Valor limpio:", valorLimpio); // Depuración
    
    const numero = parseFloat(valorLimpio);
    
    console.log("Número parseado:", numero); // Depuración
    
    if (!isNaN(numero)) {
        const numeroRedondeado = Math.round(numero);
        console.log("Número redondeado:", numeroRedondeado); // Depuración
        
        const textoConvertido = numeroATexto(numeroRedondeado);
        totalEnTextoInput.value = textoConvertido;
        
        console.log("Texto convertido:", textoConvertido); // Depuración
        
        // Mostrar el número en texto en el DOM (si es necesario)
        const totalEnTextoDisplay = document.getElementById('total-en-texto-display');
        if (totalEnTextoDisplay) {
            totalEnTextoDisplay.textContent = textoConvertido;
        }
    } else {
        console.log("Valor inválido ingresado"); // Depuración
        totalEnTextoInput.value = '';
        
        const totalEnTextoDisplay = document.getElementById('total-en-texto-display');
        if (totalEnTextoDisplay) {
            totalEnTextoDisplay.textContent = '';
        }
    }
}

// Función para inicializar el evento y realizar la conversión inicial
function inicializarConversion() {
    const totalFinalInput = document.getElementById('total_final');
    if (totalFinalInput) {
        totalFinalInput.addEventListener('input', convertirTotalATexto);
        // Realizar la conversión inicial si hay un valor
        convertirTotalATexto();
    } else {
        console.error("No se encontró el elemento con id 'total_final'");
    }
}

// Asegurarse de que la función se ejecute cuando se carga la página
document.addEventListener('DOMContentLoaded', inicializarConversion);
/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Numero text .JS ---------------------------------------
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