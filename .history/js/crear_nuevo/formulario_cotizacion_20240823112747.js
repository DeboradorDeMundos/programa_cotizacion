document.addEventListener('DOMContentLoaded', () => {
    const fechaGeneracion = new Date().toLocaleDateString();
    document.getElementById('fecha-generacion').textContent = fechaGeneracion;

    // Lógica para generar el número de cotización
    const cotizacionNumero = `COT-${Math.floor(Math.random() * 10000)}`;
    document.getElementById('cotizacion-numero').textContent = cotizacionNumero;
    
    // Asignar valores al formulario
    document.getElementById('numero_cotizacion').value = cotizacionNumero;
    document.getElementById('fecha_emision').value = new Date().toISOString().split('T')[0]; // Fecha actual

    // Solicitud AJAX para obtener el RUT de la empresa
    fetch('obtener_rut_empresa.php')
        .then(response => response.json())
        .then(data => {
            if (data.rut) {
                document.getElementById('empresa-rut').textContent = data.rut;
                document.getElementById('numero_cotizacion').value = cotizacionNumero;
            } else if (data.error) {
                console.error(data.error);
            }
        })
        .catch(error => {
            console.error('Error al obtener el RUT de la empresa:', error);
        });
});


