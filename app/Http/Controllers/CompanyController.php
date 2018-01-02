<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Company;
use App\User;

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
		return view('company.index')->with('companies', $companies)->with('user', $user);
    }

	public function create()
	{
		return view('company.create');
	}

	public function show($company_name)
    {
	    $company = Company::where('company_name', '=', $company_name)->first();
		return view('company.show')->with('company', $company);
    }

    public function edit($company_name)
    {
		$company = Company::where('company_name', '=', $company_name)->first();
		return view('company.edit')->with('company', $company);
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
		$company->save();

		return redirect()->route('company.show', $company->company_name);
	}

    public function update(Request $request, $company_name)
    {
		$company = Company::where('company_name', '=', $company_name)->first();

		if ($request->input('email') == $company->email) {
			$this->validate($request, array(
			'company_name' => 'required|unique:companies,company_name',
		));
		} else {
			$this->validate($request, array(
			'company_name' => 'required|unique:companies,company_name',
			'email' => 'required|unique:companies,email',
		));
		}

		$company = Company::where('company_name', '=', $company_name)->first();
		$company->name = $request->input('company_name');
		$company->address = $request->input('address');
		$company->email = $request->input('email');
		$company->phone = $request->input('phone');
		$company->fax = $request->input('fax');
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
