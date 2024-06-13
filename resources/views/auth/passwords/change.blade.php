@extends('adminlte::page')

@section('title', 'Change Password')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Change_Password') }}</h3>
            </div>

            <form method="POST" action="{{ route('password.update') }}">

                @csrf
                <div class="box-body">

                    <div class="form-group">
                        <label for="current_password">{{ __('Current_Password') }}</label>
                        <input type="password" name="current_password" class="form-control" id="current_password" required>
                    </div>

                    <div class="form-group">
                        <label for="new_password">{{ __('New_Password') }}</label>
                        <input type="password" name="new_password" class="form-control" id="new_password" required>
                    </div>

                    <div class="form-group">
                        <label for="new_password_confirmation">{{ __('Confirm') }} {{ __('New_Password') }}</label>
                        <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation" required>
                    </div>

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success">{{ __('Change_Password') }}</button>
                </div>

            </form>
        </div>
    </div>
</div>
@stop
