<head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Servicios</title>

        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="{{ asset('css/services/detalles.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/services/carrousels.css') }}" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>

    <body>
        <header>
            @include('layouts.nav')
        </header>
        <div id="max" data-nombre="@php echo($services->max_individuals) @endphp"></div>
        <!-- DEGRADADO -->
        <div class="degradado">
            <!--CUADRO CENTRADO-->
            <div class="cuadro-centrado">
                <p>Detalles de {{ $services->tittle }}</p>
            </div>
        </div>



        <!--Texto de CANCHA-->
        @foreach ($details as $detail)
            <div class="element">
                <div class="texto-left">
                    <div id="titulo-left">
                        <h2>{{ $detail->tittle }}</h2>
                    </div>
                    <div id="text-left">
                        <p>{{ $detail->description }}</p>
                    </div>
                    <!--Boton-->
                    <div class="boton-modal">

                        <label for="btn-modal"
                            onclick="openModal('{{ $detail->tittle }}','{{ $detail->id }}')">RESERVAR AHORA </label>
                    </div>
                </div>

                <div class="carousel-container">
                    <div class="carousel">
                        @foreach ($detail->resource as $re)
                            <div class="slide">
                                <img src="{{ asset('storage/imgServices') . '/' . $re->url }}" alt="">
                            </div>
                        @endforeach
                    </div>
                    <button class="prev-button">&#10094;</button>
                    <button class="next-button">&#10095;</button>
                </div>


                </section>

            </div>
            <div class="orange-separator"></div>
        @endforeach

        <!--VENTANA MODAL-->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            var capture1;
            var capture2;
            $(function() {
                var today = new Date();
                var minDate = new Date(today.getTime() + (15 * 24 * 60 * 60 * 1000));

                var $datepicker1 = $("#datepicker");
                var $datepicker2 = $("#datepicker2");

                $datepicker1.datepicker({
                    appendTo: "#fecha-container1",
                    minDate: minDate,
                    dateFormat: "dd/mm/yy",
                    onSelect: function(selectedDate) {
                        var selected = $datepicker1.datepicker("getDate");
                        capture1 = selected;
                        selected.setDate(selected.getDate());
                        $datepicker2.datepicker("option", "minDate", selected);

                        if (selectedDate) {
                            $datepicker2.prop("disabled", false).removeClass("oculto");
                        } else {
                            $datepicker2.prop("disabled", true).addClass("oculto");
                        }
                    }

                    // beforeShowDay: function(date) {
                    //     var day = date.getDay();
                    //     return [(day != 0 && day != 6), ''];
                    // }
                });
                $datepicker2.datepicker({
                    appendTo: "#fecha-container2",
                    minDate: minDate,
                    dateFormat: "dd/mm/yy",
                    beforeShow: function(input, inst) {
                        return !$(input).is(":disabled");
                    }
                });



                var aceptButton = document.getElementById("aceptButton");
                aceptButton.addEventListener("click", function() {
                    let vadultos = Adultos.value;
                    let vninos = Ninos.value;


                    var inicio = $datepicker1.datepicker("getDate");
                    var final = $datepicker2.datepicker("getDate");

                    if (vadultos == '' || vninos == '') {
                        alert("Por favor ingrese una cantidad de Adultos y niños");
                    } else {
                        if (inicio === null || final === null) {
                            alert("Por favor seleccione una fecha de inicio y una fecha final");
                        } else {
                            var msPerDay = 24 * 60 * 60 * 1000;
                            var daysDiff = Math.round((final - inicio) / msPerDay);

                            if (daysDiff > 30) {
                                alert("El rango de fechas seleccionado excede los 30 días permitidos");
                            } else {
                                var inicio_resolve = $.datepicker.formatDate("dd-mm-yy", inicio);
                                var final_resolve = $.datepicker.formatDate("dd-mm-yy", final);
                                enviarcarrito(id_service, vninos, vadultos, inicio_resolve, final_resolve);
                            }
                        }
                    }
                });

                var cancelButton = document.getElementById("cancelButton");
                cancelButton.addEventListener("click", function() {
                    document.getElementById("datepicker").value = "";
                    document.getElementById("datepicker2").value = "";
                    document.getElementById("adultos").value = 1;
                    document.getElementById("niños").value = 0;
                    $datepicker2.prop("disabled", true).addClass("oculto");
                    closeModal();
                });

            })
        </script>
        <input type="checkbox" id="btn-modal">
        <div class="container-modal">
            <div class="content-modal">

                <h2></h2>

                <div class="contenedor-detalles">
                    <div class="cant_personas">
                        <p>Cantidad de personas:</p>

                        <div class="adultos">
                            <label for="adultos">Adultos:</label>
                            <input type="number" id="adultos" min="1" max="30"  class="input_personas">
                        </div>

                        <div class="ninos">
                            <label for="niños">Niños:</label>
                            <input type="number" id="niños" min="0" max="30" style="text-align: center;" class="input_personas">
                        </div>
                    </div>
                    <div class="fecha">
                        <div class="fecha-inicio" id="fecha-container1">
                            <form>
                                <label for="datepicker">Fecha Inicio:</label>
                                <input type="text" id="datepicker" name="fecha" readonly class="input_fecha">
                            </form>
                        </div>

                        <div class="fecha-fin" id="fecha-container2">
                            <form>
                                <label for="datepicker2">Fecha Fin:</label>
                                <input type="text" id="datepicker2" name="fecha" readonly class="oculto"
                                    style=" padding: 8px;
                                width: 100px;
                                border: 1px solid #ccc;
                                border-radius: 4px;">
                            </form>
                        </div>
                    </div>

                </div>
                <div class="table-body">
                    <table>



                        <tr>
                            <th>Temporada</th>
                            <th>Fechas</th>
                            <th>Precio</th>
                        </tr>
                        @foreach ($seasons as $season)
                            @php
                                $fecha_convertida_inicio = date('d/m/y', strtotime($season->initial_date));
                                $fecha_convertida_final = date('d/m/y', strtotime($season->final_date));
                            @endphp
                            <tr>
                                <td>{{ $season->tittle }}</td>
                                <td>{{ $fecha_convertida_inicio }} hasta {{ $fecha_convertida_final }}</td>
                                <td>{{ $season->price }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="botons">
                    <button class="cancel-button" id="cancelButton">Cancelar</button>
                    <button class="acept-button" id="aceptButton">Aceptar</button>
                </div>

            </div>

        </div>

    </body>
    @include('layouts.footer')

    </html>


    <script>
        var containerModal;
        //Captura id de detalle servicio y temporadas
        let id_service;
        let capture_season;
        //Validacion cantidad de Adultos
        //Validacion cantidad de Niños
        var minValueA = 1;
        var maxValue = document.getElementById("max").dataset.nombre;
        var minValueN = 0;

        var Adultos = document.getElementById("adultos");
        var Ninos = document.getElementById("niños");

        Adultos.value = 1;
        Ninos.value = 0;

        Adultos.addEventListener("input", validarSuma);
        Ninos.addEventListener("input", validarSuma);

        //Variables de fecha
        var fecha_inicio;
        var fecha_final;

        var openModal = function(tittle, id) {
            containerModal = document.querySelector(".container-modal");
            containerModal.style.display = "block";
            containerModal.style.display = "flex";
            id_service = id;
            TittleModal(tittle);
        };

        var closeModal = function() {
            var containerModal = document.querySelector(".container-modal");
            containerModal.style.display = "none";
            var btnModal = document.getElementById("btn-modal");
            btnModal.checked = false;
        };

        // var cancelButton = document.getElementById("cancelButton");
        // cancelButton.addEventListener("click", function() {
        //     document.getElementById("datepicker").value = "";
        //     document.getElementById("datepicker2").value = "";
        //     document.getElementById("adultos").value = 1;
        //     document.getElementById("niños").value = 0;
        //     closeModal();
        // });

        function validarSuma() {
            var valor1 = parseInt(Adultos.value) || 0; // Obtener el valor del campo 1
            var valor2 = parseInt(Ninos.value) || 0; // Obtener el valor del campo 2

            var suma = valor1 + valor2;

            if (suma > maxValue) {
                if (this === Adultos) {
                    Ninos.value = 0; // Ajustar el valor del campo 2
                } else {
                    Adultos.value = 1; // Ajustar el valor del campo 1
                }
            }
        }

        function validarEntero() {
            this.value = Math.floor(this.value); // Redondear hacia abajo al número entero más cercano
        }

        document.getElementById("adultos").addEventListener("input", function() {
            var input = parseInt(this.value); // Obtener el valor como número entero

            // Verificar si el valor supera el máximo o es menor que el mínimo
            if (input > maxValue) {
                this.value = maxValue; // Establecer el valor máximo
            } else if (input < minValueA) {
                this.value = minValueA; // Establecer el valor mínimo
            }
        });

        document.getElementById("niños").addEventListener("input", function() {

            var input = parseInt(this.value); // Obtener el valor como número entero

            // Verificar si el valor supera el máximo o es menor que el mínimo
            if (input > maxValue) {
                this.value = maxValue; // Establecer el valor máximo
            } else if (input < minValueN) {
                this.value = minValueN; // Establecer el valor mínimo
            }
        });



        var enviarcarrito = function(id, Ninos, Adultos, fecha_inicio, fecha_final) {
            var url =
                "{{ route('shoppingCar.createservice', [':id', ':ninos', ':adultos', ':fecha_inicio', ':fecha_final']) }}";
            url = url.replace(':id', id);
            url = url.replace(':ninos', Ninos);
            url = url.replace(':adultos', Adultos);
            url = url.replace(':fecha_inicio', fecha_inicio);
            url = url.replace(':fecha_final', fecha_final);
            window.location.href = url;
        }

        var btnModal = document.getElementById("btn-modal");
        btnModal.addEventListener("change", function() {
            if (this.checked) {} else {
                closeModal();
            }
        });

        var TittleModal = function(tittle) {
            if (containerModal) {
                var modalTitle = containerModal.querySelector("h2");
                modalTitle.innerText = tittle;
            } else {
                console.error("containerModal no está definido");
            }
        };
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carouselContainers = document.querySelectorAll('.carousel-container');

            carouselContainers.forEach(function(carouselContainer) {
                const carousel = carouselContainer.querySelector('.carousel');
                const prevButton = carouselContainer.querySelector('.prev-button');
                const nextButton = carouselContainer.querySelector('.next-button');

                let slideIndex = 0;
                let intervalId;

                function showSlide(index) {
                    carousel.style.transform = `translateX(-${index * 100}%)`;
                }

                function nextSlide() {
                    if (slideIndex < carousel.children.length - 1) {
                        slideIndex++;
                    } else {
                        slideIndex = 0;
                    }
                    showSlide(slideIndex);
                }

                function prevSlide() {
                    if (slideIndex > 0) {
                        slideIndex--;
                    } else {
                        slideIndex = carousel.children.length - 1;
                    }
                    showSlide(slideIndex);
                }

                function startAutoSlide() {
                    intervalId = setInterval(nextSlide,
                    3000); // Cambia el slide cada 3 segundos (3000 milisegundos)
                }

                function stopAutoSlide() {
                    clearInterval(intervalId);
                }

                nextButton.addEventListener('click', function() {
                    stopAutoSlide();
                    nextSlide();
                    startAutoSlide();
                });

                prevButton.addEventListener('click', function() {
                    stopAutoSlide();
                    prevSlide();
                    startAutoSlide();
                });

                startAutoSlide();
            });
        });

        @if (session('error'))
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error al agregar al carrito',
                    footer: '(Temporadas) Contacte al administrador para mas informacion'
                })
            }
        @endif
    </script>
