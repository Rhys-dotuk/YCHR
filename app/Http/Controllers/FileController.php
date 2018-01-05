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
		$company = Company::where('company_name', '=', Auth::user()->company_name)->first();

		return view('file.open')->with('files', $files)->with('company', $company);
	}

	public function local()
	{
		$files = File::orderBy('created_at')->paginate(6);
		$company = Company::where('company_name', '=', Auth::user()->company_name)->first();

		return view('file.local')->with('files', $files)->with('company', $company);
	}

	public function company($company_name)
  	{
		$files = File::orderBy('created_at')->paginate(6);
		$company = Company::where('company_name', '=', Auth::user()->company_name)->first();

		return view('file.company')->with('files', $files)->with('company', $company);
  	}

	public function admin($company_name)
  	{
		$files = File::orderBy('created_at')->paginate(6);
		$company = Company::where('company_name', '=', Auth::user()->company_name)->first();

		return view('file.admin')->with('files', $files)->with('company', $company);
	}
		 
	public function upload()
  	{
		$company = Company::where('company_name', '=', Auth::user()->company_name)->first();

		return view('file.upload')->with('company', $company);
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

		request()->file->move(public_path('app/'.$file->folder_name), $file->file_name);

		return redirect()->back();
	}

	public function download(Request  $request, $file_name)
	{
		$id = Auth::user()->id;
		$file = File::where('file_name', '=', $file_name)->first();
		$path = public_path('app/'.$file->folder_name.'/'.$file->file_name);

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