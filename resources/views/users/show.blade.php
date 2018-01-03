@extends('adminlte::page')

@section('title', 'HRMS - User Profile')

@if (Auth::user()->account_type == 'Z' || Auth::user()->account_type == 'A' && Auth::user()->company_name == $user->company_name)
	@section('content_header')
		<h1>Viewing {{ $user->name }}'s Profile</h1><hr>
	@stop

	@section('content')
		<div class="row">
			<div class="col-xs-6">
				<div class="box-header">
				</div>
				<div class="box-body no-padding">
					<table id="tableRecords" class="table table-bordered table-striped" cellspacing="0"> 
						<tbody class="table table-hover">
							<tr>
								<th>Name:</th>
								<td>{{ $user->name }}</td>
							</tr>
							<tr>
								<th>Email:</th>
								<td>{{ $user->email }}</td>
							</tr>
							<tr>
								<th>Address:</th>
								<td>{{ $user->address }}</td>
							</tr>
							<tr>
								<th>Mobile Number:</th>
								<td>{{ $user->mobile_no }}</td>
							</tr>
							<tr>
								<th>Telephone Number:</th>
								<td>{{ $user->telephone_no }}</td>
							</tr>
							<tr>
								<th>Date of Birth:</th>
								<td>{{ $user->dob }}</td>
							</tr>
							<tr>
								<th>Start Date:</th>
								<td>{{ $user->start_date }}</td>
							</tr>
							<tr>
								<th>Leave Date:</th>
								<td>{{ $user->leave_date }}</td>
							</tr>
							<tr>
								<th>Gender:</th>
								<td>{{ $user->gender }}</td>
							</tr>
							<tr>
								<th>Marital Status:</th>
								<td>{{ $user->marital_status }}</td>
							</tr>
							<tr>
								<th>Account Status:</th>
								<td>{{ $user->account_status }}</td>
							</tr>
							<tr>
								<th>Account Type:</th>
								@if($user->account_type == "U")
									<td>User</td>
								@elseif($user->account_type == "A")
									<td>Admin</td>
								@else
									<td>God</td>
								@endif
							</tr>
						</tbody>
					</table>
				</div>
			</div>
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
						<form action="{{ route('users.edit', $user->id) }}">
							<button type="submit" class="btn btn-primary btn-block btn-flat">Edit</button>
						</form>
						&emsp;
						<form action="{{ route('users.index') }}">
							<button type="submit" class="btn btn-warning btn-block btn-flat">Cancel</button>
						</form>
						&emsp;
						<form action="{{ route('users.destroy', $user->id) }}" method="POST">
							{{ method_field('PUT') }}
							{!! csrf_field() !!}
							<input type="hidden" name="account_status" value="disabled">
							<button type="submit" class="btn btn-danger btn-block btn-flat">Delete</button>
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