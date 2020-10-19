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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');


// --- 自作
Route::post('register_check', 'Auth\RegisterController@registerCheck');
Route::post('register_add', 'Auth\RegisterController@registerAdd');
Route::get('register_done', 'Auth\RegisterController@registerDone');

Route::get('forget_pass', 'AssistController@forgetPass'); //
Route::get('reset_pass', 'AssistController@resetPass');
Route::post('reset_pass', 'AssistController@passAction');
Route::get('pass_done', 'DoneController@forgetPass');

// home
Route::middleware('auth')->prefix('home')->name('home')->group(function () {
    Route::get('', 'HomeController@index')->name('');
});

// modal
Route::middleware('auth')->prefix('modal')->name('modal')->group(function () {
    Route::get('kubun', 'AjaxController@getKubun')->name('nomal');
});


// users
Route::middleware('auth')->prefix('users')->name('users')->group(function () {
    // edit account
    Route::get('account', 'UserController@account')->name('/account'); //

    // Route::resource('', 'UserController');

    // --- show
    Route::get('show', 'UserController@show')->name('/show');

    // u edit
    Route::get('edit', 'UserController@edit')->name('/edit'); //
    Route::post('edit_check', 'UserController@editCheck')->name('/edit_check');
    Route::post('update', 'UserController@update')->name('/update');

    // e password
    Route::get('password', 'UserController@password')->name('/password'); //
    Route::post('password_check', 'UserController@passwordUpdate')->name('/password_check');

    // e delete
    Route::get('delete', 'UserController@delete')->name('/delete'); //
    Route::get('fort', 'UserController@fort')->name('/fort'); //
    // deleteした時に名前を"xxx_id_deleted"へupdateする機能を追加する
    Route::post('destroy', 'UserController@destroy')->name('/destroy');
});

// items
Route::middleware('auth')->prefix('items')->name('items')->group(function () {
    Route::get('index', 'ItemController@index')->name('/index');

    Route::post('store', 'ItemController@store')->name('/store');


    // u edit
    Route::get('edit', 'ItemController@edit'); //
    Route::post('edit', 'ItemController@editCheck');
    Route::post('update', 'ItemController@ItemUpdate');

    // e delete
    Route::get('delete', 'ItemController@delete'); //
    Route::get('fort', 'ItemController@fort'); //
    // deleteした時に名前を"xxx_id_deleted"へupdateする機能を追加する
    Route::post('delete', 'ItemController@deleteAction');
});


Route::get('users/done', 'DoneController@usersEdit');
Route::get('users/password/done', 'DoneController@usersPassword');
Route::get('users/delete/done', 'DoneController@usersDelete');
Route::get('users/leave/done', 'DoneController@usersLeave');
