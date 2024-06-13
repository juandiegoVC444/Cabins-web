@extends('adminlte::page')

@section('title', 'Gestión de PQRS')

@section('content_header')
<h1>{{ __('PQRS management') }}</h1>
@stop

@section('content')

<div class="content container ">
    <div class="col-sm-12">
        <div class="card px-3 p-3 rounded">

            <br>
            <div class="dataTables_length">

                <table id="tabla" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">{{ __('TYPE') }}</th>
                            <th class="text-center">{{ __('REASON') }}</th>
                            <th class="text-center">{{ __('CREATION TIME') }}</th>
                            <th class="text-center">{{ __('CONDITION') }}</th>
                            <th class="text-center">{{ __('DETAILS') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($pqrs as $pqr)
                        <tr>
                            <td class="text-center">{{ $pqr->type }}</td>
                            <td class="text-center">{{ $pqr->reason }}</td>
                            <td class="text-center">{{ date('d/m/Y', strtotime($pqr->create_time)) }}</td>
                            <td class="text-center">{{ $pqr->condition}}</td>
                            <td class="text-center">
                                <a class="btn btn-info btn-sm rounded-pill" href="{{ route('pqrs.show', $pqr->id) }}"><i class="fas fa-eye"></i> {{ __('See More') }} </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
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


    @if(session('update')) {
    <script>
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
            title: 'PQRS actualizada'
        })
    </script>
    }
    @endif

    @stop
