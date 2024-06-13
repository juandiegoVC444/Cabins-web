<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link rel="stylesheet" href="{{ asset('css/shoppingcar/shoppingcar.css') }}">
</head>

<body class="cuerpo">
    <header>

        @include('layouts.nav')
    </header>
    <div class="cabecera" style="margin-top: 8%;">
        <h1 class="h1titulo">  {{ __('Shopping Car') }}</h1>
    </div>
    <main style="margin-bottom: 5%">
        @php
            $totalP = 0;
            $totalS = 0;
        @endphp


        <table style="margin-left: 2%;" class="bottom-border">
            <thead>
                <tr>
                    <th style=" text-align: center;"> {{ __('SERVICE') }}</th>

                    <th> {{ __('Quantity Adults') }} </th>
                    <th>{{ __('Quantity Children') }} </th>
                    <th> {{ __('Stay') }} </th>
                    <th> {{ __('PRICE') }}</th>
                </tr>
            </thead>

            <tbody>


                @foreach ($detailServices as $index => $detailService)
                    @if (gettype($detailService) == 'object')
                        <?php
                        $subtotalS = $detailService->precio;
                        $formatS = number_format($subtotalS);
                        ?>
                        <tr>
                            <div style="margin-top: 25%; margin-bottom: 25%;">
                                <td style=" text-align: center;">
                                    <div style="margin-bottom: 10%;">
                                        {{ $detailService->nombre }}
                                    </div>

                                    <img style="margin-bottom: 10%;" class="image" height="100px"
                                        src="{{ asset('storage/imgServices') . '/' . $detailService->imgServicios }}" />
                                </td>

                            </div>
                            <form>
                                <td>
                                    <div style="margin-bottom: 5%;" class="contenedores">
                                        <a class="estilobtn  btnRestaSA"
                                            data-iddetail_serviceA="{{ $index }}">-</a>
                                        <span class="estilovsta spanCantidadAdulto{{ $index }}">
                                            {{ $detailService->cantidad_adultos }}
                                        </span>
                                        <input type="hidden" name="amount_products" value="1">
                                        <a class="estilobtn btnSumaSA"
                                            data-iddetail_serviceA="{{ $index }}">+</a>

                                    </div>
                                </td>
                            </form>
                            <form>
                                <td>
                                    <div style="margin-bottom: 5%;" class="contenedores">
                                        <a class="estilobtn  btnRestaSN"
                                            data-iddetail_serviceN="{{ $index }}">-</a>
                                        <span class="estilovsta spanCantidadNinos{{ $index }}">
                                            {{ $detailService->cantidad_ninos }}
                                        </span>
                                        <input type="hidden" name="amount_products" value="1">
                                        <a class="estilobtn btnSumaSN"
                                            data-iddetail_serviceN="{{ $index }}">+</a>
                                    </div>
                                </td>
                            </form>
                            <td>

                                <label type="text" name="fecha" readonly> fecha inicial :
                                    {{ $detailService->fecha_inicial }} <br>
                                    fecha final: {{ $detailService->fecha_final }} <br> dias:
                                    {{ $detailService->dias }}
                                </label>
                            </td>

                            <td>
                                <div style="margin-bottom: 20%;">$ {{ $formatS }}</div>
                                <a class="a-quitar" href="{{ Route('shoppingCar.clearProduct', $index) }}"> <i
                                        class="fas fa-trash"></i></a>
                            </td>

                        </tr>

                        <?php $totalS = $totalS + $subtotalS; ?>
                    @endif
                @endforeach

            </tbody>
        </table>

        <br>
        <div class=" tabla">


            <!-----------------------------------------Productos-------------------------------------------------------------------->
            <table style="margin-left: 2%;" class="bottom-border">
                <thead>
                    <tr>
                        <th style=" text-align: center;">{{ __('PRODUCTS') }}</th>
                        <th></th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $index => $product)
                        @if (gettype($product) == 'object')
                            <?php $subtotal = $product->cantidad * $product->precio;

                            $format = number_format($subtotal); ?>
                            <tr>
                                <div style="margin-top: 25%; margin-bottom: 25%;">
                                    <td style=" text-align: center;">
                                        <img class="image" height="100px"
                                            src="{{ asset('storage/imgProducts') . '/' . $product->imagen }}" />
                                    </td>

                                </div>
                                <form>
                                    <td>
                                        <div style="margin-bottom: 10%;">
                                            {{ $product->nombre }}
                                        </div>
                                        <div style="margin-bottom: 5%;">
                                            <div class="contenedores">

                                                <a class="estilobtn  btnResta"
                                                    data-idproducto="{{ $index }}">-</a>
                                                {{-- <span class="estilovsta spanCantidad{{ $index }}">
                                        {{ $product->cantidad }}</span> --}}
                                                <input type="number" data-product="{{ $index }}"
                                                    class="inputCantidad spanCantidad{{ $index }}"
                                                    value="{{ $product->cantidad }}" min="1">
                                                <input type="hidden" name="amount_products" value="1">
                                                <a class="estilobtn btnSuma"
                                                    data-idproducto="{{ $index }}">+</a>

                                            </div>
                                        </div>
                                    </td>

                                </form>

                                <td>
                                    <div style="margin-bottom: 20%;">$ {{ $format }}</div>
                                    <a class="a-quitar" href="{{ Route('shoppingCar.clearProduct', $index) }}"> <i
                                            class="fas fa-trash"></i></a>
                                </td>

                            </tr>


                            <?php $totalP = $totalP + $subtotal; ?>
                        @endif
                    @endforeach

                </tbody>


            </table>

            <div style="display: flex; flex-direction: column;" class="totaldiv">
                <div class="cuadro">
                    <div style="margin: 4%;">
                        <h3 style=" font-size: 20px;" class="h1titulo"> {{ __('Reservation Summary') }}  </h3>
                    </div>
                    <div style="margin-bottom: 4%;">
                        <tr>
                            <td colspan="2"> {{ __('Total Products') }}  </td>
                            <td><?php $formattotalP = number_format($totalP); ?>${{ $formattotalP }}</td>
                        </tr>
                    </div>
                    <div>
                        <tr>
                            <td colspan="2"> {{ __('Total Services') }}  </td>
                            <td><?php $formattotalS = number_format($totalS); ?>${{ $formattotalS }}</td>
                        </tr>

                        <div style="border-bottom: 2px solid black; color: #333;"></div>
                    </div>
                    <div style="margin-top: 4%;">
                        <tr>
                            <td colspan="2">{{ __('Total Bookings') }} </td>
                            <td><?php $formattotal = $totalP + $totalS;

                            $formattotalF = number_format($formattotal); ?>${{ $formattotalF }}</td>
                        </tr>

                        <div>
                            <div>
                                @php
                                    $totalenviar = $formattotal * 100;
                                    function generarReferenciaPago()
                                    {
                                        $letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                                        $numeros = '0123456789';
                                        $referencia = '';

                                        // Generar tres letras aleatorias
                                        for ($i = 0; $i < 3; $i++) {
                                            $indice = rand(0, strlen($letras) - 1);
                                            $referencia .= $letras[$indice];
                                        }

                                        // Generar tres números aleatorios
                                        for ($i = 0; $i < 3; $i++) {
                                            $indice = rand(0, strlen($numeros) - 1);
                                            $referencia .= $numeros[$indice];
                                        }

                                        return $referencia;
                                    }

                                @endphp
                                <div>
                                    <div>
                                        <br>

                                        <?php if($totalS != 0){ ?>

                                        <form action="{{ Route('bookings.create', Auth::id()) }}" method="GET">
                                            <input type="hidden" name="totalproductos" value="{{ $totalP }}">
                                            <input type="hidden" name="totalservicios" value="{{ $totalS }}">
                                            <input type="hidden" name="total" value="{{ $formattotal }}">
                                            <input type="hidden" name="bookingcode"
                                                value="{{ generarReferenciaPago() }}">

                                            <button class="a-content"> {{ __('Reserve now') }} </button>
                                        </form>

                                        <?php }else{?>
                                        <div>
                                            <p class="alerta">  {{ __('You must add a service to finish the process') }} </p>
                                        </div>

                                        <?php }?>


                                        <br>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 50%;  margin-right: 20%; display: flex; flex-direction: column;">
                    <a id="addbuy" class="a-content" href="{{ url('/') }}"> {{ __('Keep buying') }} </a>
                    <a class="a-content" href="{{ Route('shoppingCar.delete') }}">  {{ __('Empty Cart') }}</a>
                </div>
    </main>
    @include('layouts.footer')
