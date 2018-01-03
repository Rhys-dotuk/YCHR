<?php

$environment = App::environment();

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if (App::environment('local')) {

    // Document area - admin
    Route::get('files/{company_name}/admin', 'FileController@admin')->name('file.admin');

    // Document area - company
    Route::get('files/{company_name}/company', 'FileController@company')->name('file.company');

    // Document area - public
    Route::get('files/open', 'FileController@open')->name('file.open');

    // Document area - local
    Route::get('files/{name}/local', 'FileController@local')->name('file.local');

    // Document area - crud
    //Route::put('files/{file_name}/destroy', 'FileController@destroy')->name('file.destroy');
    Route::get('files/{file_name}/download', 'FileController@download')->name('file.download');
    Route::post('files/upload', 'FileController@store')->name('file.store');
    Route::get('files/upload', 'FileController@upload')->name('file.upload');

    // Company area - admin only
    Route::put('company/{company_name}/edit', 'CompanyController@update')->name('company.update');
    Route::get('company/{company_name}/edit', 'CompanyController@edit')->name('company.edit');
    Route::put('company/{company_name}', 'CompanyController@destroy')->name('company.destroy');
    Route::post('company/create', 'CompanyController@store')->name('company.store');
    Route::get('company/create', 'CompanyController@create')->name('company.create');

    // Company area - open
    Route::get('company/{company_name}', 'CompanyController@show')->name('company.show');
    Route::get('company', 'CompanyController@index')->name('company.index');

    // User area - admin only
    Route::put('users/{id}', 'UserController@destroy')->name('users.destroy');
    Route::put('users/{id}/edit', 'UserController@update')->name('users.update');
    Route::get('users/{id}/edit', 'UserController@edit')->name('users.edit');
    Route::get('users/{id}', 'UserController@show')->name('users.show');
    Route::get('users', 'UserController@index')->name('users.index');

    // User area - open
    Route::put('profile/{id}/edit', 'UserController@updateprofile')->name('users.updateprofile');
    Route::get('profile/{id}/edit', 'UserController@editprofile')->name('users.editprofile');
    Route::get('profile/{id}', 'UserController@profile')->name('users.profile');
    Route::get('users/list/{company_name}', 'UserController@list')->name('users.list');

    // Open areas
    Route::get('home', 'PagesController@getHome')->name('home');

    Route::get('/', function () 
    {
        return view('auth/login');
    });

    // Auth Routes
    Route::post('enrole', 'EnroleController@storeEnrole')->name('user.storeEnrole');
    Route::get('enrole', 'EnroleController@enrole')->name('user.enrole');

    Auth::routes();

} elseif (App::environment('live')) { 

    // Document area - admin
    Route::get('public/files/{company_name}/admin', 'FileController@admin')->name('file.admin');

    // Document area - company
    Route::get('public/files/{company_name}/company', 'FileController@company')->name('file.company');

    // Document area - public
    Route::get('public/files/open', 'FileController@open')->name('file.open');

    // Document area - local
    Route::get('public/files/{name}/local', 'FileController@local')->name('file.local');

    // Document area - crud
    //Route::put('files/{file_name}/destroy', 'FileController@destroy')->name('file.destroy');
    Route::get('public/files/{file_name}/download', 'FileController@download')->name('file.download');
    Route::post('public/files/upload', 'FileController@store')->name('file.store');
    Route::get('public/files/upload', 'FileController@upload')->name('file.upload');

    // Company area - admin only
    Route::put('public/company/{company_name}/edit', 'CompanyController@update')->name('company.update');
    Route::get('public/company/{company_name}/edit', 'CompanyController@edit')->name('company.edit');
    Route::put('public/company/{company_name}', 'CompanyController@destroy')->name('company.destroy');
    Route::post('public/company/create', 'CompanyController@store')->name('company.store');
    Route::get('public/company/create', 'CompanyController@create')->name('company.create');

    // Company area - open
    Route::get('public/company/{company_name}', 'CompanyController@show')->name('company.show');
    Route::get('public/company', 'CompanyController@index')->name('company.index');

    // User area - admin only
    Route::put('public/users/{id}', 'UserController@destroy')->name('users.destroy');
    Route::put('public/users/{id}/edit', 'UserController@update')->name('users.update');
    Route::get('public/users/{id}/edit', 'UserController@edit')->name('users.edit');
    Route::get('public/users/{id}', 'UserController@show')->name('users.show');
    Route::get('public/users', 'UserController@index')->name('users.index');

    // User area - open
    Route::put('public/profile/{id}/edit', 'UserController@updateprofile')->name('users.updateprofile');
    Route::get('public/profile/{id}/edit', 'UserController@editprofile')->name('users.editprofile');
    Route::get('public/profile/{id}', 'UserController@profile')->name('users.profile');
    Route::get('public/users/list/{company_name}', 'UserController@list')->name('users.list');

    // Open areas
    Route::get('public/home', 'PagesController@getHome')->name('home');

    Route::get('public/', function () 
    {
        return view('auth/login');
    });

    // Auth Routes
    Route::post('public/enrole', 'EnroleController@storeEnrole')->name('user.storeEnrole');
    Route::get('public/enrole', 'EnroleController@enrole')->name('user.enrole');

    Auth::routes();
}