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
    // Rutas Index
    Route::get('miscellaneous', 'SettingController@index')->name('miscellaneous');
    Route::get('bienvenido', 'AdminController@index')->name('bienvenido');

    // Rutas DataTable
    Route::get('listGrupo', "GroupsController@getList")->name('listGrupo');
    Route::get('listType', 'TypeController@TableType')->name('listType');
    Route::get('listCurso', 'CursoController@TableCurso')->name('listcurso');
    Route::get('listMethod', 'MethodController@TableMethod')->name('listMethod');
    Route::get('listComida', 'MenuController@TableComida')->name('listComida');
    Route::get('listSponsor', 'SponsorController@TableSponsor')->name('listSponsor');
    Route::get('listTag', 'TagController@TableTag')->name('listTag');
    Route::get('listHorario', 'HorarioController@TableHorario')->name('listHorario');

    // Rutas Select2
    Route::get('selectGrupo', 'GroupsController@SelectGrupo')->name('selectGrupo');
    Route::get('selectType', 'TypeController@selectType')->name('selectType');
    Route::get('selectTag', 'TagController@selectTag')->name('selectTag');

    // Rutas CRUD
    Route::resource('perfil', 'PerfilController');
    Route::resource('grupo', 'GroupsController');
    Route::resource('type', 'TypeController');
    Route::resource('curso', 'CursoController');
    Route::resource('method', 'MethodController');
    Route::resource('comida', 'MenuController');
    Route::resource('sponsor', 'Sponsorcontroller');
    Route::resource('publications', 'PublicationController');
    Route::resource('tags', 'TagController');
    Route::resource('horarios', 'HorarioController');

    Route::post('image', 'PerfilController@POSTimage')->name('image');
    Route::get('PDF/{id}', 'Menucontroller@PDF')->name('comida.pdf');
    Route::post('actualizar/{id}', 'SponsorController@update')->name('sponsor.act');
    Route::put('change/{id}', 'PublicationController@change')->name('publications.change');
    Route::post('publications/actualizar/{id}', 'PublicationController@update')->name('publication.act');
    Route::get('document/{id}', 'HorarioController@HorarioDownload')->name('documentDownload');
});
