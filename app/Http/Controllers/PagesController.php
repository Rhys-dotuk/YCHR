<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Company;
use App\File;


class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getHome()
    {
		$user = Auth::user();
		$company = Company::where('company_name', '=', $user->company_name)->get();
		$files = File::where('company_name', '=', $user->company_name)->orderBy('created_at')->limit(4)->get();
        return view('home')->with('user', $user)->with('company', $company)->with('files', $files);
    }
}
