
<link rel="stylesheet" href="{{ asset('css/nav.css') }}">


<nav>
    <div class="nav-logo">
        <img src="{{ asset('imagenes/logo.jpeg') }}" alt="Logo">
    </div>

    @if (auth()->user())
            <button id="shopin-car-btn" onclick="redirectShoppingCar()"><img
                    src="{{ asset('imagenes/carrito-de-compras.png') }}" alt="Cesta"></button>
            @endif

    <button id="burger-btn"><img src="{{ asset('imagenes/menu.png') }}" alt="Menú"></button>
    <div class="nav-cont">
        <div class="nav-links">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav center">
                    <li class="col-lg-1 col-md-1 col-sm-3 col-xs-12"><a href="{{ url('/') }}"><span>Inicio</span></a></li>
                    <li class="col-lg-1 col-md-1 col-sm-3 col-xs-12"><a href="{{ route('services.servicesviews') }}"><span>Servicios</span></a></li>
                    <li class="col-lg-1 col-md-1 col-sm-3 col-xs-12"><a href="{{ route('products.productsviews') }}"><span>Productos</span></a></li>
                    <li class="col-lg-1 col-md-1 col-sm-3 col-xs-12"><a href="{{ url('/contact') }}"><span>Contáctanos</span></a></li>
                </ul>
            </div>
        </div>
        @if(!auth()->user())
        <button id="register-btn" onclick="register()" >Registrarse</a></button>
        <button id="login-btn" onclick="login()" >Iniciar sesión</button>
        @else
        <button id="profile-btn" onclick="redirectUserInfo()" >Mi cuenta<img class="subM-arrow" src="{{ asset('imagenes/down-arrow.png') }}" alt=""></a></button>
        <button id="log-out-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out<img class="logout-icon" src="{{ asset('imagenes/logout.png') }}" alt="Logout"></button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @endif
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function redirectUserInfo(){
    window.location.href = "{{ url('user-info') }}";
}

function redirectShoppingCar(){
    window.location.href = "{{ url('shoppingCar') }}";
}

function register(){
    window.location.href = "{{ url('register') }}";
}

function login(){
    window.location.href = "{{ url('login') }}";
}

if (window.innerWidth < 992) {
        $('.nav-cont').hide();
    }
    $('#burger-btn').click(function() {
        $('.nav-cont').slideToggle();
    });
    $(window).resize(function() {
        if (window.innerWidth >= 992) {
        $('.nav-cont').show();
        } else {
        $('.nav-cont').hide();
        }
    });

    function handleWindowSize() {
    if (window.innerWidth < 993) {
        $('#log-out-btn').show();
        $('#profile-btn').mouseenter(function() {
            clearTimeout(timeout);
        });
    } else {
        $('#log-out-btn').hide();
        var timeout;
        $('#profile-btn').mouseenter(function() {
            $('#log-out-btn').fadeIn();
        });
        $('#profile-btn').mouseleave(function() {
            timeout = setTimeout(function() {
                $('#log-out-btn').fadeOut();
            }, 500);
        });
        $('#log-out-btn').mouseenter(function() {
            clearTimeout(timeout);
        });
        $('#log-out-btn').mouseleave(function() {
            $('#log-out-btn').fadeOut();
        });
    }
}

    // Handle initial window size
    handleWindowSize();

    // Handle window resize
    $(window).resize(function() {
        handleWindowSize();
    });

    $('.subM-arrow').click(function(event) {
        event.stopPropagation();
        $('#log-out-btn').fadeIn();
    });


</script>
