@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
	<h1>View Companies</h1><hr>
	<img src="{{ asset('app/logo/'.$company->logo) }}" alt="{{ $company->company_name }} Logo" title="{{ $company->company_name }} Logo" style="width: 100px; top: 20px; right:60px; position: absolute;">
@stop

@section('content')
	<div class="row">
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
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody class="table table-hover">
						@foreach($companies as $company)
							@if( $company->status == "disabled" )

							@else
								<tr id="results">
									<td>{{ $company->company_name }}</td>
									<td>{{ $company->email }}</td>
									<td width="80px">
										<form action="{{ route('company.show', $company->company_name) }}">
											<button type="submit" class="btn btn-primary btn-flat">View</button>
										</form>
									</td>
									<td width="80px">
										<form action="{{ route('company.edit', $company->company_name) }}">
											<button type="submit" class="btn btn-primary btn-block btn-flat">Edit</button>
										</form>
									</td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
				{{ $companies->links() }}
			</div>
		</div>
		<div class="col-xs-4">
			<div class="well edit-form-group" style="background-color: #636B6F; color: #F5F8FA; margin: 20px;">
				<h4>Create New Company</h4>
				<hr>
				<div class="row">
					<form action="{{ route('company.create') }}">
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