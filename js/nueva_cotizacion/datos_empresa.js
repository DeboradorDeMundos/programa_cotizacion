
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
    -------------------------------------- INICIO ITred Spa Datos empresa.JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
// TÍTULO: PARA EL OBJETO DE BANDERAS
 // Objeto que asocia códigos de país de América con imágenes de banderas
    const BanderasPaises = {
        "+1": "https://upload.wikimedia.org/wikipedia/commons/thumb/a/a4/Flag_of_the_United_States.svg/32px-Flag_of_United_States.svg.png", // USA
        "+52": "https://upload.wikimedia.org/wikipedia/commons/thumb/f/fc/Flag_of_Mexico.svg/32px-Flag_of_Mexico.svg.png", // México
        "+56": "https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Flag_of_Chile.svg/32px-Flag_of_Chile.svg.png", // Chile
        "+54": "https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Flag_of_Argentina.svg/32px-Flag_of_Argentina.svg.png", // Argentina
        "+57": "https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/Flag_of_Colombia.svg/32px-Flag_of_Colombia.svg.png", // Colombia
        "+58": "https://upload.wikimedia.org/wikipedia/commons/thumb/0/06/Flag_of_Venezuela.svg/32px-Flag_of_Venezuela.svg.png", // Venezuela
        "+51": "https://upload.wikimedia.org/wikipedia/commons/thumb/c/cf/Flag_of_Peru.svg/32px-Flag_of_Peru.svg.png", // Perú
        "+503": "https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Flag_of_El_Salvador.svg/32px-Flag_of_El_Salvador.svg.png", // El Salvador
        "+591": "https://upload.wikimedia.org/wikipedia/commons/thumb/4/48/Flag_of_Bolivia.svg/32px-Flag_of_Bolivia.svg.png", // Bolivia
        "+507": "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ab/Flag_of_Panama.svg/32px-Flag_of_Panama.svg.png", // Panamá
        "+505": "https://upload.wikimedia.org/wikipedia/commons/thumb/1/19/Flag_of_Nicaragua.svg/32px-Flag_of_Nicaragua.svg.png", // Nicaragua
        "+502": "https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Flag_of_Guatemala.svg/32px-Flag_of_Guatemala.svg.png", // Guatemala
        "+504": "https://upload.wikimedia.org/wikipedia/commons/thumb/8/82/Flag_of_Honduras.svg/32px-Flag_of_Honduras.svg.png", // Honduras
        "+53": "https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Flag_of_Cuba.svg/32px-Flag_of_Cuba.svg.png", // Cuba
        "+55": "https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Flag_of_Brazil.svg/32px-Flag_of_Brazil.svg.png", // Brasil
        "+598": "https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Flag_of_Uruguay.svg/32px-Flag_of_Uruguay.svg.png", // Uruguay
        "+509": "https://upload.wikimedia.org/wikipedia/commons/thumb/5/56/Flag_of_Haiti.svg/32px-Flag_of_Haiti.svg.png", // Haití
        "+593": "https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Flag_of_Ecuador.svg/32px-Flag_of_Ecuador.svg.png", // Ecuador
        "+595": "https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/Flag_of_Paraguay.svg/32px-Flag_of_Paraguay.svg.png" // Paraguay
    };
// TÍTULO: PARA LA BANDERA POR DEFECTO
    // Imagen de bandera por defecto cuando no coincide con ningún código
        const defaultFlag = "https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/World_Flag_%282004%29.svg/640px-World_Flag_%282004%29.svg.png"; // Bandera por defecto

// TÍTULO PARA LA FUNCIÓN DE DETECCIÓN DE PAÍS
    // Función para detectar el país según el número de teléfono ingresado
    function DetectarPais(input) {
        const NumeroDeTelefono = input.value.trim(); // Asegúrate de eliminar espacios
        const ImagenBandera = document.getElementById("flag");
        
        // Itera sobre los códigos de país para detectar el correcto
        for (const Codigo in BanderasPaises) {
            if (NumeroDeTelefono.startsWith(Codigo)) {
                ImagenBandera.src = BanderasPaises[Codigo]; // Establece la imagen de la bandera correspondiente
                ImagenBandera.style.display = "inline"; // Mostrar la imagen de la bandera
                return; // Detener la función si se encuentra el país
            }
        }
        // Si no se encuentra un código de país coincidente, muestra la bandera por defecto
        ImagenBandera.src = defaultFlag; // Establece la bandera por defecto
        ImagenBandera.style.display = "inline"; // Mostrar la imagen de la bandera
    }

// TÍTULO PARA LA FUNCIÓN DE AGREGAR '+' Y DETECTAR PAÍS
    // Función para agregar un '+' al principio y detectar el país
    function AgregarMasYDetectarPais(input) {
        // Comprobar si el valor ya comienza con '+', si no, agregarlo
        if (!input.value.startsWith('+')) {
            input.value = '+' + input.value.replace(/^\+/, ''); // Asegurarse de que solo haya un '+' 
        }

        // Permitir solo números después del '+' y mantener el '+'
        const CaracteresValidos = input.value.replace(/[^0-9]/g, ''); // Eliminar caracteres no válidos, excepto '+'
        input.value = input.value[0] + CaracteresValidos; // Mantener el '+' y agregar solo los números

        // Llamar a la función de detección de la bandera
        DetectarPais(input); // Ejecutar la función de detección de país
    }

// TÍTULO PARA LA INICIALIZACIÓN AL CARGAR LA PÁGINA
    // Asegúrate de que la bandera se actualice al cargar la página
    window.onload = function() {
        const CampoInput = document.getElementById('empresa_telefono');
        AgregarMasYDetectarPais(CampoInput); // Llama a la función para asegurar "+" y detectar el país
    };

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Datos empresa.JS ---------------------------------------
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