@extends('adminlte::page')

@section('title', 'Dashboard')

@if (Auth::user()->company_name == $company->company_name || Auth::user()->account_type == "Z")
	@section('content_header')
		<h1>Viewing {{ $company->company_name }}'s Profile</h1><hr>
	@stop

	@section('content')
		<div class="row">
			<div class="col-xs-10" style="left: 3px; width: 81.5%;">
				@if(Session::has('edit_success'))
					<div class="alert alert-danger" role="alert">
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
								<td>{{ $company->company_name }}</td>
							</tr>
							<tr>
								<th>Address:</th>
								<td>{{ $company->address }}</td>
							</tr>
							<tr>
								<th>Email:</th>
								<td>{{ $company->email }}</td>
							</tr>
							<tr>
								<th>Phone:</th>
								<td>{{ $company->phone }}</td>
							</tr>
							<tr>
								<th>FAX:</th>
								<td>{{ $company->fax }}</td>
							</tr>
							<tr>
								<th>Logo File:</th>
								<td>{{ $company->logo }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-xs-4">
				<div class="well edit-form-group" style="background-color: #636B6F; color: #F5F8FA; margin: 20px;">
					<h4>Further Infomation</h4>
					<hr>
					<dl class="dl-horizontal">
						<label>Created at:</label>
						<p>{{ date( 'jS F, y', strtotime($company->created_at)) }}</p>
						<p>{{ date( 'h:ia', strtotime($company->created_at)) }}</p>
					</dl>
					<dl class="dl-horizontal">
						<label>Updated at:</label>
						<p>{{ date( 'jS F, y', strtotime($company->updated_at)) }}</p>
						<p>{{ date( 'h:ia', strtotime($company->updated_at)) }}</p>
					</dl>
					<div class="row">
						@if (Auth::user()->account_type == 'U')

						@elseif (Auth::user()->account_type == 'A')
							<form action="{{ route('company.edit', $company->company_name) }}">
								<button type="submit" class="btn btn-primary btn-block btn-flat">Edit</button>
							</form>
						@else
							<form action="{{ route('company.edit', $company->company_name) }}">
								<button type="submit" class="btn btn-primary btn-block btn-flat">Edit</button>
							</form>
							&emsp;
							<form action="{{ route('company.index') }}">
								<button type="submit" class="btn btn-warning btn-block btn-flat">Cancel</button>
							</form>
						@endif
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