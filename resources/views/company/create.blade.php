@extends('adminlte::page')
@section('title', 'Dashboard')

@if (Auth::user()->account_type == 'Z')
	@section('content_header')
		<h1>Create New Company</h1><hr>
	@stop

	@section('content')
		<div class="col-xs-6" style="margin: 20px;">
			<div class="register-box-body">
				<form action="{{ route('company.create') }}" method="POST">
					{!! csrf_field() !!}

					<div class="form-group has-feedback {{ $errors->has('company_name') ? 'has-error' : '' }}">
						<label>Company Name:</label>
						<input type="text" name="company_name" class="form-control" autocomplete="off" required autofocus> 
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
						@if ($errors->has('company_name'))
							<span class="help-block">
								<strong>{{ $errors->first('company_name') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group has-feedback {{ $errors->has('address') ? 'has-error' : '' }}">
						<label>Address:</label>
						<input type="text" name="address" class="form-control" autocomplete="off">
						<span class="glyphicon glyphicon-home form-control-feedback"></span>
						@if ($errors->has('address'))
							<span class="help-block">
								<strong>{{ $errors->first('address') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
						<label>Email:</label>
						<input type="email" name="email" class="form-control" autocomplete="off">
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group has-feedback {{ $errors->has('phone') ? 'has-error' : '' }}">
						<label>Contact Number:</label>
						<input type="text" name="phone" class="form-control" autocomplete="off">
						<span class="glyphicon glyphicon-phone form-control-feedback"></span>
						@if ($errors->has('phone'))
							<span class="help-block">
								<strong>{{ $errors->first('phone') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group has-feedback {{ $errors->has('fax') ? 'has-error' : '' }}">
						<label>FAX:</label>
						<input type="text" name="fax" class="form-control" autocomplete="off">
						<span class="glyphicon glyphicon-fax form-control-feedback"></span>
						@if ($errors->has('fax'))
							<span class="help-block">
								<strong>{{ $errors->first('fax') }}</strong>
							</span>
						@endif
					</div>

					<button type="submit" class="btn btn-primary btn-block btn-flat"> Create </button>
				</form>
			</div>
		</div>
		<div>
			<div class="col-xs-4">
				<div class="well edit-form-group" style="background-color: #636B6F; color: #F5F8FA; margin: 20px;">
					<h4>Further Actions</h4>
					<hr>
					<div class="row">
						<form action="{{ route('company.index') }}">
							<button type="submit" class="btn btn-warning btn-block btn-flat">Cancel</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	@stop
@else
	@section('content')
		<div class="login-box">
			<div class="login-logo">
				<h1>Hey!</h1>
				<div class="login-box-body" style="background-color: #ECF0F5;">
					<p>I'm sorry but you are not authorised to access this area.</p>
					<a href="{{ route('home') }}" class="btn btn-primary btn-block btn-flat" style="color: white;">Back</a>
				</div>
			</div>
		</div>
	@stop
@endif