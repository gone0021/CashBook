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

// ajax
Route::middleware('auth')->prefix('ajax')->name('ajax')->group(function () {
    Route::get('category', 'AjaxController@getCategory');
    Route::get('category_by_account', 'AjaxController@getCategoryByAccountType');
    Route::get('category_income', 'AjaxController@getCategoryIncome');
    Route::get('category_expense', 'AjaxController@getCategoryExpense');
    Route::get('kubun', 'AjaxController@getKubun');
    Route::get('kubun_by_category', 'AjaxController@getKubunByCategoryIdGet');
});


// users
Route::middleware('auth')->prefix('users')->name('users')->group(function () {
    // edit account
    Route::get('index', 'UserController@account')->name(''); //

    // show
    Route::get('show', 'UserController@show')->name('/show');

    // edit
    Route::get('edit', 'UserController@edit')->name('/edit'); //
    Route::post('edit_check', 'UserController@editCheck')->name('/edit_check');
    Route::post('update', 'UserController@update')->name('/update');

    // password
    Route::get('password', 'UserController@password')->name('/password'); //
    Route::post('password_check', 'UserController@passwordUpdate')->name('/password_check');

    // delete
    Route::get('delete', 'UserController@delete')->name('/delete'); //
    Route::get('fort', 'UserController@fort')->name('/fort'); //
    // deleteした時に名前を"xxx_id_deleted"へupdateする機能を追加する
    Route::post('destroy', 'UserController@destroy')->name('/destroy');
});

// admin
Route::middleware('auth')->prefix('admin')->name('admin')->group(function () {
    Route::get('index', 'AdminController@index')->name('/index');
    Route::get('create', 'AdminController@create')->name('/create');
    Route::post('store', 'AdminController@store')->name('/store');
    Route::get('edit', 'AdminController@edit')->name('/edit');
    Route::post('update', 'AdminController@update')->name('/update');
});

// calendar
Route::middleware('auth')->prefix('calendar')->name('calendar')->group(function () {
    Route::get('index', 'CalendarController@index')->name('/index');
});

// items
Route::middleware('auth')->prefix('items')->name('items')->group(function () {
    Route::get('index', 'ItemController@index')->name('/index');
    Route::post('store', 'ItemController@store')->name('/store');
    Route::get('show/a', 'ItemController@showAjax')->name('/show/a');
    Route::get('edit', 'ItemController@edit')->name('/edit');
    Route::post('update', 'ItemController@update')->name('/update');

    // Route::get('destroy', 'ItemController@destroy'); //
});


Route::get('users/done', 'DoneController@usersEdit');
Route::get('users/password/done', 'DoneController@usersPassword');
Route::get('users/delete/done', 'DoneController@usersDelete');
Route::get('users/leave/done', 'DoneController@usersLeave');
