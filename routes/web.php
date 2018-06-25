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

Route::get('/', 'HomeController@index')->name('index');
Route::get('getRoles', 'HomeController@getRoles')->name('getRoles');
Route::get('registro', 'HomeController@create')->name('index');
Route::post('store', 'HomeController@store')->name('store');
Route::get('users/{name}', 'HomeController@getuser')->name('getusers');
Route::get('email/{correo}', 'Homecontroller@getemail')->name('getemail');
Route::get('school/{key}', 'Homecontroller@getkey')->name('getkey');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix'=>'admin'], function(){
   Route::get('bienvenido', 'AdminController@welcome')->name('bienvenido');
   Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');

});
