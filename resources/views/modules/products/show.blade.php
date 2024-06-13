@extends('adminlte::page')

@section('title', 'Detalle del producto')

@section('content_header')
<h1>{{ __('Details Product') }}</h1>
@stop

@section('content')

<div class="container">
    <form action="{{ Route('products.edit', $products->id) }}" method="GET" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">{{ __('NAME PRODUCT') }}</label>
            <input type="text" name="name_product" value="{{ $products->name_product }}" class="form-control" placeholder="Nombre" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('PRICE') }}</label>
            <input type="number" name="price" value="{{ $products->price }}" class="form-control" placeholder="Precio" readonly>
        </div>

        <div class="mb-3" style="width: 18rem;">
            <label class="form-label">{{ __('PICTURE') }}</label>
            <img class="card-img-top" src="{{ asset('storage/imgProducts').'/'.$products->picture}}" alt="">
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('DESCRIPTION') }}</label>
            <textarea type="text" id="description" name="decripcion"  class="form-control" style="width: 100%;height: 150px;border:none;border-radius:15px" required maxlength="255" readonly>{{ $products->decripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('CREATION TIME') }}</label>
            <input type="text" name="decripcion" value="{{ $products->create_time }}" class="form-control" placeholder="Descripcion" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('UPDATE TIME') }}</label>
            <input type="text" name="decripcion" value="{{ $products->update_time }}" class="form-control"  placeholder="Descripcion" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('STATE RECORD') }}</label>
            <input type="text" name="decripcion" value="{{ $products->state_record }}" class="form-control"  placeholder="Descripcion" readonly>
        </div>


        <div style="text-align: center; ">
            <a style="margin: 10px;" href="{{ Route('products.index') }}" type="submit" class="btn btn-primary rounded-pill"><i class="fas fa-undo-alt"></i> {{ __('Return') }}</a>
            <button style="margin: 10px;" type="submit"  class="btn btn-success rounded-pill"><i class="fas fa-edit"></i>  </i> {{ __('Edit') }}</button>

        </div>
    </form>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
