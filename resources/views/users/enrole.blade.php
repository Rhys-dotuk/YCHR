@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')
    <div class="register-box">
        <div class="register-logo">
            <h1> <b>Admin</b>LTE </h1>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Register New Company Account</p>
			<p class="login-box-msg"><label>Note: </label> The user who sets up this account will be an admin for the company.</p>
            <form method="POST" action="{{ route('user.enrole') }}">
                {!! csrf_field() !!}

				<div class="form-group">
					<hr><label>User Set Up:</label>
                </div>

                <div class="form-group has-feedback {{ $errors->has('user_name') ? 'has-error' : '' }}">
                    <input type="text" name="user_name" class="form-control" autocomplete="off" placeholder="Full Name" required autofocus>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('user_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('user_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('user_email') ? 'has-error' : '' }}">
                    <input type="email" name="user_email" class="form-control" autocomplete="off" placeholder="Email" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('user_email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('user_email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('user_password') ? 'has-error' : '' }}">
                    <input type="password" name="user_password" class="form-control" placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('user_password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('user_password') }}</strong>
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

                <input type="hidden" name="user_account_type" id="user_account_type" class="form-control" value="A">
				
				<div class="form-group">
					<hr><label>Company Set Up:</label>
                </div>

				<div class="form-group has-feedback {{ $errors->has('company_name') ? 'has-error' : '' }}">
                    <input type="text" name="company_name" class="form-control" autocomplete="off" placeholder="Company Name" required> 
                    <span class="glyphicon glyphicon-briefcase form-control-feedback"></span>
                    @if ($errors->has('company_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('company_name') }}</strong>
                        </span>
                    @endif
                </div>

				<div class="form-group has-feedback {{ $errors->has('company_address') ? 'has-error' : '' }}">
                    <input type="text" name="company_address" class="form-control" autocomplete="off" placeholder="Address">
                    <span class="glyphicon glyphicon-home form-control-feedback"></span>
                    @if ($errors->has('company_address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('company_address') }}</strong>
                        </span>
                    @endif
                </div>

				<div class="form-group has-feedback {{ $errors->has('company_email') ? 'has-error' : '' }}">
                    <input type="email" name="company_email" class="form-control" autocomplete="off" placeholder="Email" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('company_email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('company_email') }}</strong>
                        </span>
                    @endif
                </div>

			    <div class="form-group has-feedback {{ $errors->has('company_phone') ? 'has-error' : '' }}">
                    <input type="text" name="company_phone" class="form-control" autocomplete="off" placeholder="Number">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                    @if ($errors->has('company_phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('company_phone') }}</strong>
                        </span>
                    @endif
                </div>

				<div class="form-group has-feedback {{ $errors->has('company_fax') ? 'has-error' : '' }}">
                    <input type="text" name="company_fax" class="form-control" autocomplete="off" placeholder="FAX">
                    <span class="glyphicon glyphicon-print form-control-feedback"></span>
                    @if ($errors->has('company_fax'))
                        <span class="help-block">
                            <strong>{{ $errors->first('company_fax') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </form>
			&emsp;
			<form action="{{ route('login') }}">
				<button type="submit" class="btn btn-warning btn-block btn-flat">Cancel</button>
			</form>
        </div>
    </div>
@stop