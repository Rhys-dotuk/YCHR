<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Company;

class EnroleController extends Controller
{
	public function enrole()
    {
		return view('users.enrole');
    }
	
	public function storeEnrole(Request $request)
	{		
		$this->validate($request, array(
			'user_name' => 'required',
			'user_email' => 'required|unique:users,email',
			'user_password' => 'required',
			'company_name' => 'required|unique:companies,company_name',
			'company_email' => 'required|unique:companies,email',
		));

		$user = new User;
		$user->name = $request->input('user_name');
		$user->email = $request->input('user_email');
		$user->password = Hash::make($request->input('user_password'));
		$user->account_type = $request->input('user_account_type');
		$user->company_name = $request->input('company_name');
		$user->save();

		$company = new Company;
		$company->company_name = $request->input('company_name');
		$company->address = $request->input('company_address');
		$company->email = $request->input('company_email');
		$company->phone = $request->input('company_phone');
		$company->fax = $request->input('company_fax');
		$company->save();

		return redirect()->route('home');
	}
}