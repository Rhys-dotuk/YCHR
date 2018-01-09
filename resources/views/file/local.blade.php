@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
	<h1>View Local Files</h1><hr>
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
					<thead class="table table-records">
						<tr>
							<th>File Name</th>
							<th>Created by</th>
							<th></th>
							<th></th>
						</tr>
					</thead> 
					<tbody class="table table-hover">
						@foreach($files as $file)
							@if( $file->id == Auth::user()->id )
								<tr>
									<td>{{ $file->file_name }}</td>
									<td>{{ $file->name }}</td>
									<td>
										<form action="{{ route('mail.send', [ 'file_name' => $file->file_name, 'id' => Auth::user()->id ]) }}" method="GET">
											{!! csrf_field() !!}
											<input type="hidden" name="file_name" value="$file->file_name">
											<button type="submit" class="btn btn-primary btn-block btn-flat">Download</button>
										</form>
									</td>
									<td>
										<form action="{{ route('file.destroy', [ 'file_id' => $file->file_id]) }}" method="POST">
											{{ method_field('PUT') }}
											{!! csrf_field() !!}
											<button type="submit" class="btn btn-danger btn-block btn-flat">Delete</button>
										</form>
									</td>
								</tr>
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