@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
	<h1>View Users</h1><hr>
	<img src="{{ asset('app/logo/'.$company->logo) }}" alt="{{ $company->company_name }} Logo" title="{{ $company->company_name }} Logo" style="width: 100px; top: 20px; right:60px; position: absolute;">
@stop

@section('content')
	<div class="row">
		<div class="col-xs-10" style="left: 3px; width: 81.5%;">
			@if(Session::has('destroy_success'))
				<div class="alert alert-danger" role="alert">
					<strong> Success: </strong> {{ Session::get('destroy_success') }}
				</div>
			@endif
		</div>
		<div class="col-xs-6">
			<div class="box-header">
				<div class="box-tools">
				</div>
			</div>
			<div class="box-body table-responsive no-padding">
				<table id="tableRecords" class="table table-hover table-bordered table-striped" cellspacing="0">
					<thead class="table table-hover">
						<tr>
							<th>Name</th>
							<th>Email</th>
							@if(Auth::user()->account_type == 'A')
							<th></th>
							<th></th>
							@else
							@endif
						</tr>
					</thead> 
					<tbody class="table table-hover">
						@foreach($users as $user)
							<tr>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								@if(Auth::user()->account_type == 'A')
									<td width="80px">
										<form action="{{ route('users.show', $user->id) }}">
											<button type="submit" class="btn btn-primary btn-flat">View</button>
										</form>
									</td>
									<td width="80px">
										<form action="{{ route('users.edit', $user->id) }}">
											<button type="submit" class="btn btn-primary btn-flat">Edit</button>
										</form>
									</td>
								@else

								@endif
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-xs-4">
			<div class="well edit-form-group" style="background-color: #636B6F; color: #F5F8FA; margin: 20px;">
				<h4>Create New User</h4>
				<hr>
				<div class="row">
					<form action="{{ route('register') }}">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Create</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@stop
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">

	$(document).ready(function() {
		$('#tableRecords').DataTable({
			bFilter: true,
			bInfo: true,
			bPaginate: true,
			"iDisplayLength": 6,
			"deferRender": true,
		});
	});

</script>