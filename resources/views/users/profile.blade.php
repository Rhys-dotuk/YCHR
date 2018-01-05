@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Viewing {{ $user->name }}'s Profile</h1><hr>
	<img src="{{ asset('app/logo/'.$company->logo) }}" alt="{{ $company->company_name }} Logo" title="{{ $company->company_name }} Logo" style="width: 100px; top: 20px; right:60px; position: absolute;">
@stop

@section('content')
	<div class="row">
		<div class="col-xs-10" style="left: 3px; width: 81.5%;">
		@if(Session::has('edit_success'))
			<div class="alert alert-success" role="alert">
				<strong> Success: </strong> {{ Session::get('edit_success') }}
			</div>
		@endif
		</div>
		<div class="col-xs-6">
			<div class="box-header">
				<div class="box-tools">
					<div class="input-group input-group-sm" style="width: 150px; margin: 20px;">
						<div class="input-group-btn">

						</div>
					</div>
				</div>
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
					<form action="{{ route('users.editprofile', $user->id) }}">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Edit</button>
					</form>
					&emsp;
					<form action="{{ route('home') }}">
						<button type="submit" class="btn btn-warning btn-block btn-flat">Cancel</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@stop