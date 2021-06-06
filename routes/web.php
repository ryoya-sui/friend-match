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
Auth::routes();

//ユーザー情報
Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
    Route::get('show', 'UserController@show')->name('users.show');
    Route::get('edit', 'UserController@edit')->name('users.edit');
    Route::post('update', 'UserController@update')->name('users.update');
});

//チャット処理
Route::group(['prefix' => 'chat', 'middleware' => 'auth'], function () {
    Route::post('show', 'ChatController@show')->name('chat.show');
    Route::post('chat', 'ChatController@chat')->name('chat.chat');
});

//ホーム画面
Route::get('/home', 'HomeController@index')->name('home');

//マッチング処理
Route::get('/matching', 'MatchingController@index')->name('matching');

Route::get('/', function () {
    return view('top');
});


//Twitterログイン
Route::group(['prefix' => 'twitter', 'middleware' => 'guest'], function () {
    Route::get('login', 'Auth\TwitterController@redirectToProvider')->name('twitter.login');
    Route::get('login/callback', 'Auth\TwitterController@handleProviderCallback')->name('twitter.callback');
});

//Facebookログイン
Route::group(['prefix' => 'facebook', 'middleware' => 'guest'], function () {
    Route::get('login', 'Auth\FacebookController@redirectToProvider')->name('facebook.login');
    Route::get('login/callback', 'Auth\FacebookController@handleProviderCallback')->name('facebook.callback');
});

//投稿機能
Route::group(['prefix' => 'posts', 'middleware' => 'auth'], function () {
    //Route::get('index', 'PostController@index')->name('post.index'); //投稿一覧画面
    //Route::get('search', 'PostController@search')->name('post.search'); //投稿検索画面
    Route::get('form', 'PostController@form')->name('post.form'); //投稿画面
    Route::post('create', 'PostController@create')->name('post.create'); //投稿処理
    Route::get('details/{id}', 'PostController@details')->name('post.details'); //投稿の個別ページ
});

