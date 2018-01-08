<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Company;
use Session;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
		$users = User::orderBy('company_name')->paginate(6);
		$company = Company::where('company_name', '=', Auth::user()->company_name)->first();

		return view('users.index')->with('users', $users)->with('company', $company);
    }

	public function list($company_name)
    {
		$auth = Auth::user();
		$users = User::where('company_name', '=', $company_name)->get();
		$company = Company::where('company_name', '=', Auth::user()->company_name)->first();

		return view('users.list')->with('users', $users)->with('auth', $auth)->with('company', $company);
    }

    public function show($id)
    {
		$user = User::find($id);
		$company = Company::where('company_name', '=', Auth::user()->company_name)->first();

        return view('users.show')->with('user', $user)->with('company', $company);
    }

    public function edit($id)
    {
		$user = User::find($id);
		$company = Company::where('company_name', '=', Auth::user()->company_name)->first();

        return view('users.edit')->with('user', $user)->with('company', $company);
    }

	public function profile($id)
    {
		$user = Auth::user();
		$company = Company::where('company_name', '=', Auth::user()->company_name)->first();

        return view('users.profile')->with('user', $user)->with('company', $company);
    }

	public function editprofile($id)
    {
		$user = Auth::user();
		$company = Company::where('company_name', '=', Auth::user()->company_name)->first();

        return view('users.editprofile')->with('user', $user)->with('company', $company);
    }

	public function password($id)
	{
		$user = Auth::user();
		
        return view('users.password')->with('user', $user);
	}

	public function passwordUpdate(Request $request, $id)
	{
		$this->validate($request, array(
			'current_password' => 'required',
			'new_password' => 'required',
			'confirm_password' => 'required',
		));

		if ( !(Hash::check($request->input('current_password'), Auth::user()->password)) ) {

			$user = Auth::user();

			Session::flash('edit_unsuccessful', 'Password change was unsuccessful');
			return view('users.password')->with('user', $user);
			
		} elseif ( ($request->input('new_password')) != ($request->input('confirm_password')) ) {

			$user = Auth::user();

			Session::flash('edit_unsuccessful', 'New passwords did not match');
			return view('users.password')->with('user', $user);

		} else {

			$user = User::find($id);
			$user->password = Hash::make($request->input('new_password'));
			$user->save();

			Session::flash('edit_successful', 'Password change was successful');
			return redirect()->route('users.editprofile', $id);
		}
	}

	public function update(Request $request, $id)
	{
		$user = User::find($id);

		if ($request->input('email') == $user->email) {
			$this->validate($request, array(
			'name' => 'required',
			'account_type' => 'required',
		));
		} else {
			$this->validate($request, array(
			'name' => 'required',
			'email' => 'required|unique:users',
			'account_type' => 'required',
		));
		}

		$user = User::find($id);
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->address = $request->input('address');
		$user->mobile_no = $request->input('mobile_no');
		$user->telephone_no = $request->input('telephone_no');
		$user->dob = $request->input('dob');
		$user->start_date = $request->input('start_date');
		$user->leave_date = $request->input('leave_date');
		$user->gender = $request->input('gender');
		$user->marital_status = $request->input('marital_status');
		$user->account_type = $request->input('account_type');
		$user->save();

		Session::flash('edit_success', 'Account successfully updated');
		return redirect()->route('users.show', $user->id);
	}

	public function updateProfile(Request $request, $id)
	{
		$user = User::find($id);

		if ($request->input('email') == $user->email) {
			$this->validate($request, array(
			'name' => 'required',
		));
		} else {
			$this->validate($request, array(
			'name' => 'required',
			'email' => 'required|unique:users',
		));
		}

		$user = User::find($id);
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->address = $request->input('address');
		$user->mobile_no = $request->input('mobile_no');
		$user->telephone_no = $request->input('telephone_no');
		$user->dob = $request->input('dob');
		$user->start_date = $request->input('start_date');
		$user->leave_date = $request->input('leave_date');
		$user->gender = $request->input('gender');
		$user->marital_status = $request->input('marital_status');
		$user->save();

		Session::flash('edit_success', 'Account successfully updated');
		return redirect()->route('users.profile', $user->id);
	}

	public function destroy(Request $request, $id)
	{
		$user = User::find($id);
		$user->account_status = $request->input('account_status');
		$user->save();

		Session::flash('destroy_success', 'Account successfully removed');
		return redirect()->route('users.index');
	}
}