<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request){
    return $request->user();
});

Route::get('ingredients', 'IngredientApiController@getAllIngredients');
Route::get('ingredients/{id}', 'IngredientApiController@getIngredient');
Route::post('ingredients', 'IngredientApiController@createIngredient');
Route::post('ingredients/{id}', 'IngredientApiController@updateIngredient');
Route::delete('ingredients/{id}','IngredientApiController@deleteIngredient');
