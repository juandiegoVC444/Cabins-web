<?php $subtotal = $products->price;
    $format = number_format($subtotal); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('styles')
    <link rel="stylesheet" href="{{ asset('css/products/productsviews.css') }}">
    <link rel="stylesheet" href="{{ asset('css/products/showviews.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    @parent

</head>


    <body class="cuerpo">

    <header>
        @include('layouts.nav')
    </header>

        <main id="profile" class="profile">

            <hgroup class="section-title">
                <h2 style=" color: #ffa559;">{{ $products->name_product }}</h2>
                <br>
                <h3 class="h3-style"><i class="fas fa-dollar-sign"></i> {{ $format }}</h3>
                <br>
                <br>
                @if ($result)
                @else
                    <p2>Cantidad</p2>
                @endif
            </hgroup>

            @if ($result)
                <a href="{{ Route('shoppingCar.index') }}" type="button" class="color-button"><i
                        class="fas fa-shopping-cart btnv"> Ir al carrito </i></a>
            @else
                <div class="contenedores">
                    <form action="{{ Route('shoppingCar.create', $products->id) }}" method="GET">

                        <a class="estilobtn" id="restar">-</a>
                        <span class="estilovsta" id="numero">1</span>
                        <input type="hidden" name="amount_products" value="1" id="amount_products">
                        <a class="estilobtn" id="sumar">+</a>

                        <button type="submit" class="color-button"><i class="fas fa-shopping-cart"></i>
                            {{ __('Add') }}</button>
                    </form>
                </div>
            @endif

            <figure class="image-container">
                <img class="imagen" src="{{ asset('storage/imgProducts') . '/' . $products->picture }}" alt="" />
            </figure>

            <a href="{{ Route('products.productsviews') }}" type="submit" class="btnv"><i class="fas fa-undo-alt"></i>
                {{ __('Return') }}</a>

            <description>
                <br>
                <br>
                <p class="descripcion" id="text">{{ $products->decripcion }}</p>
            </description>

            <br>
            <br><br>
        </main>
        @include('layouts.footer')
    </body>

    <script>
        let result = '{{ $result }}';
        if (!result) {
            // Obtener elementos DOM
            const restarBtn = document.querySelector("#restar");
            const sumarBtn = document.querySelector("#sumar");
            const cantidadSpan = document.querySelector("#numero");
            const cantidadInput = document.querySelector("#amount_products");

            // Inicializar cantidad
            let cantidad = parseInt(cantidadSpan.innerText);

            // Función para actualizar cantidad
            const actualizarCantidad = (nuevaCantidad) => {
                cantidad = nuevaCantidad;
                cantidadSpan.innerText = cantidad;
                cantidadInput.value = cantidad;
            };

            // Manejar evento de clic en botón "restar"
            restarBtn.addEventListener("click", () => {
                if (cantidad > 1) {
                    actualizarCantidad(cantidad - 1);
                }
            });

            // Manejar evento de clic en botón "sumar"
            sumarBtn.addEventListener("click", () => {
                actualizarCantidad(cantidad + 1);
            });


            const text = document.getElementById("text");
            const chars = text.innerText.split("");
            let output = "";

            for (let i = 0; i < chars.length; i++) {
                output += chars[i];

                if ((i + 1) % 32 === 0) {
                    if (chars[i] === " ") {
                        output += "<br>";
                    } else if (chars[i + 1] === " ") {
                        output += "<br>";
                    } else {
                        output += "- <br>";
                    }

                }
            }

            text.innerHTML = output;
        }
    </script>
