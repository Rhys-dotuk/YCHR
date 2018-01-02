@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>View Admin Files</h1><hr>
@stop

@section('content')
<div class="row">
	<div class="col-xs-6">
		<div class="box-header">
			<div class="box-tools">
				<div class="input-group input-group-sm" style="width: 150px; margin: 20px; left: 20px;">
					<input class="form-control" type="text" id="fileSearch" onkeyup="fileSearch()" placeholder="Search...">
					<span class="input-group-btn" style="bottom: 1px;">
						<button class="btn btn-indo btn-flat btn-primary glyphicon glyphicon-search" onkeyup="fileSearch()"></button>
					</span>
				</div>
			</div>
		</div>
		<div class="box-body table-responsive no-padding">
			<table id="tableRecords" class="table table-hover table-bordered table-striped" cellspacing="0"> 
				<tbody class="table table-hover">
					<tr>
						<th>File Name</th>
						<th>Created by</th>
						<th></th>
						<th></th>
					</tr>
					@foreach($files as $file)
						@if( Auth::user()->account_type != "U" && $file->company_name == Auth::user()->company_name && $file->folder_name == "admin")
							@if( $file->file_status == "disabled" )

							@else
								<tr>
									<td>{{ $file->file_name }}</td>
									<td>{{ $file->name }}</td>
									<td>
										<form action="{{ route('file.download', $file->file_name) }}" method="GET">
											{!! csrf_field() !!}
											<input type="hidden" name="file_name" value="$file->file_name">
											<button type="submit" class="btn btn-primary btn-block btn-flat">Download</button>
										</form>
									</td>
								</tr>
							@endif
						@else

						@endif
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-xs-4">
		<div class="well edit-form-group" style="background-color: #636B6F; color: #F5F8FA; margin: 20px;">
			<h4>Upload File</h4>
			<hr>
			<div class="row">
				<form action="{{ route('file.upload') }}">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Upload</button>
				</form>
			</div>
		</div>
	</div>
</div>
@stop
<script>
function fileSearch() 
{
	var searchText = document.getElementById('fileSearch').value; // Gets text entered into search bar
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