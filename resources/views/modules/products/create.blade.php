@extends('adminlte::page')

@section('title', 'Create')

@section('content_header')
<h1>{{ __('Create Product') }}</h1>
@stop

@section('content')

<div class="container">
    <div class="card-body">
        <form action="{{Route('products.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">{{ __('NAME PRODUCT') }}</label>
                <input type="text" id="name_product" name="name_product" class="form-control" placeholder="Nombre" required maxlength="29">

            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('PRICE') }}</label>
                <input type="number" name="price" class="form-control" placeholder="precio"  min="1" max="999999" id="numero" required>
            </div>
            <br>

            <div class="mb-3">

                <label>{{ __('PICTURE') }}</label>
                <br>
                <input type="file" name="picture" accept="image/*" multiple="false" required>
            </div>
            <br>

            <div class="mb-3">
                <label class="form-label">{{ __('DESCRIPTION') }}</label>

                <textarea type="text"id="description" name="decripcion" class="form-control" style="width: 100%;height: 150px;border:none;border-radius:15px" required maxlength="255"></textarea>
            </div>

            <a href="{{Route('products.index')}}" type="submit" class="btn btn-primary rounded-pill"><i class="fas fa-undo-alt"></i> {{ __('Return') }} </a>
            <button type="submit"  class="btn btn-success rounded-pill"> <i class="fas fa-save "> </i>    {{ __('Create') }}  {{ __('Product') }}</button>

        </form>
    </div>
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


var input=  document.getElementById('numero');
input.addEventListener('input',function(){
  if (this.value.length > 6)
     this.value = this.value.slice(0,6);
})
</script>

@stop
