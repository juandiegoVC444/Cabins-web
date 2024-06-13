@extends('adminlte::page')

@section('title', 'Actualizar Servicio')

@section('content_header')
    <h1>{{ __('Update service') }}</h1>
@stop

@section('content')

<div class="container">
    <form class="confirmar" action="{{Route('services.update', $services->id)}}" method="POST">
     @csrf
     @method('PUT')
        <div class="mb-3">
            <label class="form-label">{{ __('TITTLE') }}</label>
            <input type="text" name="tittle" maxlength="20" value="{{$services->tittle}}" class="form-control" placeholder="Titlle">
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('DESCRIPTION') }}</label>
            <input type="text" name="description" maxlength="255"  value="{{$services->description}}"  class="form-control" placeholder="Description">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('MAX INDIVIDUALS') }}</label>
            <input type="number" name="max_individuals" min=0 max=100  value="{{$services->max_individuals}}"  class="form-control" placeholder="Max_individuals">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('RULES') }}</label>
            <input type="text" name="rules"  value="{{$services->rules}}"  class="form-control" placeholder="Rules">
        </div>


        <button type="submit"  class="btn btn-success rounded-pill"><i class="fas fa-edit"></i> {{__('Update')}}</button>
        <a href="{{Route('services.index')}}" type="submit" class="btn btn-primary rounded-pill"><i class="fas fa-undo-alt"></i> {{ __('Return') }}</a>

    </form>

</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    @if(session('error')) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Imagen No Valida!',
            footer: 'Elige una imagen de tipo png,jpg,jpeg o gif'
        })
    }
    @endif



    $('.confirmar').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Desea Actualizar El Servicio?',
            showDenyButton: true,
            confirmButtonText: 'Actualizar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            } else if (result.isDenied) {
                Swal.fire('No Se Actualizo El Servicio', '', 'info')
            }
        })
    })

    var input = document.getElementById('numero');
    input.addEventListener('input', function() {
        if (this.value.length > 12)
            this.value = this.value.slice(0, 12);
    })
</script>
@stop
