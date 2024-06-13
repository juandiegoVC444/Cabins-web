@extends('adminlte::page')

@section('title', 'editImg')

@section('content_header')
<h1>Cambiar Imagen</h1>
@stop

@section('content')

<tbody>

    <form class="confirmar" action="{{ Route('services.updateImg', ['id' => $services->id,'im'=>$resources->id,'de'=>$detail_services ->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="text" name="pictureOld" value="{{ $resources->url }}" accept="image/*" multiple="false" class="form-control" hidden>
        </div>


        <div class="mb-3">
            <label>{{ __('Picture') }}</label>
            <br>

            <label class="form-label">{{ __('Update Picture') }}</label>
            <input type="file" name="picture" accept="image/*" multiple="false" class="form-control" readonly>
        </div>

        <br>
        <input type="submit" value="Enviar Formulario" class="btn btn-success" />
        <a href="{{ Route('services.detailEdit',['id' => $services->id, 'de' => $detail_services->id]) }}" type="submit" class="btn btn-danger">{{ __('Cancel') }}</a>

    </form>
</tbody>

@stop
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    @if(session('not')) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Formato No Valido',
            footer: 'Intenta Ingresar Una Imagen'
        })
    }
    @endif


    $('.confirmar').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Desea Actualizar la imagen?',
            showDenyButton: true,
            confirmButtonText: 'Actualizar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            } else if (result.isDenied) {
                Swal.fire('No Se Actualizó la imagen', '', 'info')
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
    @if(session('not')) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Formato No Valido',
            footer: 'Intenta Ingresar Una Imagen'
        })
    }
    @endif
</script>






@stop
