@extends('adminlte::page')

@section('title', 'Detalle de la Temporada')

@section('content_header')
<h1>Detalles del Servicio</h1>
@stop

@section('content')

<div class="container">
    <form action="{{Route('seasons.update', $season->id)}}" method="POST" enctype="multipart/form-data"><!--Aqui va el POST-->
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">{{ __('TITTLE') }}</label>
            <input type="text" name="tittle" maxlength="50" value="{{$season->tittle}}" class="form-control" placeholder="Titlle" readonly="readonly">
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('SERVICE') }}</label>
            <input type="text" name="service" maxlength="50" value="{{$service->tittle}}" class="form-control" placeholder="Titlle" readonly="readonly">
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('DESCRIPTION') }}</label>
            <input type="text" name="description" maxlength="255" value="{{$season->description}}" class="form-control" placeholder="Description" readonly="readonly">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('INITIAL DATE') }}</label>
            <input type="text" name="initial_date" value="{{date('d/m/Y', strtotime($season->initial_date)) }}" class="form-control" placeholder="Initial Date" readonly="readonly">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('FINAL DATE') }}</label>
            <input type="text" name="final_date" value="{{date('d/m/Y', strtotime($season->final_date))}}" class="form-control" placeholder="Final Date" readonly="readonly">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('PRICE') }}</label>
            <input type="number" name="price" min=0 max=100 value="{{$season->price}}" class="form-control" placeholder="Rules" readonly="readonly">
        </div>



        <div style="text-align: center; ">
            <a style="margin: 10px;" href="{{ Route('seasons.index') }}" type="submit" class="btn btn-primary rounded-pill"><i class="fas fa-undo-alt"></i> {{ __('Return') }}</a>
        </div>

    </form>

</div>


@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')


@stop
