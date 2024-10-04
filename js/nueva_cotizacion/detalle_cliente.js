
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
    -------------------------------------- INICIO ITred Spa Detalle cliente.JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

    function formatPhoneNumber(input) {
        // Eliminar todo lo que no sea número o espacio
        let value = input.value.replace(/[^\d]/g, '');
        
        // Verificar que el número de caracteres sea mayor que 10 (código de país + número)
        if (value.length > 10) {
            // Formatear el número
            value = value.replace(/^(\d{2})(\d)(\d{4})(\d{4})$/, '+$1 $2 $3 $4');
        } else if (value.length > 7) {
            value = value.replace(/^(\d{2})(\d)(\d{4})$/, '+$1 $2 $3');
        } else if (value.length > 2) {
            value = value.replace(/^(\d{2})(\d)$/, '+$1 $2');
        } else if (value.length > 1) {
            value = value.replace(/^(\d{2})$/, '+$1');
        }
    
        input.value = value; // Actualizar el valor del campo de entrada
    }

    function completeEmail(input) {
        // Eliminar comillas simples y dobles de la entrada
        input.value = input.value.replace(/['"]/g, '');
    
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Expresión regular para validar el correo electrónico
        
        // Verificar si el correo tiene un formato válido
        if (!emailPattern.test(input.value)) {
            // Comprobar si el valor no contiene '@'
            if (!input.value.includes('@')) {
                input.value += '@gmail.com'; // Añadir '@gmail.com' si no se ingresó
            } else {
                alert("Por favor, ingresa un correo electrónico válido."); // Mensaje de error si no es válido
            }
        }
    }

    function removeInvalidChars(input) {
        // Eliminar comillas simples, dobles y cualquier otro carácter no deseado
        input.value = input.value.replace(/['"]/g, '');
    }


// Objeto que asocia códigos de país de América con imágenes de banderas
const banderasPais = {
    "+1": "https://upload.wikimedia.org/wikipedia/commons/thumb/a/a4/Flag_of_the_United_States.svg/32px-Flag_of_United_States.svg.png", // USA
    "+52": "https://upload.wikimedia.org/wikipedia/commons/thumb/f/fc/Flag_of_Mexico.svg/32px-Flag_of_Mexico.svg.png", // Mexico
    "+56": "https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Flag_of_Chile.svg/32px-Flag_of_Chile.svg.png", // Chile
    "+54": "https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Flag_of_Argentina.svg/32px-Flag_of_Argentina.svg.png", // Argentina
    "+57": "https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/Flag_of_Colombia.svg/32px-Flag_of_Colombia.svg.png", // Colombia
    "+58": "https://upload.wikimedia.org/wikipedia/commons/thumb/0/06/Flag_of_Venezuela.svg/32px-Flag_of_Venezuela.svg.png", // Venezuela
    "+51": "https://upload.wikimedia.org/wikipedia/commons/thumb/c/cf/Flag_of_Peru.svg/32px-Flag_of_Peru.svg.png", // Peru
    "+503": "https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Flag_of_El_Salvador.svg/32px-Flag_of_El_Salvador.svg.png", // El Salvador
    "+591": "https://upload.wikimedia.org/wikipedia/commons/thumb/4/48/Flag_of_Bolivia.svg/32px-Flag_of_Bolivia.svg.png", // Bolivia
    "+507": "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ab/Flag_of_Panama.svg/32px-Flag_of_Panama.svg.png", // Panama
    "+505": "https://upload.wikimedia.org/wikipedia/commons/thumb/1/19/Flag_of_Nicaragua.svg/32px-Flag_of_Nicaragua.svg.png", // Nicaragua
    "+502": "https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Flag_of_Guatemala.svg/32px-Flag_of_Guatemala.svg.png", // Guatemala
    "+504": "https://upload.wikimedia.org/wikipedia/commons/thumb/8/82/Flag_of_Honduras.svg/32px-Flag_of_Honduras.svg.png", // Honduras
    "+53": "https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Flag_of_Cuba.svg/32px-Flag_of_Cuba.svg.png", // Cuba
    "+55": "https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Flag_of_Brazil.svg/32px-Flag_of_Brazil.svg.png", // Brazil
    "+598": "https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Flag_of_Uruguay.svg/32px-Flag_of_Uruguay.svg.png", // Uruguay
    "+509": "https://upload.wikimedia.org/wikipedia/commons/thumb/5/56/Flag_of_Haiti.svg/32px-Flag_of_Haiti.svg.png", // Haiti
    "+593": "https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Flag_of_Ecuador.svg/32px-Flag_of_Ecuador.svg.png", // Ecuador
    "+595": "https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/Flag_of_Paraguay.svg/32px-Flag_of_Paraguay.svg.png" // Paraguay
};

// Imagen de bandera por defecto cuando no coincide con ningún código
const banderaPorDefecto = "https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/World_Flag_%282004%29.svg/640px-World_Flag_%282004%29.svg.png"; // Bandera por defecto

// Función para detectar el país según el número de teléfono ingresado
function detectarPais(input) {
    const numeroTelefono = input.value.trim(); // Asegúrate de eliminar espacios
    const imagenBandera = document.getElementById("flag_cliente");
    
    // Itera sobre los códigos de país para detectar el correcto
    for (const codigo in banderasPais) {
        if (numeroTelefono.startsWith(codigo)) {
            imagenBandera.src = banderasPais[codigo];
            imagenBandera.style.display = "inline"; // Mostrar la imagen de la bandera
            return; // Detener la función si se encuentra el país
        }
    }
    // Si no se encuentra un código de país coincidente, muestra la bandera por defecto
    imagenBandera.src = banderaPorDefecto;
    imagenBandera.style.display = "inline";
}

// Función para asegurar que el '+' esté presente y detectar el país
function asegurarMasYDetectarPais(input) {
    // Verificar si el valor actual comienza con '+'
    if (!input.value.startsWith('+')) {
        input.value = '+' + input.value.replace(/^\+/, ''); // Agregar '+' al inicio
    }


     // Permitir solo números después del '+' y mantener el '+'
     const validCharacters = input.value.replace(/[^0-9]/g, ''); // Eliminar caracteres no válidos, excepto '+'
     input.value = input.value[0] + validCharacters; // Mantener el '+' y agregar solo los números
 
    // Llamar a la función de detección de la bandera
    detectarPais(input);
}

// Asegúrate de que la bandera se actualice al cargar la página
window.onload = function() {
    const campoTelefono = document.getElementById('cliente_fono');
    asegurarMasYDetectarPais(campoTelefono); // Llama a la función para asegurar "+" y detectar el país
};

    

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Detalle cliente.JS ---------------------------------------
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