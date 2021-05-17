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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// post routing ** avoid resource routing**

Route::get('/posts', 'PostController@index')->name('app.post.index');
Route::get('/posts/create', 'PostController@create')->name('app.post.create');
Route::post('/posts/store', 'PostController@store')->name('app.post.store');
Route::post('/posts/{id}', 'PostController@show')->name('app.post.show');
Route::get('/posts/{id}/edit', 'PostController@edit')->name('app.post.edit');
Route::put('/posts/{id}/update', 'PostController@update')->name('app.post.update');
Route::delete('/posts/{id}/destroy', 'PostController@destroy')->name('app.post.destroy');
