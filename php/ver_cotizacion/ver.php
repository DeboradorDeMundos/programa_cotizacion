<html>
 <head>
  <style>
   body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #000;
        }
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .logo {
            width: 100px;
            height: 100px;
            margin-right: 20px;
        }
        .header, .footer {
            text-align: left;
            display: inline-block;
            vertical-align: top;
        }
        .header {
            width: calc(100% - 120px);
        }
        .header h1 {
            margin: 0;
            font-size: 16px;
        }
        .header h2 {
            margin: 0;
            font-size: 14px;
        }
        .header .contact-info {
            margin-top: 10px;
        }
        .header .contact-info p {
            margin: 2px 0;
        }
        .invoice-info {
            text-align: right;
            border: 2px solid red;
            padding: 10px;
            display: inline-block;
            vertical-align: top;
            width: 35%;
            color: red;
        }
        .invoice-info p, .invoice-info h3 {
            margin: 2px 0;
        }
        .sii-info {
            text-align: right;
            color: red;
            margin-top: 0;
        }
        .customer-info, .details, .items, .observations, .totals, .bank-info {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .customer-info td, .details td, .items td, .observations td, .totals td, .bank-info td {
            border: 1px solid #000;
            padding: 5px;
        }
        .items th, .totals th {
            border: 1px solid #000;
            padding: 5px;
            background-color: #f0f0f0;
        }
        .items td {
            vertical-align: top;
            padding-top: 5px;
            height: 200px;
        }
        .items {
            border-radius: 10px;
            overflow: hidden;
        }
        .items .codigo {
            width: 10%;
        }
        .items .descripcion {
            width: 30%;
        }
        .items .unid, .items .cant, .items .precio, .items .dscto, .items .total {
            width: 10%;
        }
        .totals-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .totals {
            width: 48%;
        }
        .observations {
            width: 48%;
        }
        .observations td {
            height: 30px;
        }
        .observations .large-cell {
            height: 100px;
        }
        .barcode-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 20px;
        }
        .barcode {
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }
        .barcode img {
            width: 100%;
            height: 50px;
        }
        .footer p {
            margin: 2px 0;
        }
        .totals .son {
            border-top: 1px solid #000;
            padding-top: 5px;
            margin-top: 10px;
        }
        .bank-info {
            width: 48%;
            text-align: center;
        }
  </style>
 </head>
 <body>
  <div class="container">
   <div class="header-container">
    <img alt="Company Logo" class="logo" height="100" src="../../imagenes/programa_cotizacion/prueba2.png" width="100"/>
    <div class="header">
     <h1>
      SoportePabloG
     </h1>
     <h2>
      SoportePabloG
     </h2>
     <div class="contact-info">
      <p>
       DIRECCIÓN: freire 123
      </p>
      <p>
       TELÉFONO: 933341396
      </p>
      <p>
       E-MAIL: pablo.gutierrez@dtemite.cl
      </p>
      <p>
       WEB:
      </p>
     </div>
    </div>
    <div class="invoice-info">
     <p>
      R.U.T.: 19.279.652-0
     </p>
     <h3>
      FACTURA ELECTRÓNICA
     </h3>
     <p>
      Nº: 133
     </p>
     <p class="sii-info">
      S.I.I. - SISTEMA DE PRUEBAS
     </p>
    </div>
   </div>
   <table class="customer-info">
    <tbody>
     <tr>
      <td>
       <strong>SEÑOR(ES):</strong> EMPRESAS LA POLAR S.A.<br>
       <strong>RUT:</strong> 16.211.403-4<br>
       <strong>DIRECCIÓN:</strong> DIRECCION<br>
       <strong>GIRO:</strong> SIN GIRO<br>
       <strong>COMUNA:</strong> SANTIAGO<br>
       <strong>CIUDAD:</strong> SANTIAGO<br>
       <strong>TELÉFONO:</strong><br>
       <strong>FORMA PAGO:</strong> DEPOSITO O TRANSFERENCIA
      </td>
      <td>
       <strong>F. EMISIÓN:</strong> 27-09-2024<br>
       <strong>F. VENCIMIENTO:</strong> 27-09-2024<br>
       <strong>CABECERA:</strong><br>
       <strong>CABECERA1:</strong>
      </td>
     </tr>
     <tr>
      <td colspan="2">
       <strong>DOCUMENTOS DE REFERENCIA</strong><br>
       Cotización: 23, Fecha: 27-09-2024
      </td>
     </tr>
    </tbody>
   </table>
   <table class="items">
    <tr>
     <th class="codigo">
      CÓDIGO
     </th>
     <th class="descripcion">
      DESCRIPCIÓN
     </th>
     <th class="unid">
      UNID.
     </th>
     <th class="cant">
      CANT.
     </th>
     <th class="precio">
      PRECIO
     </th>
     <th class="dscto">
      DSCTO.
     </th>
     <th class="total">
      TOTAL
     </th>
    </tr>
    <tr style="height: 200px;">
     <td>
      regalos<br>regalos<br>regalos<br>regalos
     </td>
     <td>
      regalos<br>regalos<br>regalos<br>regalos
     </td>
     <td>
      KILOG<br>KILOG<br>KILOG<br>KILOG
     </td>
     <td>
      5,00<br>5,00<br>5,00<br>5,00
     </td>
     <td>
      100,00<br>100,00<br>100,00<br>100,00
     </td>
     <td>
      0<br>0<br>0<br>0
     </td>
     <td>
      500<br>500<br>500<br>500
     </td>
    </tr>
   </table>
   <div class="totals-container">
    <table class="observations">
     <tr>
      <td>
       OBSERVACIONES
      </td>
     </tr>
     <tr class="large-cell">
      <td>
      </td>
     </tr>
    </table>
    <table class="totals">
     <tr>
      <td>
       NETO
      </td>
      <td>
       $ 500
      </td>
     </tr>
     <tr>
      <td>
       EXENTO
      </td>
      <td>
       $ 0
      </td>
     </tr>
     <tr>
      <td>
       19% I.V.A.
      </td>
      <td>
       $ 95
      </td>
     </tr>
     <tr>
      <td>
       DESCUENTO
      </td>
      <td>
       $ 0
      </td>
     </tr>
     <tr>
      <td>
       IMP. ADICIONAL
      </td>
      <td>
       $ 0
      </td>
     </tr>
     <tr>
      <td>
       TOTAL
      </td>
      <td>
       $ 595
      </td>
     </tr>
    </table>
   </div>
   <table class="totals">
    <tr class="son">
     <td colspan="2">
      SON: QUINIENTOS NOVENTA Y CINCO PESOS
     </td>
    </tr>
   </table>
   <div class="barcode-container">
    <table class="bank-info">
     <tr>
      <td>
       <strong>BANCO:</strong> Banco Itaú<br>
       <strong>TIPO CUENTA:</strong> Cuenta Ahorros<br>
       <strong>N° CUENTA:</strong> 1234567892344324324324324<br>
       <strong>RUT:</strong> 19.279.652-0<br>
       <strong>TITULAR:</strong> Pablo Gutierrez<br>
       <strong>ENVIAR EMAIL A:</strong> soporte@dtemite.cl
      </td>
     </tr>
    </table>
    <table class="bank-info">
     <tr>
      <td>
       <strong>BANCO:</strong> Banco Santander<br>
       <strong>TIPO CUENTA:</strong> Cuenta Corriente<br>
       <strong>N° CUENTA:</strong> 9876543210987654321098765<br>
       <strong>RUT:</strong> 19.279.652-0<br>
       <strong>TITULAR:</strong> Pablo Gutierrez<br>
       <strong>ENVIAR EMAIL A:</strong> soporte@dtemite.cl
      </td>
     </tr>
    </table>
    <table class="bank-info">
     <tr>
      <td>
       <strong>BANCO:</strong> Banco de Chile<br>
       <strong>TIPO CUENTA:</strong> Cuenta Vista<br>
       <strong>N° CUENTA:</strong> 1122334455667788990011223<br>
       <strong>RUT:</strong> 19.279.652-0<br>
       <strong>TITULAR:</strong> Pablo Gutierrez<br>
       <strong>ENVIAR EMAIL A:</strong> soporte@dtemite.cl
      </td>
     </tr>
    </table>
   </div>
   <div class="barcode">
    <img alt="Barcode" height="50" src="../../imagenes/programa_cotizacion/prueba2.png" width="800"/>
    <p>
     Timbre Electrónico SII
    </p>
   </div>
   <div class="footer">
    <p>
     Resolución 80 del 2014-08-22 Verifique Documento: http://www.sii.cl
    </p>
    <p>
     www.dtemite.cl
    </p>
   </div>
  </div>
 </body>
</html>