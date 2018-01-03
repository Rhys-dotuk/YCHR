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
    Route::get('YCHR/public/files/{company_name}/admin', 'FileController@admin')->name('file.admin');

    // Document area - company
    Route::get('YCHR/public/files/{company_name}/company', 'FileController@company')->name('file.company');

    // Document area - public
    Route::get('YCHR/public/files/open', 'FileController@open')->name('file.open');

    // Document area - local
    Route::get('YCHR/public/files/{name}/local', 'FileController@local')->name('file.local');

    // Document area - crud
    //Route::put('files/{file_name}/destroy', 'FileController@destroy')->name('file.destroy');
    Route::get('YCHR/public/files/{file_name}/download', 'FileController@download')->name('file.download');
    Route::post('YCHR/public/files/upload', 'FileController@store')->name('file.store');
    Route::get('YCHR/public/files/upload', 'FileController@upload')->name('file.upload');

    // Company area - admin only
    Route::put('YCHR/public/company/{company_name}/edit', 'CompanyController@update')->name('company.update');
    Route::get('YCHR/public/company/{company_name}/edit', 'CompanyController@edit')->name('company.edit');
    Route::put('YCHR/public/company/{company_name}', 'CompanyController@destroy')->name('company.destroy');
    Route::post('YCHR/public/company/create', 'CompanyController@store')->name('company.store');
    Route::get('YCHR/public/company/create', 'CompanyController@create')->name('company.create');

    // Company area - open
    Route::get('YCHR/public/company/{company_name}', 'CompanyController@show')->name('company.show');
    Route::get('YCHR/public/company', 'CompanyController@index')->name('company.index');

    // User area - admin only
    Route::put('YCHR/public/users/{id}', 'UserController@destroy')->name('users.destroy');
    Route::put('YCHR/public/users/{id}/edit', 'UserController@update')->name('users.update');
    Route::get('YCHR/public/users/{id}/edit', 'UserController@edit')->name('users.edit');
    Route::get('YCHR/public/users/{id}', 'UserController@show')->name('users.show');
    Route::get('YCHR/public/users', 'UserController@index')->name('users.index');

    // User area - open
    Route::put('YCHR/public/profile/{id}/edit', 'UserController@updateprofile')->name('users.updateprofile');
    Route::get('YCHR/public/profile/{id}/edit', 'UserController@editprofile')->name('users.editprofile');
    Route::get('YCHR/public/profile/{id}', 'UserController@profile')->name('users.profile');
    Route::get('YCHR/public/users/list/{company_name}', 'UserController@list')->name('users.list');

    // Open areas
    Route::get('YCHR/public/home', 'PagesController@getHome')->name('home');

    Route::get('YCHR/public/', function () 
    {
        return view('auth/login');
    });

    // Auth Routes
    Route::post('YCHR/public/enrole', 'EnroleController@storeEnrole')->name('user.storeEnrole');
    Route::get('YCHR/public/enrole', 'EnroleController@enrole')->name('user.enrole');

    Auth::routes();
}