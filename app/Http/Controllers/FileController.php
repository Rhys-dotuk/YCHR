<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\File;
use App\User;
use App\Company;
use Mail;
use Session;
use Storage;

class FileController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function open()
	{
		$files = File::orderBy('created_at')->paginate(6);
		return view('file.open')->with('files', $files);
	}

	public function local()
	{
		$files = File::orderBy('created_at')->paginate(6);
		return view('file.local')->with('files', $files);
	}

	public function company($company_name)
  	{
		$files = File::orderBy('created_at')->paginate(6);
		return view('file.company')->with('files', $files);
  	}

	public function admin($company_name)
  	{
		$files = File::orderBy('created_at')->paginate(6);
		return view('file.admin')->with('files', $files);
	}
		 
	public function upload()
  	{
		return view('file.upload');
 	}

	public function store(Request $request)
	{
		$this->validate($request, array(
			'file' => 'required|file|mimes:jpeg,bmp,png,pdf,zip,doc,docx,txt',
		));

		$file = new File;
		$file->file_name = time().'-'.$request->file->getClientOriginalName();
		$file->file_type = $request->file->getClientOriginalExtension();
		$file->folder_name = $request->folder_name;
		$file->company_name = $request->company_name;
		$file->file_status = $request->file_status;
		$file->name = $request->created_by;
		$file->id = $request->id;
		$file->save();

		request()->file->move(storage_path('app/'.$file->folder_name), $file->file_name);

		return redirect()->route('file.upload');
	}

	public function download(Request  $request, $file_name)
	{
		$id = Auth::user()->id;
		$file = File::where('file_name', '=', $file_name)->first();
		$path = storage_path('app/'.$file->folder_name.'/'.$file->file_name);

		return response()->download($path);
	}

	/*
	public function destroy(Request  $request, $file_name)
	{
		$file = File::where('file_name', '=', $file_name)->first();
		$file->file_status = $request->input('file_status');
		$file->save();
		
		return redirect()->back();
	}
	*/
}