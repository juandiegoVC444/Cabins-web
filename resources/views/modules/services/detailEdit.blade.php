@extends('adminlte::page')

@section('title', 'Actualizar Detalle Servicio')

@section('content_header')
    <h1>{{ __('Update detail service') }}</h1>
@stop
@section('content')
    <div class="container">

        <form class="confirmar1"
            action="{{ Route('services.detailUpdate', ['id' => $services->id, 'de' => $detail_services->id]) }}" method="GET">
            <!--Aqui va el POST-->

            <div class="mb-3">
                <label class="form-label">{{ __('TITTLE') }}</label>
                <input type="text" name="tittle" maxlength="255" value="{{ $detail_services->tittle }}" class="form-control"
                    placeholder="Titlle">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('DESCRIPTION') }}</label>
                <input type="text" name="description" maxlength="255" value="{{ $detail_services->description }}"
                    class="form-control" placeholder="Description">
            </div>
            <div class="card-header">
                <table id='tableServices' class="table">
                    <thead>
                        <tr>

                            <th scope="col">{{ __('PICTURE') }}</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detail_services->resource as $re)
                            <tr>
                                <td>
                                    <div class="mb-3">
                                        <img class="img-thumbnail" width="350"
                                            src="{{ asset('storage/imgServices') . '/' . $re->url }}">
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="row">
                                        <a class="btn btn-success rounded-pill"
                                            href="{{ route('services.editImg', ['id' => $services->id, 'im' => $re->id, 'de' => $detail_services->id]) }}">
                                            <i class="fas fa-edit"></i> {{ __('Change') }}
                                        </a>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="row">
                                        <?php
                                        if ($re->state_record == 'ACTIVAR') {
                                        ?>
                                            <a href="{{ Route('services.disableImg',$re->id) }}" type="submit" onclick="desactivar(event)"
                                                class="btn btn-danger rounded-pill"><i class="fas fa-lock"></i> {{ __('Disable') }}</a>


                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($re->state_record == 'DESACTIVAR') {
                                        ?>
                                            <a href="{{ Route('services.activeImg',$re->id) }}" type="submit" onclick="activar(event)"
                                                class="btn btn-warning text-white rounded-pill"><i class="fas fa-lock-open"></i> {{ __('Active') }}</a>

                                        <?php
                                        }
                                        ?>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success rounded-pill"><i class="fas fa-edit"> </i>{{ __('Update') }}
                </button>

                <a href="{{ Route('services.oldImg', ['id' => $services->id, 'de' => $detail_services->id]) }}" type="submit"
                    class="btn btn-primary rounded-pill"><i class="fas fa-undo-alt"></i> {{ __('Return') }}</a>

        </form>

    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        @if (session('error'))
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Imagen No Valida!',
                    footer: 'Elige una imagen de tipo png,jpg,jpeg o gif'
                })
            }
        @endif



        $('.confirmar1').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Desea Actualizar El Detalle del Servicio?',
                showDenyButton: true,
                confirmButtonText: 'Actualizar',
                denyButtonText: `Cancelar`,
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                } else if (result.isDenied) {
                    Swal.fire('No Se Actualizo El Detalle del Servicio', '', 'info')
                }
            })
        })


        var input = document.getElementById('numero');
        input.addEventListener('input', function() {
            if (this.value.length > 12)
                this.value = this.value.slice(0, 12);
        })
    </script>
    <script>
        @if (session('ok') == 'ok')
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Detalle del servicio Creado Satisfactoriamente',
                showConfirmButton: false,
                timer: 2500
            })
        @endif


        @if (session('update'))
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Imagen Actualizada correctamente ',
                showConfirmButton: false,
                timer: 2500
            })
        @endif

        function desactivar(event){
            e.preventDefault();


            Swal.fire({
                title: 'Desea Activar la imagen del Detalle del Servicio?',
                text: "La Imagen del Detalle del Servicio se cambiara al estado activo, por lo tanto se mostrará en la pagina principal",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Activar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }

            })

        });

        function desactivar(event) {
    event.preventDefault(); // Prevenir comportamiento predeterminado del enlace

    Swal.fire({
        title: 'Desea Desactivar la Imagen del Detalle del Servicio?',
        text: "La Imagen del Detalle del Servicio cambiará al estado inactivo, por lo tanto NO se mostrará en la página principal",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Desactivar',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.href; // Navegar a la URL del enlace
        }
    });
}
    </script>
@stop
