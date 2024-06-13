@extends('adminlte::page')

@section('title', 'Detalle Servicio')

@section('content_header')
<h1>{{ __('Detail service of') }} {{$services->tittle}}</h1>
@stop

@section('content')

<div class="card-body">
    <div class="content container ">

        <div class="p-3">
            <a href="{{ route('services.addDetail', $services->id)}}" class="btn btn-success rounded-pill"><i class="fas fa-plus-square"></i> {{ __('Add detail') }}</a>
        </div>

        <div class="col-sm-12">
            <div class="card px-3">
                <div class="card-header">
                    <table id='tabla' class="table">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('TITTLE') }}</th>
                                <th class="text-center">{{ __('DESCRIPTION') }}</th>
                                <th class="text-center">{{ __('CREATION TIME') }}</th>
                                <th class="text-center">{{ __('PICTURE') }}</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>

                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($services->detail_service as $de)
                            <tr>

                                <td class="text-center">{{ $de->tittle }}</td>
                                <td class="text-center">{{ $de->description }}</td>
                                <td class="text-center">{{ date('d/m/Y', strtotime($de->create_time)) }}</td>

                                {{-- <div class="carousel-inner">
                                    <div class="carousel-item active">
                                       <td> <img class="d-block w-100" src="{{asset('storage/imgServices').'/'.$re->url}}">
                                <a href="{{route('services.editImg',$services->id)}}">{{ __('Update images')}}</a>
                                </td>
                                </tbody>
                    </table>
                </div>
            </div> --}}

            <td>
                <div id="carouselExampleControls{{$de->id}}" class="carousel" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($de ->resource as $re)
                        <div class="carousel-item @if ($loop->index==0) active @endif" style="width:150px; height:150px;">
                            <img class="img-thumbnail" style="  object-fit: cover;width:100%;height:100%;" src="{{asset('storage/imgServices').'/'.$re->url}}">
                        </div>
                        @endforeach

                        <a class="carousel-control-prev" href="#carouselExampleControls{{$de->id}}" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls{{$de->id}}" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </td>

        </div>


        <td class="text-center">
            <div class="row">
                <a class="btn btn-success btn-sm  rounded-pill" href="{{ route('services.captureImg',['id' => $services->id, 'de' => $de->id]) }}">
                    <i class="fas fa-edit"></i> {{ __('Edit') }}
                </a>
            </div>

            @if ($de->resource->count() <=4) <td class="text-center">
                <div class="row">
                    <a class="btn btn-info btn-sm  rounded-pill" href="{{ route('services.addImage',['id' => $services->id, 'de' => $de->id]) }}">
                        <i class="fas fa-plus-square"></i> {{ __('Add image') }}
                    </a>
                </div>
        </td>
        @else
        <td class="text-center">
            <span class="d-inline-block" data-toggle="popover" data-content="Disabled popover">
                <button class="btn btn-info btn-sm  rounded-pill" style="pointer-events: none;" type="button" disabled><i class="fas fa-plus-square"></i> {{ __('Add image') }}</button>
            </span>
        </td>
        @endif

        <td class="text-center">
            <div class="row">
                <?php
                if ($de->state_record == 'ACTIVAR') {
                ?>
                    <form action="{{ route('services.disableDetailServices', $de->id) }}" class="desactivar" method="get">
                        <button class="btn btn-danger btn-sm  rounded-pill"><i class="fas fa-lock"></i> {{ __('Disable') }}</button>
                    </form>
                <?php
                }
                ?>
                <?php
                if ($de->state_record == 'DESACTIVAR') {
                ?>
                    <form action="{{ route('services.activeDetailServices', $de->id) }}" class="activar" method="get">
                        <button class="btn btn-warning btn-sm  text-white rounded-pill"><i class="fas fa-lock-open"></i> {{ __('Active') }}</button>
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
        title: 'Detalle del servicio Creado Satisfactoriamente',
        showConfirmButton: false,
        timer: 2500
    })
    @endif

    @if(session('error')) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Llegaste al maximo de imagenes permitidas',
            footer: 'Límite 5 imagenes'
        })
    }
    @endif

    @if(session("update"))
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Detalle del Servicio Actualizado Correctamente ',
        showConfirmButton: false,
        timer: 2500
    })
    @endif

    @if(session("cancelar"))
    Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'No se realizaron cambios ',
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
            title: 'Detalle de Servicio Actualizado'
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
            title: 'Imagen guardada'
        })
    }
    @endif

    $('.activar').submit(function(e) {
        e.preventDefault();


        Swal.fire({
            title: 'Desea Activar El Detalle del Servicio?',
            text: "El Detalle del Servicio se cambiara a el estado activo, por lo tanto SI se mostrara en la pagina principal",
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
            title: 'Desea Desactivar El Detalle del Servicio?',
            text: "El Detalle del Servicio cambiara a el estado inactivo, por lo tanto NO se mostrara en la pagina principal",
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
