@extends('adminlte::page')

@section('title', 'Gestión de Reservas')

@section('content_header')
<h1>{{ __('Bookings management') }}</h1>
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
                            <th class="text-center">{{ __('CODE') }}</th>
                            <th class="text-center">{{ __('SERVICE') }}</th>
                            <th class="text-center">{{ __('CREATION TIME') }}</th>
                            <th class="text-center">{{ __('START DATE') }}</th>
                            <th class="text-center">{{ __('PAYMENT METHOD') }}</th>
                            <th class="text-center">{{ __('CUSTOMER NAME') }}</th>
                            <th class="text-center">{{ __('PAY STATUS') }}</th>
                            <th class="text-center">{{ __('DETAILS') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $book)
                        <tr>
                            <td class="text-center">{{ $book->id }}</td>
                            <td class="text-center">{{ $book->tittle }}</td>
                            <td class="text-center">{{ date('d/m/Y', strtotime($book->create_time)) }}</td>
                            <td class="text-center">{{ date('d/m/Y', strtotime($book->initial_date)) }}</td>
                            <td class="text-center">{{ $book->title_payment}}</td>
                            <td class="text-center">{{ $book->name}}</td>
                            <td class="text-center">{{ $book->pay_status}}</td>
                            <td class="text-center">
                                <a class="btn btn-info btn-sm rounded-pill" href="{{ route('bookings.show', $book->id) }}"><i class="fas fa-eye"></i> {{ __('See More') }} </a>
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

    @if(session('destroy') || session('update')) {
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
            title: 'Reserva actualizada'
        })
    </script>
    }
    @endif

    @stop