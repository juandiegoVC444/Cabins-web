<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('styles')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/users/myAccount.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    @parent

</head>

<html>
<body>
<header>
        @include('layouts.nav')
</header>

<h1>Mi Perfil</h1>

	<div class="container">
		<div class="card">
            <div class="card-body">

                <form method="POST" class="confirmar" action="{{ route('users.upMyacount', $user->id) }}" id="edit-user-form">
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
                            <input type="number" class="form-control" id="phone_number" max="9999999999" name="phone_number" value="{{ $user->phone_number }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="identification_type" class="col-md-4 col-form-label text-md-right">{{ __('Identification Type') }}:</label>
                        <div class="col-md-6">
                            <select id="identification_type" class="@error('identification_type') is-invalid @enderror" name="identification_type" required autofocus>
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
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}:</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}:</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" id="age" max="100" name="age" value="{{ $user->age }}">
                        </div>
                    </div>

                    <div class="allButtons">

                       <button type="submit" class="padding-10 border-radius-20 changebutton btn btn-success btn-sm rounded-pill">
                        <i class="fas fa-save "> </i> {{ __('Update') }}</button>

                        <a type="submit" href="{{ route('users.showPassword',$user->id) }}" class="padding-10 border-radius-20 changebutton btn btn-info btn-sm rounded-pill" >
                            <i class="fa fa-edit"></i> {{ __('Change Password') }}</a>

                        @if($role == 1)
                            <a class="border-radius-20 btn btn-dashboard padding-10 dashboardbutton" type="submit" href="{{ Route('users.index') }}"  ><i class="fa fa-cogs"></i> Dashboard</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
	</div>
    @include('layouts.footer')
</body>
</html>

<!-- <script>
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
                title: 'Usuario actualizado'
            })
        }
        @endif
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
</script> -->
