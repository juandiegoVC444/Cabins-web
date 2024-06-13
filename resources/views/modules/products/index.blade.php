@extends('adminlte::page')

@section('title', 'Gestion de Productos')

@section('content_header')
<h1>{{ __('Product management') }}</h1>
@stop

@section('content')
<div class="card-body">

    <div class="content container">
        <div class="p-3">
            <a href="{{ Route('products.create') }}" class="btn btn-success rounded-pill"><i class="fas fa-plus-square"></i> {{ __('Create Product') }}</a>
        </div>

        <div class="col-sm-12">
            <div class="card px-3 rounded">

                <br>
                <div class="dataTables_length">
                    <table id='tabla' class="table">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('NAME PRODUCT') }}</th>
                                <th class="text-center">{{ __('PRICE') }}</th>
                                <th class="text-center">{{ __('UPDATE TIME') }}</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $P)
                            <tr>
                                <td class="text-center">{{ $P->name_product}}</td>
                                <td class="text-center">{{ $P->price }}</td>
                                <td class="text-center">{{ date('d/m/Y', strtotime($P->update_time)) }} </td>

                                <td class="text-center">
                                    <div class="row">
                                        <a class="btn btn-info btn-sm rounded-pill" href="{{ route('products.show', $P->id) }}"><i class="fas fa-eye"></i> {{ __('See More') }}</a>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="row">
                                        <a class="btn btn-success btn-sm rounded-pill" href="{{ route('products.edit', $P->id) }}"><i class="fas fa-edit"></i> {{ __('Edit') }}</a>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="row">
                                        <?php
                                        if ($P->state_record == 'ACTIVAR') {
                                        ?>
                                            <form action="{{route('products.disableProducts', $P->id) }}" class="desactivar" method="get">
                                                <button class="btn btn-danger btn-sm rounded-pill"><i class="fas fa-lock"></i> {{ __('Disable') }}</button>
                                            </form>
                                        <?php
                                        }
                                        ?>

                                        <?php
                                        if ($P->state_record == 'DESACTIVAR') {
                                        ?>
                                            <form action="{{route('products.activeProducts', $P->id) }}" class="activar" method="get">
                                                <button class="btn btn-warning text-white btn-sm rounded-pill"><i class="fas fa-lock-open"></i> {{ __('Activate') }} </button>
                                            </form>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </td>
                                @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">

@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('js/datatables.js')}}"></script>

<script>
    @if(session('update')) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: 'producto actualizado'
        })
    }
    @endif


    @if(session('save')) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: 'producto guardado'
        })
    }
    @endif

    $('.activar').submit(function(e) {
        e.preventDefault();


        Swal.fire({
            title: 'Desea Activar Su Producto?',
            text: "Su producto se cambiara a el estado activo, se mostrara en la pagina principal",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Activar!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }

        })

    });

    $('.desactivar').submit(function(e) {
        e.preventDefault();


        Swal.fire({
            title: 'Desea Desactivar Su Producto?',
            text: "Su producto se cambiara a el estado inactivo, NO se mostrara en la pagina principal",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Desactivar!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }

        })

    });
</script>
@stop
