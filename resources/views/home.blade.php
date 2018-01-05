@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
	<h1>{{ Auth::user()->name }}'s Dashboard</h1><hr>
	<img src="{{ asset('app/logo/'.$company->logo) }}" alt="{{ $company->company_name }} Logo" title="{{ $company->company_name }} Logo" style="width: 100px; top: 20px; right:60px; position: absolute;">
@stop

@section('content')
	<div class="col-xs-6" style="margin: 20px;">
	</div>
	<div class="row">
		<div class="col-xs-4">
			<div class="well edit-form-group" style="background-color: #636B6F; color: #F5F8FA; margin: 20px;">
				<h4>New Company Files</h4>
				<hr>
				<dl class="dl-horizontal">
					<table> 
						<tr>
							<th>File Name</th>
						</tr>
						@foreach($files as $file)
							@if( $file->file_status == "disabled" )

							@else
							<tr style="left: 10px;">
								<td>
									<form action="{{ route('file.download', $file->file_name) }}" method="GET">
										{!! csrf_field() !!}
										<input type="hidden" name="file_name" value="$file->file_name">
										<button type="submit" style="background-color: #636B6F; border: none; margin-bottom: 10px;">{{ $file->file_name }}</button>
									</form>
								</td>
							</tr>
							@endif
						@endforeach
					</table>
				</dl>
			</div>
		</div>
	</div>
@stop