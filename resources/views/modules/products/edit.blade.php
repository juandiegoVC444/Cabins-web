@extends('adminlte::page')

@section('title', 'Editar Productos')

@section('content_header')
<h1>{{ __('Update Product') }}</h1>
@stop

@section('content')

<div class="container">

    <form action="{{ Route('products.update', $products->id) }}" method="POST" class="confirmar" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">{{ __('NAME PRODUCT') }}</label>
            <input type="text" name="name_product" value="{{ $products->name_product }}" class="form-control" placeholder="Nombre" required maxlength="29">
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('PRICE') }}</label>
            <input type="number" name="price" value="{{ $products->price }}" class="form-control" placeholder="Precio" required min="1" max="999999" id="numero">
        </div>

        <div class="mb-3">
            <input type="text" name="pictureOld" value="{{ $products->picture }}" accept="image/*" multiple="false" class="form-control" hidden>
        </div>


        <div class="mb-3">
            <label>{{ __('PICTURE') }}</label>
            <br>
            <input type="file" name="picture" value="{{ $products->picture }}" accept="image/*" multiple="false" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('DESCRIPTION') }}</label>
            <style type="text/css">
                textarea {
                    resize: none;
                }
            </style>

            <textarea type="text" id="description" name="decripcion" class="form-control" style="width: 100%;height: 150px;border:none;border-radius:15px" required maxlength="255">{{ $products->decripcion }}</textarea>
        </div>

        <div style="text-align: center; ">

            <a style="margin: 10px;" href="{{ Route('products.index') }}" type="submit" class="btn btn-primary rounded-pill"><i class="fas fa-undo-alt"></i> {{ __('Return') }}</a>
            <button style="margin: 10px;" type="submit" class="btn btn-success rounded-pill"><i class="fas fa-edit "> </i> {{ __('Update') }}</button>

        </div>
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
            text: 'Formato No Valido!',
            footer: 'Elige una imagen de formato png,jpg,jpeg o gif'
        })
    }
    @endif

    var input = document.getElementById('numero');
    input.addEventListener('input', function() {
        if (this.value.length > 6)
            this.value = this.value.slice(0, 6);
    })

    $('.confirmar').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Desea Actualizar Su Producto?',
            showDenyButton: true,
            confirmButtonText: 'Actualizar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            } else if (result.isDenied) {
                Swal.fire('No Se Actualizo El Producto', '', 'info')
            }
        })
    })

</script>

@stop
