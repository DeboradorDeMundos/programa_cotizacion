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
    -------------------------------------- Inicio ITred Spa Formulario Vendedor .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */



// TÍTULO: PARA AGREGAR NUEVA FILA VENDEDOR
    // Función para agregar una nueva fila al formulario de vendedores
    function agregarNuevaFilaVendedor() {
        var tabla = document.getElementById('formulario-contenedor-vendedores'); // Obtén la tabla donde se agregarán los vendedores
        var nuevaFila = document.createElement('tr'); // Crea un nuevo elemento de fila

        nuevaFila.innerHTML = `
            <td><input type="text" name="vendedor_rut[]" required minlength="3" maxlength="20" 
                pattern="^[0-9]+[-kK0-9]{1}$" placeholder="Ejemplo: 12345678-9" oninput="formatoRut(this)"></td>
            <td><input type="text" name="vendedor_nombre[]" required minlength="3" maxlength="255" 
                pattern="^[A-Za-zÀ-ÿ\s.-]+$" placeholder="Ejemplo: Juan Pérez" oninput="QuitarCaracteresInvalidos(this)"></td>
            <td><input type="email" name="vendedor_email[]" placeholder="ejemplo@empresa.com" maxlength="100" required></td>
            <td><input type="text" name="vendedor_fono[]" placeholder="+56 9 1234 1234" maxlength="20" required></td>
            <td><input type="text" name="vendedor_celular[]" placeholder="+56 9 1234 1234" maxlength="20" required></td>
            <td><button type="button" class="eliminar-fila" onclick="eliminarFila(this)" style="background-color: red; color: white;">Eliminar</button></td>
        `;

        tabla.appendChild(nuevaFila); // Agrega la nueva fila a la tabla
    }

// TÍTULO PARA ELIMINAR FILA
    // Función para eliminar la fila correspondiente al botón presionado
    function eliminarFila(boton) {
        var fila = boton.closest('tr'); // Encuentra la fila que contiene el botón
        fila.remove(); // Elimina la fila
    }
    

    
/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Formulario Vendedor .JS ---------------------------------------
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