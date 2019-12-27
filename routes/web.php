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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {return view('home');});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/about', function () {return view('about');});

Route::get('/recipes/delete/{id}', 'RecipeController@delete')->name('recipes.delete');
Route::resource('recipes', 'RecipeController');

Route::get('/profile/{id}', 'UserController@show')->name('users.show');
Route::get('/profile/{id}/edit', 'UserController@edit')->name('users.edit');
Route::post('/profile', 'UserController@update')->name('users.update');

Auth::routes();