<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home')->middleware('auth:user,admin');

//Home Routes
Route::middleware('auth:user,admin')->group(function() {
    Route::get('/profile','HomeController@profile');
    Route::put('/profile', 'HomeController@updateProfile')->name('profile.update');
});

//Authentication Routes
Route::namespace('Auth')->group(function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
});

//Admin dashboard Routes
Route::middleware('check.admin')->group(function () {
    Route::get('admins', 'AdminController@index')->name('admin');
    Route::get('admins/search', 'AdminController@index')->name('admin.search');
    Route::get('admins/create', 'AdminController@create')->name('admin.create');
    Route::post('admins', 'AdminController@store')->name('admin.store');
    Route::get('admins/{admin}/edit', 'AdminController@edit')->name('admin.edit');
    Route::put('admins/{admin}', 'AdminController@update')->name('admin.update');
    Route::delete('admins/{admin}', 'AdminController@delete')->name('admin.delete');

    Route::get('users', 'UserController@index')->name('user');
    Route::get('users/search', 'UserController@index')->name('user.search');
    Route::get('users/create', 'UserController@create')->name('user.create');
    Route::post('users', 'UserController@store')->name('user.store');
    Route::get('users/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::put('users/{user}', 'UserController@update')->name('user.update');
    Route::delete('users/{user}', 'UserController@delete')->name('user.delete');

    Route::get('companies', 'CompanyController@index')->name('company');
    Route::get('companies/search', 'CompanyController@index')->name('company.search');
    Route::get('companies/create', 'CompanyController@create')->name('company.create');
    Route::post('companies', 'CompanyController@store')->name('company.store');
    Route::get('companies/{company}/edit', 'CompanyController@edit')->name('company.edit');
    Route::put('companies/{company}', 'CompanyController@update')->name('company.update');
    Route::delete('companies/{company}', 'CompanyController@delete')->name('company.delete');

    Route::get('devices', 'DeviceController@index')->name('device');
    Route::get('devices/search', 'DeviceController@index')->name('device.search');
    Route::get('devices/create', 'DeviceController@create')->name('device.create');
    Route::post('devices', 'DeviceController@store')->name('device.store');
    Route::get('devices/{device}/edit', 'DeviceController@edit')->name('device.edit');
    Route::put('devices/{device}', 'DeviceController@update')->name('device.update');
    Route::delete('devices/{device}', 'DeviceController@delete')->name('device.delete');

    Route::get('loan-devices','LoanDeviceController@index')->name('loan-device');
    Route::get('loan-devices/search', 'LoanDeviceController@index')->name('loan-device.search');
    Route::get('loan-devices/create', 'LoanDeviceController@create')->name('loan-device.create');
    Route::post('loan-devices', 'LoanDeviceController@store')->name('loan-device.store');
    Route::delete('loan-devices/{loanDevice}', 'LoanDeviceController@delete')->name('loan-device.delete');
    Route::put('loan-devices/{loanDevice}/release', 'LoanDeviceController@release')->name('loan-device.release');
});

//User dashboard Routes
Route::middleware('auth:user')->group(function () {
    Route::get('/company','UserDashboardController@showCompanyInformation')->name('user-dashboard.company');
    Route::get('/company/employees','UserDashboardController@showListEmployee')->name('user-dashboard.company.employees');
    Route::get('/company/employees/search','UserDashboardController@showListEmployee')->name('user-dashboard.company.employees.search');
    Route::get('/loan-device','UserDashboardController@showDeviceForUserLoan')->name('user-dashboard.loan-device');
    Route::post('/loan-device','UserDashboardController@createLoanForUser')->name('user-dashboard.loan-device.create');
    Route::get('/loan-device/history','UserDashboardController@showLoanDeviceHistory')->name('user-dashboard.loan-device.history');
});

Route::get('/home', function () {
    //dd(\Carbon\Carbon::parse(1593021725));
    //dd(\App\Models\User::whereYear('birthday', '==', ''))
    //$test = \App\Models\Device::all()->first();
    //return $test->users->map(function($val) {
    //    dd($val->pivot);
    //});

    //$test = \App\Models\Device::where('id', '92e28603-2ba1-4fad-91e4-e6233d84b77c')->first();
    return Auth::guard('user')->user();
});
