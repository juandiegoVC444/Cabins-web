@extends('adminlte::page')

@section('title', 'Servicios')

@section('content_header')
<h1>{{ __('Services') }}</h1>
@stop

@section('content')

<div class="content container ">
    <div class="col-sm-12">

        <div class="p-3">
            <a class="btn btn-success rounded-pill" href="{{ Route('services.create')}}"><i class="fas fa-plus-square"></i> {{ __('Create New') }} </a>
        </div>

        <div class="card p-3 rounded">

            <div class="dataTables_length">

                <table id="tabla" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">{{ __('TITTLE') }}</th>
                            <th class="text-center">{{ __('DESCRIPTION') }}</th>
                            <th class="text-center">{{ __('MAX INDIVIDUALS') }}</th>
                            <th class="text-center">{{ __('CREATION TIME') }}</th>
                            <th class="text-center">{{ __('PRICE') }}</th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($services as $S)
                        <tr>
                            <td class="text-center">{{ $S->tittle }}</td>
                            <td class="text-center">{{ $S->description }}</td>
                            <td class="text-center">{{ $S->max_individuals }}</td>
                            <td class="text-center">{{ date('d/m/Y', strtotime($S->create_time)) }}</td>

                            <td class="text-center">
                                <div class="row">
                                    <a class="btn btn-info btn-sm rounded-pill" href="{{ route('services.show', $S->id) }}"><i class="fas fa-eye"></i> {{ __('See More') }}</a>
                                </div>
                            </td>

                            <td class="text-center">
                                <div class="row">
                                    <a class="btn btn-success btn-sm rounded-pill" href="{{ route('services.edit', $S->id) }}"><i class="fas fa-edit"></i> {{ __('Edit') }}</a>
                                </div>
                            </td>

                            <td class="text-center">
                                <div class="row">
                                    <?php
                                    if ($S->state_record == 'ACTIVAR') {
                                    ?>
                                        <form action="{{route('services.disableServices', $S->id) }}" class="desactivar" method="get">
                                            <button class="btn btn-danger btn-sm rounded-pill"><i class="fas fa-lock"></i> {{ __('Disable') }}</button>
                                        </form>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($S->state_record == 'DESACTIVAR') {
                                    ?>
                                        <form action="{{route('services.activeServices', $S->id) }}" class="activar" method="get">
                                            <button class="btn btn-warning text-white btn-sm rounded-pill"><i class="fas fa-lock-open"></i> {{ __('Activate') }} </button>
                                        </form>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">

@stop

@section('js')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('js/datatables.js')}}"></script>

<script>
    @if(session('ok') == 'ok')
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Servicio Creado Satisfactoriamente',
        showConfirmButton: false,
        timer: 2500
    })
    @endif

    @if(session("update"))
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Servicios Actualizado Correctamente ',
        showConfirmButton: false,
        timer: 2500
    })
    @endif

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
            title: 'Servicio actualizado'
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
            title: 'Servicio guardado'
        })
    }
    @endif

    $('.activar').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Desea Activar El Servicio?',
            text: "El Servicio cambiará a activo, se mostrará en la pagina principal",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Activar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });

    $('.desactivar').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Desea Desactivar El Servicio?',
            text: "El Servicio cambiara a inactivo, NO se mostrara en la pagina principal",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Desactivar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });

</script>

@stop
