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

use Illuminate\Support\Facades\Input;


/*Route::get('/', function () {
  return view('layouts.welcome');
})  ->name('welcome');*/
Route::get('/', "PostsController@index");

Auth::routes();

Route::resource('user', 'UserController');

Route::get('home', 'HomeController@index')->name('home');

Route::resource('posts', 'PostsController');

//Route::get('/search','PostsController@search');

