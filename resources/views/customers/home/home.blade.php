<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Home page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header>
        @include('layouts.nav')
    </header>
    <div class="container-body">
        <div class="container-img">
            <div class="texto">
                <h1> <strong> ¿BUSCAS UN LUGAR<br>PARA DESCONECTAR<br>DEL ESTRES DIARIO?</strong></h1>
                <p>Vive una experiencia unica,disfruta de la naturaleza en su maximo explendor y descubre un oasis de
                    tranquilidad en nuestra finca, no esperes mas ,!Te sorprenderas¡</p>
            </div>
            <div class="imagen">
                <img src="{{ asset('imagenes/fincalaarboleda1.jpg') }}" alt="">
            </div>
        </div>

        <div class="ancho-div">
            <div class="cont-map">
                <img src="{{ asset('imagenes/maps-and-flags.png') }}" alt="">
                <h3>Ubicanos</h3>
                <button onclick="window.open('https://www.google.com/maps/place/Finca+turística+la+Arboleda/@4.3139151,-75.7512588,10z/data=!4m6!3m5!1s0x8e38f727bf3fda87:0xab83da2b03563d2a!8m2!3d4.4684012!4d-75.6817403!16s%2Fg%2F11py1js26s','_blank')"><strong>Abrir Mapa</strong></button>
            </div>
            <div class="cont-app">
                <img src="{{ asset('imagenes/mobile-app.png') }}" alt="">
                <h3>Descarga nuestra app</h3>
                <button onclick=""><strong>Descargar APK</strong></a></button>
            </div>
        </div>

        <div class="separ"></div>
        <section class="container-about">

            <div class="subtitle">
                <h2 style="margin-top: 0;">Como trabajamos</h2>
                <p>Hospédate en nuestras cabañas y despiértate con el cantar de los pájaros</p>
            </div>
            <div class="about__main">
                <article class="about__icons three-section1">
                    <img src="imagenes/localizacion.png" class="about__icon">
                    <h3 class="about__title"><strong>Alejate del estres </strong></h3>
                    <p class="about__paragrah">Nuestra ubicación fuera de la zona urbana es el lugar perfecto para ser uno con las naturaleza.</p>
                </article>

                <article class="about__icons three-section2">
                    <img src="imagenes/portafolio.png" class="about__icon">
                    <h3 class="about__title"><strong>Destino del placer </strong></h3>
                    <p class="about__paragraph">Aquí no tendrás que preocuparte por tu trabajo ni nada más que de disfrutar.</p>
                </article>


                <article class="about__icons three-section3">
                    <img src="imagenes/automovil.png" class="about__icon">
                    <h3 class="about__title"><strong>Así de fácil es llegar</strong></h3>
                    <p class="about__paragrah">Ya sea desde Armenia o tomando la ruta por Calarcá.
                        Son solo 20 minutos los que te separan del placer.</p>
                </article>
            </div>
        </section>
        <div class="contenido-con" style="text-align:center;">
            <div class="container-con">
                <h2> Conoce este maravilloso lugar</h2>
                <p>Accede a diferentes planes según loque desees con diversos <br> productos, agéndate ya!!</p>
                <div class="square">
                    <div class="acordeon">
                        <div style="background-image: url('imagenes/fincalaarboleda2.jpg');"></div>
                        <div style="background-image: url('imagenes/fincalaarboleda11.jpg');"></div>
                        <div style="background-image: url('imagenes/fincalaarboleda8.jpg');"></div>
                        <div style="background-image: url('imagenes/fincalaarboleda7.jpg');"></div>
                        <div style="background-image: url('imagenes/fincalaarboleda6.jpg');"></div>
                    </div>
                    <div class="carrousel">
                        <div class="slideshow-container">

                            <div class="mySlides fade">
                                <img src="imagenes/fincalaarboleda2.jpg" alt="Imagen 1">
                            </div>

                            <div class="mySlides fade">
                                <img src="imagenes/fincalaarboleda11.jpg" alt="Imagen 2">
                            </div>

                            <div class="mySlides fade">
                                <img src="imagenes/fincalaarboleda8.jpg" alt="Imagen 3">
                            </div>

                            <div class="mySlides fade">
                                <img src="imagenes/fincalaarboleda7.jpg" alt="Imagen 4">
                            </div>

                            <div class="mySlides fade">
                                <img src="imagenes/fincalaarboleda6.jpg" alt="Imagen 5">
                            </div>

                            <a class="prev" onclick="plusSlides(-1)">❮</a>
                            <a class="next" onclick="plusSlides(1)">❯</a>

                        </div>

                        <div class="dots">
                            <span class="dot" onclick="currentSlide(1)"></span>
                            <span class="dot" onclick="currentSlide(2)"></span>
                            <span class="dot" onclick="currentSlide(3)"></span>
                            <span class="dot" onclick="currentSlide(4)"></span>
                            <span class="dot" onclick="currentSlide(5)"></span>
                        </div>

                    </div>
                </div>
            </div>
            <div class="container-qn">
                <div class="titulo-quien">
                    <h2>¿Quienes Somos?</h2>
                    <p>Expertos en brindar buenas experiencias y magnificos recuerdos <br> Ven y recárgate de la buena vibra en la Finca La Arboleda.</p>
                </div>
                <div class="izquierdo-div">
                    <div class="izquierdo-div-inner">
                        <img src="imagenes/fincalaarboleda5.jpg" alt="Imagen 4">
                    </div>
                </div>
                <div class="derecho-divs">
                    <div class="derecho-div">
                        <img src="imagenes/logo123.jpeg" alt="Imagen 1">
                        <div class="derecho-h1-p">
                            <div class="container-h2">
                                <h3> <strong>¡Descubre un paraíso en nuestra finca turística <br> y reserva tu escape perfecto hoy mismo!</strong> </h3>
                            </div>
                        </div>
                    </div>
                    <div class="derecho-div">
                        <img src="imagenes/fincalaarboleda12.jpg" alt="Imagen 2">
                        <div class="derecho-h1-p">
                            <div class="container-h2">
                                <h3> <strong>¿Que esperas?, relajate y diviertete en nuestra <br> finca turística y crea recuerdos inolvidables.</strong> </h3>
                            </div>
                        </div>
                    </div>
                    <div class="derecho-div">
                        <img src="imagenes/fincalaarboleda13.jpg" alt="Imagen 3">
                        <div class="derecho-h1-p">
                            <div class="container-h2">
                                <h3> <strong>Reserva ya y disfruta, donde cada detalle está <br> pensado para ofrecerte una experiencia única.</strong> </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contenedor-exp">
                <div class="uno">
                    <h2>Experiencias!</h2>
                </div>
                <div class="dos">
                    <img src="imagenes/fincalaarboleda10.jpg" alt="">
                </div>
                <div class="tres">
                    <img src="imagenes/fincalaarboleda3.jpg" alt="">
                </div>
            </div>
        </div>

        @include('layouts.footer')
</body>

</html>

<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("mySlides");
      let dots = document.getElementsByClassName("dot");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active";
    }
</script>
