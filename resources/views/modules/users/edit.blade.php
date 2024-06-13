@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
<h1>Editar Usuario</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" class="confirmar" action="{{ route('users.update1', $user->id) }}" id="edit-user-form">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}:</label>
                <div class="col-md-6">
                    <input type="number" class="form-control" max="9999999999" id="phone_number" name="phone_number" value="{{ $user->phone_number }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="identification_type" class="col-md-4 col-form-label text-md-right">{{ __('Identification Type') }}:</label>
                <div class="col-md-6">
                    <select id="identification_type" class="form-control @error('identification_type') is-invalid @enderror" name="identification_type" required autofocus>
                        <option value="">Seleccione un tipo de identificación</option>
                        <option value="cedula de ciudadania" {{ $user->identification_type == 'cedula de ciudadania' ? 'selected' : '' }}>Cédula de ciudadanía</option>
                        <option value="cedula de extranjeria" {{ $user->identification_type == 'cedula de extranjeria' ? 'selected' : '' }}>Cédula de extranjería</option>
                        <option value="pasaporte" {{ $user->identification_type == 'pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                        <option value="tarjeta de identidad" {{ $user->identification_type == 'tarjeta de identidad' ? 'selected' : '' }}>Tarjeta de identidad</option>
                    </select>
                    @error('identification_type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="identification_number" class="col-md-4 col-form-label text-md-right">{{ __('Identification Number') }}:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="identification_number" name="identification_number" value="{{ $user->identification_number }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                <div class="col-md-6">
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>
                <div class="col-md-6">
                    <input type="number" class="form-control" id="age" name="age" value="{{ $user->age }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role User') }}:</label>
                <div class="col-md-6">
                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required autofocus>
                        <option value="">Seleccione un rol</option>
                        <option value="1" {{ $user->role_name == 'admin' ? 'selected' : '' }}>Administrador</option>
                        <option value="2" {{ $user->role_name == 'cliente' ? 'selected' : '' }}>Cliente</option>

                  </select>
                    @error('role')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>




            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-success btn-sm rounded-pill" ><i class="fas fa-save "> </i> {{ __('Update') }}</button>
                    <a href="{{ route('users.index') }}" type="submit" class="btn btn-danger btn-sm rounded-pill"><i class="fas fa-window-close"></i> {{ __('Cancel') }}</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')

<script>
    $('.confirmar').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Desea Actualizar El Usuario?',
            showDenyButton: true,
            confirmButtonText: 'Actualizar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            } else if (result.isDenied) {
                Swal.fire('No Se Actualizo El Usuario', '', 'info')
            }
        })
    })
</script>

@endsection
