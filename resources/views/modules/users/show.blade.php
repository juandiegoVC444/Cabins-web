@extends('adminlte::page')

@section('title', 'Detalles de usuarios')

@section('content_header')
<h1>{{ __('User Details') }}</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"><h4>{{ __('USER DETAILS') }}</h4></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('Role User') }}:</label>
                            <span>{{ $user->role_name }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Name') }}:</label>
                            <span>{{ $user->name }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Last Name') }}:</label>
                            <span>{{ $user->last_name }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Phone Number') }}:</label>
                            <span>{{ $user->phone_number }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Identification Type') }}:</label>
                            <span>{{ $user->identification_type }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Identification Number') }}:</label>
                            <span>{{ $user->identification_number }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Email') }}:</label>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Age') }}:</label>
                            <span>{{ $user->age }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Create Time') }}:</label>
                            <span>{{ $user->create_time }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Update Time') }}:</label>
                            <span>{{ $user->update_time }}</span>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success rounded-pill"><i class="fas fa-edit"></i>{{ __('Edit') }}</a>
                                <a href="{{ route('users.index') }}" class="btn btn-primary rounded-pill"><i class="fas fa-undo-alt"></i>  {{ __('Return') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')

@stop
