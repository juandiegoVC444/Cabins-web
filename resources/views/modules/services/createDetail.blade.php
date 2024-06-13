@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('Create detail of') }} {{$services->tittle}}</h1>
@stop

@section('content')
<div class="container">
    <form action="{{Route('services.createDetail', $services->id)}}" method="POST" enctype="multipart/form-data">
     @csrf
        <div class="mb-3">
            <label class="form-label">{{ __('TITTLE') }}</label>
            <input type="text" name="tittle" maxlength="255" class="form-control" placeholder="Titulo" required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('DESCRIPTION') }}</label>
            <input type="text"  name="description" maxlength="255"  class="form-control" placeholder="Descripcion" required>
        </div>


        <br>
        <br>

        <a href="{{Route('services.showDetails',$services->id)}}" type="submit" class="btn btn-primary rounded-pill"><i class="fas fa-undo-alt"></i> {{ __('Return') }} </a>

        <button type="submit"  class="btn btn-success rounded-pill"><i class="fas fa-plus-square"> </i> {{ __('Create') }} </button>

    </form>

</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
