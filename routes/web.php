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

//Route::resource('recipes', 'RecipeController');

Route::get('recipes', 'RecipeController@index')->name('recipes.index');
Route::get('/recipes/download/{id}', 'RecipeController@download')->name('recipes.download')->middleware('auth');
Route::get('/recipes/create', 'RecipeController@create')->name('recipes.create')->middleware('auth');
Route::get('/recipes/{recipe}/edit', 'RecipeController@edit')->name('recipes.edit')->middleware('auth');
Route::get('/recipes/{recipe}', 'RecipeController@show')->name('recipes.show')->middleware('auth');
Route::get('/recipes/delete/{id}', 'RecipeController@delete')->name('recipes.delete')->middleware('auth');
Route::post('/recipes', 'RecipeController@store')->name('recipes.store')->middleware('auth');
Route::patch('/recipes/{recipe}', 'RecipeController@update')->name('recipes.update')->middleware('auth');
Route::delete('/recipes/{recipe}', 'RecipeController@destroy')->name('recipes.destroy')->middleware('auth');

Route::get('profiles', 'UserController@index')->name('users.index')->middleware('auth');
Route::get('/users/download', 'UserController@download')->name('users.download')->middleware('auth');
Route::get('/profile/{id}', 'UserController@show')->name('users.show')->middleware('auth');
Route::get('/profile/{id}/edit', 'UserController@edit')->name('users.edit')->middleware('auth');
Route::patch('/profile/{user}', 'UserController@update')->name('users.update')->middleware('auth');

Auth::routes();