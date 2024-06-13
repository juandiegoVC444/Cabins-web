@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('Create season') }}</h1>
@stop

@section('content')
<div class="container">
    <form class="confirmar" action="{{Route('seasons.store' )}}" method="POST" enctype="multipart/form-data">
     @csrf
        <div class="mb-3">
            <label class="form-label">{{ __('TITTLE') }}</label>
            <select type="form-select" name="tittle" maxlength="255" class="form-control" placeholder="Titulo" required>
            <option selected >Seleccione una Opcion</option>
                <option value="Precio Normal">Precio Normal</option>
                <option value="Temporada baja">Temporada Baja</option>
                <option value="Temporada media">Temporada Media</option>
                <option value="Temporada alta">Temporada Alta</option>
            </select>
        </div>
        
        <div class="mb-3">
        
            <label class="form-label">{{ __('SERVICE') }}</label>
            <select type="form-select" name="tittleServi" maxlength="255" class="form-control" placeholder="Titulo" required>
            <option selected >Seleccione una Opcion</option>
            @foreach($servi as $service)            
            <option value="{{$service->id}}">{{$service->tittle}} </option>
            @endforeach 
            </select>
        
        </div>
        
    
        <div class="mb-3">
            <label class="form-label">{{ __('DESCRIPTION') }}</label>
            <input type="text"  name="description" maxlength="255"  class="form-control" placeholder="Descripcion" required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('INITIAL DATE') }}</label>
            <input type="date"  name="initial_date" maxlength="255"  class="form-control" placeholder="Fecha Inicial" required>
       
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('FINAL DATE') }}</label>
            <input type="date"  name="final_date" maxlength="255"  class="form-control" placeholder="Fecha Final" required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('PRICE') }}</label>
            <input type="number"  name="price" maxlength="255"  class="form-control" placeholder="Precio" required>
        </div>

        <br>
        <br>

        <a href="{{Route('seasons.index')}}" type="submit" class="btn btn-primary rounded-pill"><i class="fas fa-undo-alt"></i> {{ __('Return') }} </a>

        <button type="submit"  class="btn btn-success rounded-pill"><i class="fas fa-plus-square"> </i> {{ __('Create') }} </button>

    </form>

</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>

        
    <script>
       $('.confirmar').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Desea Crear La Temporada?',
            showDenyButton: true,
            confirmButtonText: 'Crear',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            } else if (result.isDenied) {
                Swal.fire('No Se Creo La Temporada', '', 'info')
            }
        })
    })
    </script>

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: '{{ $errors->first('message') }}'
            });
        </script>
    @endif


    <script>
        // Mostrar mensaje de éxito si existe
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ session("success") }}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>



@stop
