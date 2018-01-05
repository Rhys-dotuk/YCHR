@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Document Upload</h1><hr>
	<img src="{{ asset('app/logo/'.$company->logo) }}" alt="{{ $company->company_name }} Logo" title="{{ $company->company_name }} Logo" style="width: 100px; top: 20px; right:60px; position: absolute;">
@stop

@section('content')
	<div class="col-xs-6" style="margin: 20px;">
        <div class="register-box-body">
			<form action="{{ route('file.store') }}" method="post" enctype="multipart/form-data">
			{!! csrf_field() !!}

				<div class="form-group">
                    <div>
						<input type="file" name="file" id="file">
                    </div>
                </div>

				<div class="form-group">
                    <div>
                        <select id="folder_name" name="folder_name" class="form-control">
							@if( Auth::user()->account_type == "Z" )
								<option value="public">Public</option>
								<option value="local">Local</option>
								<option value="company">Company</option>
								<option value="admin">Admin</option>
							@elseif( Auth::user()->account_type == "A" )
								<option value="local">Local</option>
								<option value="company">Company</option>
								<option value="admin">Admin</option>
							@else
								<option value="local">Local</option>
								<option value="company">Company</option>
							@endif
						</select> 
                    </div>
                </div>

				<input type="hidden" name="company_name" value="{{ Auth::user()->company_name }}">

				<input type="hidden" name="file_status" value="enabled">

				<input type="hidden" name="created_by" value="{{ Auth::user()->name }}">

				<input type="hidden" name="id" value="{{ Auth::user()->id }}">

				<button type="submit" class="btn btn-primary btn-block btn-flat">Upload</button>
			</form>
        </div>
	</div>
	<div>
		<div class="col-xs-4">
			<div class="well edit-form-group" style="background-color: #636B6F; color: #F5F8FA; margin: 20px;">
				<h4>Cancel</h4>
				<hr>
				<div class="row">
					<form action="{{ url()->previous() }}">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Back</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@stop