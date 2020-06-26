<?php

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
});

Route::get('/home', function () {
    //dd(\Carbon\Carbon::parse(1593021725));
    //dd(\App\Models\User::whereYear('birthday', '==', ''))
});
