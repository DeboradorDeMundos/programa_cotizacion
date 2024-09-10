// scripts/formulario_cotizacion.js
document.addEventListener('DOMContentLoaded', () => {
    const fechaGeneracion = new Date().toLocaleDateString();
    document.getElementById('fecha-generacion').textContent = fechaGeneracion;

    // Lógica para generar el número de cotización y el RUT de la empresa
    // Esto puede depender de cómo quieras manejar la generación de números de cotización
    const cotizacionNumero = `COT-${Math.floor(Math.random() * 10000)}`;
    document.getElementById('cotizacion-numero').textContent = cotizacionNumero;
    
    // Aquí podrías obtener el RUT de la empresa desde la base de datos o configurarlo manualmente
    const empresaRut = '12345678-9';
    document.getElementById('empresa-rut').textContent = empresaRut;
});
