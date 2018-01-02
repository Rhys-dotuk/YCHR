@extends('adminlte::master')

@if (Auth::user()->account_type == 'U')

@section('body')
    <div class="login-box">
        <div class="login-logo">
            <h1>Hey!</h1>
			<div class="login-box-body">
				<p>I'm sorry but you are not authorised to access this area.</p>
				<a href="{{ route('users.index') }}" class="btn btn-primary btn-block btn-flat" style="color: white;">Back</a>
			</div>
        </div>
    </div>
@stop

@else

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'register-page')

@section('body')
    <div class="register-box">
        <div class="register-logo">
            <h1> <b>HR</b> Manager</h1>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Register new user</p>
            <form method="POST" action="{{ route('register') }}">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    <input type="text" name="name" class="form-control" autocomplete="off" placeholder="Full Name" required autofocus>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" autocomplete="off" placeholder="Email" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Retype Password" required>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

				<div class="form-group has-feedback {{ $errors->has('account_type') ? ' has-error' : '' }}">
                    <span class="glyphicon glyphicon-users form-control-feedback"></span>
                    <div>
                        <select id="account_type" name="account_type" class="form-control" >
							<option value="U">User</option>
							<option value="A">Admin</option>
						</select> 
                    </div>
                </div>

				<input type="hidden" name="company_name" class="form-control" value="{{ Auth::user()->company_name }}">

                <button type="submit" class="btn btn-primary btn-block btn-flat"> {{ trans('adminlte::adminlte.register') }} </button>
            </form>
			&emsp;
			<form action="{{ route('users.index') }}">
				<button type="submit" class="btn btn-warning btn-block btn-flat">Cancel</button>
			</form>
        </div>
    </div>
@stop

@section('adminlte_js')
    @yield('js')
@stop
@endif