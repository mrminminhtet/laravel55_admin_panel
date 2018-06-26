<?php

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

Route::get('/', 'WebController@homePage');
Route::get('admin', 'AdminAuth\LoginController@showLoginForm')->name('login');
Route::get('login', 'AdminAuth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'AdminAuth\LoginController@login');

Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');
Route::get('admin/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');

Route::group(['prefix' => 'admin'], function () {
  // Route::post('/login', 'AdminAuth\LoginController@login');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');

  Route::get('user-lists','adminController@index')->name('users.index');
  Route::get('change/user-status','adminController@chaneUserStatus');
  Route::get('user/create','adminController@create');
  Route::post('user/create','adminController@store');
  Route::get('user/{id}/edit','adminController@edit');
  Route::post('user/{id}/edit','adminController@update');
  Route::post('user/{id}','adminController@destroy');

  Route::resource('roles', 'RoleController');

  Route::resource('permissions', 'PermissionController');
});
