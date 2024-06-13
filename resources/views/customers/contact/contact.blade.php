<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Contactanos</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
</head>

<body>
    <header>
        @include('layouts.nav')
    </header>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center">
                <h1 align="center">CONTACTA CON NOSOTROS</h1>
                <div class="linea-blanca"></div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="dos">
                        <i class=""></i>
                        <div class="d-flex flex-column">
                            <p class="font-weight-bold"> Contáctanos y permítenos brindarte toda la información que necesitas para hacer realidad tu próxima escapada a nuestra finca turística. </p>
                        </div>
                    </div>
                    <div class="uno">
                        <i class="bi bi-envelope"></i>
                        <div class="d-flex flex-column correo">
                            <h5 class="font-weight-bold">Correo Administrativo:</h5>
                            <a href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to=laarboledafincacalarca@gmail.com" target="_blank"><p class="m-0">laarboledafincacalarca@gmail.com</p></a>
                        </div>
                    </div>
                    <div class="uno">
                        <i class="bi bi-telephone"></i>
                        <div class="d-flex flex-column">
                            <h5 class="font-weight-bold">Teléfono:</h5>
                            <p class="m-0"><a class="telefono">305-8605546</a></p>
                        </div>
                    </div>
                    <div class="">
                        <i class="bi bi-geo-alt"></i>
                        <div class="d-flex flex-column">
                            <div class="uno">
                                <h5 class="font-weight-bold">Sede principal y Oficina:</h5>
                                <p>Calle 43 #41-15 Br/ Valle del Lili</p>
                            </div>
                            <div class="ubic">
                                <p class="m-0"> <strong> UBICACION FINCA:</strong> </p>
                                <div class="mapa">
                                        <iframe class="map_frame"
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3977.6910492765855!2d-75.68431522610845!3d4.468406543629789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e38f727bf3fda87%3A0xab83da2b03563d2a!2sFinca%20tur%C3%ADstica%20la%20Arboleda!5e0!3m2!1ses!2sco!4v1681500080233!5m2!1ses!2sco"
                                        style="border: 0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>

</html>
