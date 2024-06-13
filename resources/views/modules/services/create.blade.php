@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear Servicios</h1>
@stop

@section('content')
<div class="container">
    <form action="{{Route('services.store')}}" method="POST" enctype="multipart/form-data">
     @csrf
        <div class="mb-3">
            <label class="form-label">{{ __('TITTLE') }}</label>
            <input type="text" name="title" maxlength="20" class="form-control" placeholder="Titulo" required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('DESCRIPTION') }}</label>
            <input type="text"  name="description" maxlength="255"  class="form-control" placeholder="Descripcion" required>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('MAX INDIVIDUALS') }}</label>
            <input type="number" min=1 max=100 name="max_individuals"  class="form-control" placeholder="Maximo de personas" required>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('RULES') }}</label>
            <input type="text" name="rules"  class="form-control" placeholder="Reglas" required>
        </div>

        <br>
        <br>

        <a href="{{Route('services.index')}}" type="submit" class="btn btn-primary rounded-pill"><i class="fas fa-undo-alt"></i> {{ __('Return') }} </a>
        <button type="submit" class="btn btn-success rounded-pill"> <i class="fas fa-save "> </i>  {{ __('Create Service') }}</button>

    </form>

</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
