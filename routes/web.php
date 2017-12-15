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

Route::get('ninjify', 'Ninja@get');
Route::get('words', 'Ninja@getWords');
Route::get('login', 'Auth\LoginController@showLoginForm');
Route::get('admin', 'Admin@index')->middleware('auth');
Route::get('words/valid', 'Words@validWord');
Route::resource('words', 'Words')->middleware('auth', ['except' => ['index', 'validWord']]);
;
Route::resource('admin', 'Admin')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/register', function () {
    return redirect('/');
});
