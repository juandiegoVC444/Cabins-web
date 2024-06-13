<?php
 ob_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bill.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
     <style>

body{
    font-family: Verdana, Geneva, Tahoma, sans-serif
}

    </style>


    <title>Factura</title>
</head>
<body>
    <header class="text-center">
        <span class="title">FACTURA</span>
    </header>

    <main class="cuerpo">

        <span class="subtitle">Reserva</span>

          <div class="container">
            <div class="row">
              <ul class="col text-left list-unstyled ">
                <li>Código de reserva: {{ $booking->booking_code }}</li>
                <li>Método de pago: {{ $booking->title_payment }} </li>
                <li>Cantidad adultos: {{ $booking->amount_adults }}</li>
                <li>Cantidad niños: {{ $booking->amount_child }}</li>
              </ul>
              <ul class="col text-left list-unstyled">
                <li>Total reserva: {{ $total_booking }} </li>
                <li>Fecha inicio:  {{ $booking->initial_date }} </li>
                <li>Fecha Fin: {{ $booking->final_date }} </li>
              </ul>
            </div>
         </div>

        <hr>
        <span class="subtitle">Servicio</span>

        <div class="container">
            <div class="row">
              <ul class="col text-left list-unstyled">
                <li>Nombre del servicio: {{ $booking->tittle }}</li>
              </ul>
              <ul class="col text-left list-unstyled">
                <li>TOTAL: $ {{ $booking->total }}</li>
              </ul>
            </div>
         </div>

         <hr>

         <span class="subtitle">Productos</span>
         <br><br><br>
         <div class="container text-center">
            <div class="row">
              <div class="col">

                <table class="table table-striped table-sm table-bordered  border border-warning-subtle ">
                  <thead>
                    <tr>
                      <th scope="col">PRODUCTO</th>
                      <th scope="col">PRECIO/U</th>
                      <th scope="col">CANTIDAD</th>
                      <th scope="col">SUBTOTAL</th>
                    </tr>
                  </thead>

                  @foreach ( $booking_product as $boop )

                  <?php  $boop->total = $boop->price * $boop->amount_product ?>
                  <tbody>
                    <tr>
                      <td>{{ $boop->name_product }} </td>
                      <td>$ {{ $boop->price }} </td>
                      <td> {{ $boop->amount_product }} </td>
                      <td>$ {{ $boop->total }} </td>
                    </tr>
                  </tbody>
                  @endforeach

                </table>

              </div>
            </div>
            <br>
            <span class="subtitle">TOTAL PRODUCTOS: $  {{ $suma_product }} </span>
         </div>
         <br>
         <hr>


         <div class="container center">

          <div class="row">
            <ul class="col list-unstyled">
              <span class="subtitle">Solicitante</span>
              <li>Nombre del usuario:  {{ $booking->name }} {{ $booking->last_name }} </li>
              <li>Teléfono:  {{ $booking->phone_number }} </li>
              <li>Numero de identificacion:  {{ $booking->identification_number }} </li>
              <li>Correo Electronico:  {{ $booking->email }} </li>
            </ul>
            <ul class="col list-unstyled">
              <span class="subtitle">Miembros</span>
              <li>Fecha de creación:  {{ $booking->create_time }} </li>
              <li>Última actualización: {{ $booking->update_time }} </li>
              <li>Estado:  {{ $booking->state_record }} </li>
            </ul>

          </div>
       </div>
       <hr>

       {{-- <div class="container">
        <h3>TRANSACCIÓN</h3>
        <div class="row">
          <ul class="col list-unstyled">
            <li>N° Transacción:</li>
            <li>Referencia:</li>
            <li>E-mail:</li>
            <li>Nombre del pagador:</li>
            <li>Teléfono:</li>
          </ul>
        </div>
     </div> --}}
    </main>

    <footer>

    </footer>

</body>
</html>

<?php

$html = ob_get_clean();
require_once "libreria/dompdf/autoload.inc.php";
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);

$dompdf->setPaper('letter');

$dompdf->render();
$dompdf->stream("factura_.pdf", array("Attachment" => false));


?>
