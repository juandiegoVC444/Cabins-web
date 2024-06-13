<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('styles')
    <link rel="stylesheet" href="{{ asset('css/products/productsviews.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    @parent

</head>

<body class="cuerpo">
<header>
        @include('layouts.nav')
    </header>
    <main>

        <div class="cuadro">
            <h1>¡PRODUCTOS!</h1>
            <p>tenemos una amplia variedad de productos para todos los gustos y necesidades.
                Seguro que encontraras algo que te encante. los podras agregar en el momento de estar realizando la reserva
                ¿QUE ESPERAS?</p>
        </div>
        <div class="titulop">
            <h1 class="titulo">ELIGE Y COMPRA YA!</h1>
            <h2>Tenemos diferentes categorías para que tomes las que más se adapten a tu plan</h2>
        </div>


        <form class="buscador">
            <input class="input" id="Buscador" name="buscador" type="Search" placeholder="Buscar" aria-label="Search">
        </form>

        <div class="products">
            @foreach ($products as $P)

            <div class="thumbnail">
            <h1>{{ $P->name_product}}</h1>
                <a href="{{ route('products.showviews', $P->id) }}">
                    <img height="300px" src="{{ asset('storage/imgProducts').'/'.$P->picture}}" alt="" >
                </a>

                <?php $subtotal = $P->price;
                $format = number_format($subtotal) ?>
                <div style="display: flex; align-items: center; ">
                    <p>${{ $format}}/unidad</p>
                    <a style="text-decoration: none;" href="{{ route('products.showviews', $P->id) }}" class="botoncomprar"> {{ __('See More') }}</a>
                </div>
            </div>

            @endforeach
            <div id="no-results-message" class="hit-the-floor" style="display: none; font-size: 2rem; ">{{__('No results found')}}</div>

        </div>

    </main>
    @include('layouts.footer')
</body>

<!-- esto es para el buscador -->
<script>
    const buscador = document.getElementById("Buscador");
    const productos = document.querySelectorAll(".products .thumbnail");

    buscador.addEventListener("keyup", function(event) {
        const term = event.target.value.toLowerCase();

        productos.forEach(function(producto) {
            const title = producto.querySelector("h1").textContent.toLowerCase();

            if (title.includes(term)) {
                producto.style.display = "block";
            } else {
                producto.style.display = "none";
            }

            // esto es lo que muestra el mensaje de no se encontro resultados
            const noResultsMessage = document.getElementById("no-results-message");

            if (document.querySelectorAll(".products .thumbnail[style*='display: block']").length === 0) {
                noResultsMessage.style.display = "block";
            } else {
                noResultsMessage.style.display = "none";
            }

        });
    });

</script>
