<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('css/footer.css') }}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

<footer class="bg-img">
    <a class="whatsapp-float" target="_blank" onclick="confirmarEnvio();"><i class="fa fa-whatsapp my-float"></i></a>
    <div class="footer-col col-lg-1 col-md-1 col-sm-6 col-xs-12">
        <img id="logo-ft" src="{{ asset('imagenes/logo.jpeg') }}" alt="Logo">
        <div class="logo-col">
            <div class="social-icons">
                <a href="https://www.facebook.com/laarboledafincaturistica/" target="_blank"><img src="{{ asset('imagenes/facebook.png') }}" alt="logo FB"></a>
                <a href="https://goo.gl/maps/REWgbJjuBPJSGWV57" target="_blank"><img src="{{ asset('imagenes/pin.png') }}" alt="logo TW"></a>
                <a href="https://www.instagram.com/fincalaarboleda.co/?igshid=MzRlODBiNWFlZA%3D%3D" target="_blank"><img src="{{ asset('imagenes/instagram.png') }}" alt="Logo IG"></a>
            </div>
        </div>
    </div>
    <div class="footer-col col-lg-1-5 col-md-1 col-sm-6 col-xs-12">
        <h3>¿Por qué elegirnos?</h3>
        <br>
        <p>Hermosas instalaciones</p>
        <br>
        <p>La mejor experiencia</p>
        <br>
        <p>Excelente servico</p>
    </div>
    <div class="footer-col col-lg-1-5 col-md-1 col-sm-6 col-xs-12">
        <h3>Contactos</h3>
        <p class="font-email">Correo: laarboledafincacalarca@gmail.com</p>
        <br>
        <p>Teléfono: +57 7383738</p>
        <br>
        <p>Celular: 312 526 77 26</p>
    </div>
    <div class="footer-col col-lg-1-5 col-md-1 col-sm-6 col-xs-12">
        <h3>Danos tu opinión</h3>

        <button class="contactButton" onclick="redirectToCreate()"> PQRS</button>
    </div>
    <div class="footer_copyright">
        <div class="copy">©2023 Todos los derechos reservados</div>
        <div class="copy">Diseñado por ADSI - 205 SENA</div>
        <div class="copy">Terminos y Condiciones</div>
    </div>
</footer>
<div class="bg-ft"></div>


<script>

function redirectToCreate(){
    window.location.href = "{{ Route('pqrs.create') }}";
}

</script>

<script>
    function confirmarEnvio() {
                var phoneNumber = '+573147723048';
                var message = 'Hola, quiero pedir información sobre su finca turística 😊';
                var userAgent = navigator.userAgent || navigator.vendor || window.opera;

                // Verificar si el agente de usuario indica que es un dispositivo móvil
                if (/android|iPad|iPhone|iPod/.test(userAgent)) {
                    // Redirigir a la aplicación de WhatsApp en dispositivos móviles
                    window.location.href = 'whatsapp://send?phone=' + phoneNumber + '&text=' + encodeURIComponent(message);
                } else {
                    // Redirigir a WhatsApp Web en PC
                    window.open('https://web.whatsapp.com/send?phone=' + phoneNumber + '&text=' + encodeURIComponent(message), '_blank');
                }
            }
</script>
