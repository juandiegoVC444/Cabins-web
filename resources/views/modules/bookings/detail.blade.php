@extends('adminlte::page')

@section('title', 'Detalle de Reservas')

@section('content_header')
<h1>{{ __('Bookings Detail') }}</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h5>{{ __('BOOKING') }}</h5>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Reservation code') }}:</label>
                        <span>{{ $booking->booking_code }}</span><br>

                        <label>{{ __('Payment Method') }}:</label>
                        <span>{{ $booking->title_payment }}</span><br>

                        <label>{{ __('Amount adults') }}:</label>
                        <span>{{ $booking->amount_adults }}</span><br>

                        <label>{{ __('Amount child') }}:</label>
                        <span>{{ $booking->amount_child }}</span><br>

                        <label>{{ __('Total Bookings') }}:</label>
                        <span>${{ $total_booking }}</span><br>

                        <label>{{ __('Initial Date') }}:</label>
                        <span>{{ $booking->initial_date }}</span><br>

                        <label>{{ __('Final Date') }}:</label>
                        <span>{{ $booking->final_date }}</span><br>

                    </div>
                    <hr>
                    <div class="text-center">
                        <h5>{{ __('SERVICE') }}</h5>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Service name') }}:</label>
                        <span>{{ $booking->tittle }}</span><br>

                        <label>{{ __('Total Services') }}:</label>
                        <span>${{ $booking->total }}</span><br>

                    </div>
                    <hr>
                    @if (count($booking_product) > 0)
                    <div class="text-center">
                        <h5>{{ __('PRODUCTS') }}</h5>
                    </div><br>
                    <div class="form-group">
                        <table class="table table-bordered mx-auto">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio/u</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            @foreach ($booking_product as $boop)
                            <tbody>
                                <tr>
                                    <td>{{ $boop->name_product }}</td>
                                    <td>${{ $boop->price }}</td>
                                    <td>{{ $boop->amount_product }}</td>
                                    <td>${{ $boop->amount_product * $boop->price  }}</td>
                                </tr>

                            </tbody>
                            @endforeach

                        </table><br>
                        <label>{{ __('Total Products') }}:</label>
                        <span>${{ $suma_product }}</span><br>

                    </div>
                    <hr>
                    @endif
                    <div class="text-center">
                        <h5>{{ __('APPLICANT') }}</h5>
                    </div>
                    <div class="form-group">
                        <label>{{ __('User name') }}:</label>
                        <span>{{ $booking->name }} {{ $booking->last_name }}</span><br>

                        <label>{{ __('Phone Number') }}:</label>
                        <span>{{ $booking->phone_number }}</span><br>

                        <label>{{ __('Identification number') }}:</label>
                        <span>{{ $booking->identification_number }}</span><br>

                        <label>{{ __('Email') }}:</label>
                        <span>{{ $booking->email }}</span>
                    </div>
                    <hr>
                    @if (count($booking_members) > 0)
                    <div class="text-center">
                        <h5>{{ __('MEMBERS') }}</h5>
                    </div>
                    @foreach ($booking_members as $boo)
                    <div class="form-group">
                        <label>{{ __('Name') }}:</label>
                        <span>{{ $boo->first_name_member }} {{ $boo->last_name_member }}</span><br>

                        <label>{{ __('Age') }}:</label>
                        <span>{{ $boo->age_member }}</span><br>

                        <label>{{ __('Identification number') }}:</label>
                        <span>{{ $boo->document_member }}</span>
                    </div>
                    @endforeach
                    <hr>
                    @endif
                    <div class="form-group">
                        <label>{{ __('Create Time') }}:</label>
                        <span>{{ $booking->create_time }}</span><br>

                        <label>{{ __('Update Time') }}:</label>
                        <span>{{ $booking->update_time }}</span><br>

                        <label>{{ __('State Record') }}:</label>
                        <span>{{ $booking->state_record }}</span>
                    </div>
                    <div class="col mb">
                        <form class="formulario-state" action="{{ route('bookings.update', $booking->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select class="form-select form-select-lg mb-6" aria-label="Default select example" name="pay_status">
                                <option value="{{ __('EARRING') }}" {{$booking->pay_status == 'PENDIENTE' ? 'selected' : '' }}>{{ __('EARRING') }}</option>
                                <option value="{{ __('PAY') }}" {{$booking->pay_status == 'PAGO' ? 'selected' : '' }}>{{ __('PAY') }}</option>
                            </select><br><br><br>
                    </div>
                    <div class="row mb-12">
                            <div class="row mb-8 mx-auto" >
                                <button type="submit" class="btn btn-success rounded-pill mr-1"><i class="fas fa-edit"></i>
                                    {{ __('Update') }}
                                </button>
                                </form>
                                <?php
                                if ($booking->state_record == 'ACTIVAR') {
                                ?>
                                    <form class="formulario-disable" action="{{ route('bookings.delete', $booking->id) }}" method="GET">
                                        <button class="btn btn-danger rounded-pill mr-1"><i class="fas fa-lock"> </i> {{ __('Disable') }}</button>
                                    </form>
                                <?php
                                }
                                ?>
                                <?php
                                if ($booking->state_record == 'DESACTIVAR') {
                                ?>
                                    <form class="formulario-activate" action="{{ route('bookings.delete', $booking->id) }}" method="GET">
                                        <button class="btn btn-warning text-white rounded-pill mr-1"> <i class="fas fa-lock-open"></i> {{ __('Activate') }}</button>
                                    </form>
                                <?php
                                }
                                ?>
                                <a href="{{ route('bookings.index') }}" class="btn btn-primary rounded-pill"><i class="fas fa-undo-alt"></i> {{ __('Return') }}</a>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('.formulario-disable').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Esta seguro de desactivar la reserva?',
            showDenyButton: true,
            confirmButtonText: 'Desactivar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            } else if (result.isDenied) {
                Swal.fire('No se desactivo la reserva!!', '', 'info')
            }
        })
    })

    $('.formulario-activate').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Esta seguro de activar la reserva?',
            showDenyButton: true,
            confirmButtonText: 'Activar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            } else if (result.isDenied) {
                Swal.fire('No se activo la reserva!!', '', 'info')
            }
        })
    })

    $('.formulario-state').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Esta seguro de actualizar la reserva?',
            showDenyButton: true,
            confirmButtonText: 'Actualizar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            } else if (result.isDenied) {
                Swal.fire('No se actualizó la reserva!!', '', 'info')
            }
        })
    })
</script>
@stop