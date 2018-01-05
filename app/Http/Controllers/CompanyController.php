<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Company;
use App\File;
use App\User;
use Storage;
use Session;

class CompanyController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
		$user = Auth::user();
		$companies = Company::orderBy('created_at')->paginate(6);
		$company = Company::where('company_name', '=', $user->company_name)->first();
		
		return view('company.index')->with('companies', $companies)->with('user', $user)->with('company', $company);
	}
	
	public function upload()
	{
		$company = Company::where('company_name', '=', $user->company_name)->first();

		return view('company.upload')->with('company', $company);
	}

	public function storeUpload(Request $request)
	{
		$this->validate($request, array(
			'file' => 'required|file|mimes:jpeg,png|max:10240',
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

		return redirect()->route('company.edit', ['company_name' => $request->company_name]);
	}

	public function create()
	{
		$company = Company::where('company_name', '=', $user->company_name)->first();

		return view('company.create')->with('company', $company);
	}

	public function show($company_name)
    {
		$company = Company::where('company_name', '=', $company_name)->first();
		
		return view('company.show')->with('company', $company);
    }

    public function edit($company_name)
    {
		$company = Company::where('company_name', '=', $company_name)->first();

		$files = File::where('folder_name', '=', 'logo')->get();

		return view('company.edit')->with('company', $company)->with('files', $files);
    }

	public function store(Request $request)
	{
		$this->validate($request, array(
			'company_name' => 'required|unique:companies,company_name',
			'email' => 'required|unique:companies,email',
		));

		$company = new Company;
		$company->company_name = $request->input('company_name');
		$company->address = $request->input('address');
		$company->email = $request->input('email');
		$company->phone = $request->input('phone');
		$company->fax = $request->input('fax');
		$company->logo = $request->input('logo');
		$company->save();

		Session::flash('edit_success', 'Account successfully updated');
		return redirect()->route('company.show', $company->company_name);
	}

    public function update(Request $request, $company_name)
    {
		$company = Company::where('company_name', '=', $company_name)->first();

		if ($request->input('company_name') != $company_name) {
			$this->validate($request, array(
			'company_name' => 'required|unique:companies,company_name',
		));
		} elseif ($request->input('email') != $company->email) {
			$this->validate($request, array(
			'email' => 'required|unique:companies,email',
		));
		}

		$company = Company::where('company_name', '=', $company_name)->first();
		$company->company_name = $request->input('company_name');
		$company->address = $request->input('address');
		$company->email = $request->input('email');
		$company->phone = $request->input('phone');
		$company->fax = $request->input('fax');
		$company->logo = $request->input('logo');
		$company->save();

		return redirect()->route('company.show', $company->company_name);
    }

	public function destroy(Request $request, $company_name)
	{
		$company = Company::where('company_name', '=', $company_name)->first();

		$company->status = $request->input('status');
		$company->save();

		return redirect()->route('company.index');
	}
}
