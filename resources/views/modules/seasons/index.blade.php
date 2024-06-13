@extends('adminlte::page')

@section('title', 'Detalle Temporada')

@section('content_header')
<h1>{{ __('Detail season') }} </h1>
@stop

@section('content')

<div class="card-body">
    <div class="content container ">

        <div class="p-3">
            <a href="{{ route('seasons.create')}}" class="btn btn-success rounded-pill"><i class="fas fa-plus-square"></i> {{ __('Add season') }}</a>
        </div>

        <div class="col-sm-12">
            <div class="card px-3">
                <div class="card-header">
                    <table id='tabla' class="table">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('TITTLE') }}</th>
                                <th class="text-center">{{ __('DESCRIPTION') }}</th>
                                <th class="text-center">{{ __('INITIAL DATE') }}</th>
                                <th class="text-center">{{ __('FINAL DATE') }}</th>
                                <th class="text-center">{{ __('PRICE') }}</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($season as $s)
                            <tr>
                                <td class="text-center"> {{$s->tittle}}</td>
                                <td class="text-center"> {{$s->description}}</td>
                                <td class="text-center"> {{date('d/m/Y', strtotime($s->initial_date)) }}</td>
                                <td class="text-center"> {{date('d/m/Y', strtotime($s->final_date))}}</td>
                                <td class="text-center"> {{$s->price}}</td>


                                <td class="text-center">
                                <div class="row">
                                    <a class="btn btn-info btn-sm rounded-pill" href="{{ route('seasons.show', $s->id) }}"><i class="fas fa-eye"></i> {{ __('See More') }}</a>
                                </div>
                            </td>

                            <td class="text-center">
                                <div class="row">
                                    <a class="btn btn-success btn-sm rounded-pill" href="{{ route('seasons.edit', $s->id) }}"><i class="fas fa-edit"></i> {{ __('Edit') }}</a>
                                </div>
                            </td>

                            <td class="text-center">
                                <div class="row">
                                    <?php
                                    if ($s->state_record == 'ACTIVAR') {
                                    ?>

                                        <form action="{{route('seasons.disableSeasons', $s->id) }}" class="desactivar" method="get">
                                            <button class="btn btn-danger btn-sm rounded-pill"><i class="fas fa-lock"></i> {{ __('Disable') }}</button>
                                        </form>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($s->state_record == 'DESACTIVAR') {
                                    ?>
                                        <form action="{{route('seasons.activeSeasons', $s->id) }}" class="activar" method="get">
                                            <button class="btn btn-warning text-white btn-sm rounded-pill"><i class="fas fa-lock-open"></i> {{ __('Activate') }} </button>
                                        </form>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                            </tr>

                        </tbody>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
<br>
<a href="{{Route('services.index')}}" type="submit" class="btn btn-primary rounded-pill"><i class="fas fa-undo-alt"></i> {{ __('Return') }}</a>

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
    @if(session('ok') == 'ok')
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Temporada Creada satisfactoriamente',
        showConfirmButton: false,
        timer: 2500
    })
    @endif

    @if(session("update"))
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Temporada Actualizada satisfactoriamente',
        showConfirmButton: false,
        timer: 2500
    })
    @endif

    $('.activar').submit(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Desea Activar La Temporada?',
            text: "La temporada se cambiara a el estado activo, por lo tanto SI se mostrara en la pagina principal",
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
            title: 'Desea Desactivar La Temporada?',
            text: "La Temporada cambiara a el estado inactivo, por lo tanto NO se mostrara en la pagina principal",
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
