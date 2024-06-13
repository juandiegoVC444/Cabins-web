<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('styles')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/users/changePassword.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    @parent

</head>

<html>
<body>
<header>
        @include('layouts.nav')
</header>
    <h1>{{ __('Change Password') }}</h1>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"></h3>
                            </div>

                            <form method="POST" action="{{ route('password.update') }}">

                                @csrf
                                <div class="box-body">

                                    <div class="form-group row">
                                        <label for="current_password">{{ __('Current Password') }}</label>
                                        <input type="password" name="current_password" class="form-control"
                                            id="current_password" required>
                                    </div>

                                    <div class="form-group row">
                                        <label for="new_password">{{ __('New Password') }}</label>
                                        <input type="password"  name="new_password" class="form-control" pattern=".{8,}"  id="new_password"
                                            required>
                                    </div>

                                    <div class="form-group row">
                                        <label for="new_password_confirmation">{{ __('Confirm') }}
                                        {{ __('New Password') }}</label>
                                        <input type="password"  name="new_password_confirmation" pattern=".{8,}"  class="form-control"
                                            id="new_password_confirmation" required>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success rounded-pill"><i class="fa fa-edit"></i>{{ __('Change Password') }}</button>
                                    <a type="submit" href="{{ route('users.userInfo') }}" class="btn btn-primary rounded-pill"><i class="fas fa-undo-alt"></i> {{ __('Return') }}</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</body>
</html>


<script>
function validar() {
    var campo = document.getElementById("new_password").value;
    if (campo.length < 8) {
      alert("El campo debe tener al menos 8 caracteres");
      return false;
    }
    return true;
  }

@if(session('success')) {
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
                title: 'contraseña actualizada'
            })
        }
        @endif
</script>
