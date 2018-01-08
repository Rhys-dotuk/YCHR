@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')
    <div class="col-xs-4 col-xs-offset-4" style="top: 20px;">
        @if(Session::has('edit_unsuccessful'))
            <div class="alert alert-danger" role="alert">
                <strong> Error: </strong> {{ Session::get('edit_unsuccessful') }}
            </div>
        @endif
	</div>
    &emsp;
    <div class="login-box">
        <div class="login-logo">
            <h1><b>HR</b> Manager</h1>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <form method="POST" action="{{ route('users.password', Auth::user()->id) }}">
                {{ method_field('PUT') }}
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Current Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm New Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-flat">Confirm Change</button>
                &emsp;
            </form>
            <form action="{{ route('users.editprofile', Auth::user()->id) }}">
				    <button type="submit" class="btn btn-warning btn-block btn-flat">Cancel</button>
			</form>
        </div>
    </div>
@stop