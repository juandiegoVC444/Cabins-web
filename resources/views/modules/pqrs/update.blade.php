@extends('adminlte::page')

@section('title', 'Actualizar PQRS')

@section('content_header')
<h1>{{ __('PQRS management') }}</h1>
@stop

@section('content')

<div class="content container">
    <div class="col-sm-10">
        <div class="card px-3">
            <div class="contenedor">
                <div class="row mb-3 formulario">
                    <div class="col mb">
                        <label for="name" class="titulos text-md-end">
                            <h5><b>{{ __('Name') }}</b></h5>
                        </label>
                        <input readonly="readonly" type="text" class="input-name width-60" value="{{ $pqr-> name_user}}">
                    </div>
                    <div class="col mb">
                        <label for="name" class="titulos text-md-end">
                            <h5><b>{{ __('Phone Number') }}</b></h5>
                        </label>
                        <input readonly="readonly" type="text" class="input-name width-30" value="{{ $pqr->phone_user }}">
                    </div>

                </div>
                <div class="margin-bottom-15">
                    <h5><b>{{ __('Type') }}</b></h5>
                    <input readonly="readonly" type="text" class="type" value="{{ $pqr->type }}">
                </div>

                <div class="margin-bottom-15">
                    <h5><b>{{ __('Reason') }}</b></h5>
                    <input readonly="readonly" type="text" class="reason" value="{{ $pqr->reason }}">
                </div>

                <div class="margin-bottom-15">
                    <h5><b>{{ __('File_number') }}</b></h5>
                    <input readonly="readonly" type="text" class="reason" value="{{ $pqr->file_number }}">
                </div>

                <div class="margin-bottom-15">
                    <h5><b>{{ __('Bookings code') }}</b></h5>
                    <input readonly="readonly" type="text" class="reason" value="{{ $code }}">
                </div>

                <div class="margin-bottom-15">
                    <h5><b>{{ __('Description') }}</b></h5>
                    <style type="text/css">
                        textarea {
                            resize: none;
                        }
                    </style>
                    <textarea readonly="readonly" type="text" class="textarea" cols="40" rows="10">{{ $pqr->description }}</textarea>
                </div>

                @if(null != $pqr->evidence) <php { ?>

                <div class="margin-bottom-15">
                    <h5><b>{{ __('Evidence') }}</b></h5>
                    <a href="{{ asset('storage/PQRS_FILES').'/'.$pqr->evidence }}" target="_blank"><i class='fas fa-file-pdf'></i> {{ __('Download PDF') }}</a>
                </div>
                <php } ?>
                @endif

                <div class="row mb-3">
                    <div class="col mb">
                        <label for="name" class="margin-0 text-md-end">
                            <h5><b>{{ __('Create Time') }}</b></h5>
                        </label>
                        <input readonly="readonly" type="text" class="time" value="{{ $pqr-> create_time}}">
                    </div>
                    <div class="col mb">
                        <label for="name" class="titulos text-md-end">
                            <h5><b>{{ __('Update Time') }}</b></h5>
                        </label>
                        <input readonly="readonly" type="text" class="time" value="{{ $pqr->update_time }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col mb">
                        <form class="formulario-state" action="{{ route('pqrs.update', $pqr->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select class="selected-status btn btn-light" aria-label="Default select example" name="condition">
                                <option value="{{ __('MANAGED') }}" {{ $pqr->condition == 'GESTIONADO' ? 'selected' : '' }}>{{ __('MANAGED') }}</option>
                                <option value="{{ __('IN PROGRESS') }}" {{ $pqr->condition == 'EN PROCESO' ? 'selected' : '' }}>{{ __('IN PROGRESS') }}</option>
                                <option value="{{ __('NO MANAGED') }}" {{ $pqr->condition == 'NO GESTIONADO' ? 'selected' : '' }}>{{ __('NO MANAGED') }}</option>
                            </select>
                            <button type="submit" class="buttom-update btn btn-success rounded-pill"><i class="fas fa-edit"></i>
                                {{ __('Update') }}
                            </button>

                        </form>
                    </div>
                    <div class="col mb">
                        <form class="formulario-delete" action="{{ route('pqrs.disableProducts', $pqr->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button style="float: right;" type="submit" class="btn btn-danger rounded-pill"><i class="fas fa-lock"></i>
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <div class="form-group row,">
            <a href="{{ route('pqrs.index') }}" class="btn btn-primary rounded-pill"><i class="fas fa-undo-alt"></i> {{ __('Return') }}</a>
        </div>
        <br>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('css/pqrs/updatepqrs.css') }}">
@stop

@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('.formulario-delete').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Esta seguro de eliminar la PQRS?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33C',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Aceptar',
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })

    });

    $('.formulario-state').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Esta seguro de actualizar la PQRS?',
            showDenyButton: true,
            confirmButtonText: 'Actualizar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            } else if (result.isDenied) {
                Swal.fire('No se actualizó la PQRS!!', '', 'info')
            }
        })
    })
</script>

@stop
