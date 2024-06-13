@extends('adminlte::page')

@section('title', 'editImg')

@section('content_header')
    <h1>{{ __('Add image for detail')}} {{$detail_services->tittle}}</h1>
@stop
@section('content')

    <tbody>

        <form action="{{ Route('services.storeImage', ['id' => $services->id, 'de' => $detail_services->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>{{ __('Picture') }}</label>
                <br>

                <label class="form-label">{{ __('Add image') }}</label>
                <input type="file" name="picture" accept="image/*" multiple="false" class="form-control" readonly required>
                </div>


            <br>
            <input type="submit" value="Enviar Formulario" class="btn btn-success" />
            <a href="{{ Route('services.showDetails',$services->id) }}" type="submit" class="btn btn-danger">{{ __('Cancel') }}</a>

            </form>
    </tbody>

@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        @if (session('not'))
            {
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
