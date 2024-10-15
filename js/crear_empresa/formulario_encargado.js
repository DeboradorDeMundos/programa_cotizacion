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
    -------------------------------------- Inicio ITred Spa Formulario encargado  .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

    // Objeto que asocia códigos de país de América con imágenes de banderas
    const banderasPais3 = {
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
    const banderaPorDefecto3 = "https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/World_Flag_%282004%29.svg/640px-World_Flag_%282004%29.svg.png"; // Bandera por defecto

    // Función para detectar el país según el número de teléfono ingresado
    function detectarPais3(input) {
        const numeroTelefono3 = input.value.trim(); // Asegúrate de eliminar espacios
        const imagenBandera3 = document.getElementById("flag_cliente"); // Asegúrate de tener la imagen con este ID
        
        // Itera sobre los códigos de país para detectar el correcto
        for (const codigo in banderasPais3) {
            if (numeroTelefono3.startsWith(codigo)) {
                imagenBandera3.src = banderasPais3[codigo]; // Asigna la imagen de la bandera correspondiente
                imagenBandera3.style.display = "inline"; // Mostrar la imagen de la bandera
                return; // Detener la función si se encuentra el país
            }
        }
        // Si no se encuentra un código de país coincidente, muestra la bandera por defecto
        imagenBandera3.src = banderaPorDefecto3; // Asigna la imagen de la bandera por defecto
        imagenBandera3.style.display = "inline"; // Mostrar la imagen de la bandera por defecto
    }

    // Función para asegurar que el '+' esté presente y detectar el país
    function asegurarMasYDetectarPais3(input) {
        // Verificar si el valor actual comienza con '+'
        if (!input.value.startsWith('+')) {
            input.value = '+' + input.value.replace(/^\+/, ''); // Agregar '+' al inicio si no está presente
        }
        
        // Permitir solo números después del '+' y mantener el '+'
        const validCharacters = input.value.replace(/[^0-9]/g, ''); // Eliminar caracteres no válidos, excepto '+'
        input.value = input.value[0] + validCharacters; // Mantener el '+' y agregar solo los números
     
    }

    // Asegúrate de que la bandera se actualice al cargar la página
    window.onload = function() {
        const campoTelefono3 = document.getElementById('encargado_fono'); // Obtén el campo de entrada del teléfono
        asegurarMasYDetectarPais3(campoTelefono3); // Llama a la función para asegurar "+" y detectar el país
    };

    


// Objeto que asocia códigos de país de América con imágenes de banderas
const banderasPais4 = {
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
const banderaPorDefecto4 = "https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/World_Flag_%282004%29.svg/640px-World_Flag_%282004%29.svg.png"; // Bandera por defecto

// Función para detectar el país según el número de teléfono ingresado
function detectarPais4(input) {
    const numeroTelefono4 = input.value.trim(); // Asegúrate de eliminar espacios
    const imagenBandera4 = document.getElementById("flag_cliente"); // Asegúrate de tener la imagen con este ID
    
    // Itera sobre los códigos de país para detectar el correcto
    for (const codigo in banderasPais4) {
        if (numeroTelefono4.startsWith(codigo)) {
            imagenBandera4.src = banderasPais4[codigo]; // Asigna la imagen de la bandera correspondiente
            imagenBandera4.style.display = "inline"; // Mostrar la imagen de la bandera
            return; // Detener la función si se encuentra el país
        }
    }
    // Si no se encuentra un código de país coincidente, muestra la bandera por defecto
    imagenBandera4.src = banderaPorDefecto4; // Asigna la imagen de la bandera por defecto
    imagenBandera4.style.display = "inline"; // Mostrar la imagen de la bandera por defecto
}

// Función para asegurar que el '+' esté presente y detectar el país
function asegurarMasYDetectarPais4(input) {
    // Verificar si el valor actual comienza con '+'
    if (!input.value.startsWith('+')) {
        input.value = '+' + input.value.replace(/^\+/, ''); // Agregar '+' al inicio si no está presente
    }
    
    // Permitir solo números después del '+' y mantener el '+'
    const validCharacters = input.value.replace(/[^0-9]/g, ''); // Eliminar caracteres no válidos, excepto '+'
    input.value = input.value[0] + validCharacters; // Mantener el '+' y agregar solo los números

   
}

function agregarNuevoFormulario() {
    // Obtiene el contenedor donde están los formularios
    var contenedor = document.getElementById('formulario-contenedor');

    // Clona el primer formulario
    var formularioClonado = contenedor.querySelector('.formulario-encargado').cloneNode(true);

    // Limpia los campos del formulario clonado
    var inputs = formularioClonado.querySelectorAll('input, select');
    inputs.forEach(input => {
        if (input.type !== 'hidden') {
            input.value = ''; // Limpia los valores
        }
    });

    // Añade el formulario clonado al contenedor
    contenedor.appendChild(formularioClonado);
}

// Asegúrate de que la bandera se actualice al cargar la página
window.onload = function() {
    const campoTelefono4 = document.getElementById('encargado_celular'); // Obtén el campo de entrada del teléfono
    asegurarMasYDetectarPais4(campoTelefono4); // Llama a la función para asegurar "+" y detectar el país
};



    
/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Formulario encargado  .JS ---------------------------------------
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