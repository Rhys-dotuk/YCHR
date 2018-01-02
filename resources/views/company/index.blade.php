@extends('adminlte::page')

@section('title', 'Dashboard')

@if (Auth::user()->account_type == 'Z')
	@section('content_header')
		<h1>View Companies</h1><hr>
	@stop

	@section('content')
		<div class="row">
			<div class="col-xs-6">
				<div class="box-header">
					<div class="box-tools">
						<div class="input-group input-group-sm" style="width: 150px; margin: 20px;">
							<input class="form-control" type="text" id="companySearch" onkeyup="companySearch()" placeholder="Search...">
							<span class="input-group-btn" style="bottom: 1px;">
								<button class="btn btn-indo btn-flat btn-primary glyphicon glyphicon-search" onkeyup="companySearch()"></button>
							</span>
						</div>
					</div>
				</div>
				<div class="box-body table-responsive no-padding">
					<table id="tableRecords" class="table table-hover table-bordered table-striped" cellspacing="0"> 
						<tbody class="table table-hover">
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th></th>
								<th></th>
							</tr>
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
	<script>

	function companySearch() 
	{
		var searchText = document.getElementById('companySearch').value; // Gets text entered into search bar
		var targetTable = document.getElementById('tableRecords'); // Gets table data
		var targetTableColCount;
            
		for (var rowIndex = 0; rowIndex < targetTable.rows.length; rowIndex++) { // Loops through each table row
			var rowData = '';

			if (rowIndex == 0) {
			   targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
			   continue;
			}
                
			for (var colIndex = 0; colIndex < targetTableColCount; colIndex++) {
				rowData += targetTable.rows.item(rowIndex).cells.item(colIndex).textContent; // Loops through table column
			}

			if (rowData.indexOf(searchText) == -1) // If data equals search -
			{
				targetTable.rows.item(rowIndex).style.display = 'none'; // - display row
			} else {
				targetTable.rows.item(rowIndex).style.display = 'table-row'; // - hide row
			}
		}
	}
	</script>
@else
	<script type="text/javascript">
		window.location = "{{ route('company.show', Auth::user()->company_name) }}";
	</script>
@endif