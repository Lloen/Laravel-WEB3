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

use App\Food;

Route::get('/', function () {return view('welcome');});
Route::get('food', 'FoodController@getIndex');

Route::get('food/{id}', function ($id) {
    $food = Food::findOrFail($id);
    return view('foodShow', compact('food'));
});