</body>

</html>

<script>
    $(document).on('keyup', '.inputCantidad', function() {
        let idProducto = $(this).attr('data-product');
        let cantidad = $(this).val();

        // Verificar si el valor contiene caracteres especiales
        let patron = /[!@#$%^&*(),.?":{}|<>]/;
        if (patron.test(cantidad)) {
            $(this).val(1);
            alert('Cantidad inválida');
            return;
        }

        if (cantidad != '') {
            if (cantidad > 0) {
                actualizar(idProducto, cantidad);
            } else {
                $(this).val(1);
                alert('Cantidad inválida');
            }
        }
    });


    $(document).on('click', '.btnSuma', function() {
        let idproducto = $(this).attr('data-idproducto');
        let cantidad = parseInt($(".spanCantidad" + idproducto).val(), 10);

        if (isNaN(cantidad) || cantidad === 0) {
            cantidad = 1;
        } else {
            cantidad++;
        }

        $(".spanCantidad" + idproducto).val(cantidad);
        console.log(cantidad);
        actualizar(idproducto, cantidad);
    });


    $(document).on('click', '.btnResta', function() {
        let idproducto = $(this).attr('data-idproducto');
        let cantidad = parseInt($(".spanCantidad" + idproducto).val(), 0);

        if (isNaN(cantidad) || cantidad === 0) {
            cantidad = 1;
        } else {
            cantidad--;
        }

        $(".spanCantidad" + idproducto).val(cantidad);
        actualizar(idproducto, cantidad);
        // location.reload(); //



    });

    $(document).on('click', '.btnSumaSA', function() {
        let iddetail_serviceA = $(this).attr('data-iddetail_serviceA');
        let cantidadA = parseInt($(".spanCantidadAdulto" + iddetail_serviceA).text(), 0);
        cantidadA++;
        $(".spanCantidadAdulto" + iddetail_serviceA).text(cantidadA);
        actualizarA(iddetail_serviceA, cantidadA);

        // location.reload(); //
    });

    $(document).on('click', '.btnRestaSA', function() {
        let iddetail_serviceA = $(this).attr('data-iddetail_serviceA');
        let cantidadA = parseInt($(".spanCantidadAdulto" + iddetail_serviceA).text(), 0);
        cantidadA--;
        if (cantidadA > 0) {
            $(".spanCantidadAdulto" + iddetail_serviceA).text(cantidadA);
            actualizarA(iddetail_serviceA, cantidadA);
            // location.reload(); //
        }

    });

    $(document).on('click', '.btnSumaSN', function() {
        let iddetail_serviceN = $(this).attr('data-iddetail_serviceN');
        let cantidadN = parseInt($(".spanCantidadNinos" + iddetail_serviceN).text(), 0);
        cantidadN++;
        $(".spanCantidadNinos" + iddetail_serviceN).text(cantidadN);
        console.log(cantidadN);
        actualizarN(iddetail_serviceN, cantidadN);
        // location.reload(); //
    });

    $(document).on('click', '.btnRestaSN', function() {
        let iddetail_serviceN = $(this).attr('data-iddetail_serviceN');
        let cantidadN = parseInt($(".spanCantidadNinos" + iddetail_serviceN).text(), 0);
        cantidadN--;
        if (cantidadN > 0) {
            $(".spanCantidadNinos" + iddetail_serviceN).text(cantidadN);
            actualizarN(iddetail_serviceN, cantidadN);
            // location.reload(); //
        }

    });





    const actualizar = (id, cantidad) => {
        $.ajax({
            url: '/shoppingCar/' + id + '/edit/' + cantidad, // la URL para la petición
            // url: '/shoppingCar/' + id + '/update/' + cantidad, // la URL para la petición
            type: 'GET', // especifica si será una petición POST o GET
            dataType: 'json', // el tipo de información que se espera de respuesta
            success: function(
                json
            ) { // código a ejecutar si la petición es satisfactoria; la respuesta es pasada como argumento a la función
                console.log('Correcto');
                location.reload(); //
            },
            error: function(xhr,
                status
            ) { // código a ejecutar si la petición falla; son pasados como argumentos a la función el objeto de la petición en crudo y código de estatus de la petición
                console.log('Disculpe, existió un problema');
            },
        });
    }

    const actualizarA = (id, cantidad) => {
        $.ajax({
            url: '/shoppingCar/' + id + '/editServicesA/' + cantidad, // la URL para la petición
            // url: '/shoppingCar/' + id + '/update/' + cantidad, // la URL para la petición

            type: 'GET', // especifica si será una petición POST o GET
            dataType: 'json', // el tipo de información que se espera de respuesta
            success: function(
                json
            ) { // código a ejecutar si la petición es satisfactoria; la respuesta es pasada como argumento a la función
                console.log('Correcto');
                location.reload(); //

            },
            error: function(xhr,
                status
            ) { // código a ejecutar si la petición falla; son pasados como argumentos a la función el objeto de la petición en crudo y código de estatus de la petición
                console.log('Disculpe, existió un problema');

            },
        });
    }


    const actualizarN = (id, cantidad) => {
        $.ajax({
            url: '/shoppingCar/' + id + '/editServicesN/' + cantidad, // la URL para la petición
            // url: '/shoppingCar/' + id + '/update/' + cantidad, // la URL para la petición
            type: 'GET', // especifica si será una petición POST o GET
            dataType: 'json', // el tipo de información que se espera de respuesta
            success: function(
                json
            ) { // código a ejecutar si la petición es satisfactoria; la respuesta es pasada como argumento a la función
                console.log('Correcto');
                location.reload(); //
            },
            error: function(xhr,
                status
            ) { // código a ejecutar si la petición falla; son pasados como argumentos a la función el objeto de la petición en crudo y código de estatus de la petición
                console.log('Disculpe, existió un problema');
            },
        });
    }

    @if (session('error'))
        {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'EXEDISTE LA CANTIDAD DE PERSONAS!',
                footer: 'Elige la cantidad dentro de nuestro rango'
            })
        }
    @endif

    @if (session('ok'))
        {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'RESERVACION REALIZADA CORRECTAMENTE'
            })
        }
    @endif
</script>
