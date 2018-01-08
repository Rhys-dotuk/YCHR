@extends('adminlte::page')

@section('title', 'Dashboard')

@if (Auth::user()->id == $user->id)
	@section('content_header')
		<h1>Editing {{ $user->name }}'s Profile</h1><hr>
		<img src="{{ asset('app/logo/'.$company->logo) }}" alt="{{ $company->company_name }} Logo" title="{{ $company->company_name }} Logo" style="width: 100px; top: 20px; right:60px; position: absolute;">
	@stop

	@section('content')
		<div class="col-xs-10" style="left: 3px; width: 81.5%;">
			@if(Session::has('edit_successful'))
				<div class="alert alert-success" role="alert">
					<strong> Success: </strong> {{ Session::get('edit_successful') }}
				</div>
			@endif
		</div>
		<div class="col-xs-6" style="margin: 20px;">
			<div class="register-box-body">
				<form action="{{ route('users.editprofile', $user->id) }}" method="POST">
					{{ method_field('PUT') }}
					{!! csrf_field() !!}

					<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
						<label>Full Name</label>
						<input type="text" name="name" class="form-control" autocomplete="off" value="{{ $user->name }}" required autofocus> 
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
						@if ($errors->has('name'))
							<span class="help-block">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
						<label>Email</label>
						<input type="email" name="email" class="form-control" autocomplete="off" value="{{ $user->email }}" required>
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group has-feedback {{ $errors->has('address') ? 'has-error' : '' }}">
						<label>Address</label>
						<input type="text" name="address" class="form-control" autocomplete="off" value="{{ $user->address }}" autofocus>
						<span class="glyphicon glyphicon-home form-control-feedback"></span>
						@if ($errors->has('address'))
							<span class="help-block">
								<strong>{{ $errors->first('address') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group has-feedback {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
						<label>Mobile Number</label>
						<input type="text" name="mobile_no" class="form-control" autocomplete="off" value="{{ $user->mobile_no }}" autofocus>
						<span class="glyphicon glyphicon-phone form-control-feedback"></span>
						@if ($errors->has('mobile_no'))
							<span class="help-block">
								<strong>{{ $errors->first('mobile_no') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group has-feedback {{ $errors->has('telephone_no') ? 'has-error' : '' }}">
						<label>Telephone Number</label>
						<input type="text" name="telephone_no" class="form-control" autocomplete="off" value="{{ $user->telephone_no }}" autofocus>
						<span class="glyphicon glyphicon-phone form-control-feedback"></span>
						@if ($errors->has('telephone_no'))
							<span class="help-block">
								<strong>{{ $errors->first('telephone_no') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group has-feedback {{ $errors->has('dob') ? 'has-error' : '' }}">
						<label>Date of Birth</label>
						<input type="date" name="dob" class="form-control" autocomplete="off" value="{{ $user->dob }}" autofocus>
						<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
						@if ($errors->has('dob'))
							<span class="help-block">
								<strong>{{ $errors->first('dob') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group has-feedback {{ $errors->has('gender') ? ' has-error' : '' }}">
						<label>Gender</label>
						<span class="form-control-feedback"></span>
						<div>
							<select id="gender" name="gender" class="form-control" >
								<option value="male">Male</option>
								<option value="female">Female</option>
								<option value="other">Other</option>
							</select> 
						</div>
					</div>

					<div class="form-group has-feedback {{ $errors->has('marital_status') ? ' has-error' : '' }}">
						<label>Marital Status</label>
						<span class="form-control-feedback"></span>
						<div>
							<select id="marital_status" name="marital_status" class="form-control" >
								<option value="single">Single</option>
								<option value="married">married</option>
								<option value="seperated">Seperated</option>
								<option value="divorced">Divorced</option>
							</select> 
						</div>
					</div>

					

					<button type="submit" class="btn btn-primary btn-block btn-flat"> Update </button>
				</form>
			</div>
		</div>
		<div>
			<div class="col-xs-4">
				<div class="well edit-form-group" style="background-color: #636B6F; color: #F5F8FA; margin: 20px;">
					<h4>Further infomation</h4>
					<hr>
					<dl class="dl-horizontal">
						<label>Created at:</label>
						<p>{{ date( 'jS F, y', strtotime($user->created_at)) }}</p>
						<p>{{ date( 'h:ia', strtotime($user->created_at)) }}</p>
					</dl>
					<dl class="dl-horizontal">
						<label>Updated at:</label>
						<p>{{ date( 'jS F, y', strtotime($user->updated_at)) }}</p>
						<p>{{ date( 'h:ia', strtotime($user->updated_at)) }}</p>
					</dl>
					<div class="row">
						<form action="{{ route('users.password', Auth::user()->id) }}">
							<button type="submit" class="btn btn-primary btn-block btn-flat">Change Password</button>
						</form>
					</div>
					&emsp;
					<div class="row">
						<form action="{{ route('users.profile', Auth::user()->id) }}">
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
					<a href="{{ route('company.index') }}" class="btn btn-primary btn-block btn-flat" style="color: white;">Back</a>
				</div>
			</div>
		</div>
	@stop
@endif