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
Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
    Route::get('show', 'UserController@show')->name('users.show');
    Route::get('edit', 'UserController@edit')->name('users.edit');
    Route::post('update', 'UserController@update')->name('users.update');
});

Route::get('/', function () {
    return view('top');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');