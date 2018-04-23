<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['prefix' => 'app/v1'], function(){
    Route::post('user/register', 'UserController@store');
    Route::post('user/login', 'UserController@login')->name('login');
    Route::get('project', 'ProjectController@index')->name('project');
    Route::post('project/create', 'ProjectController@store')->name('createproject');
});
Route::get('/test', function(){
   return "Hello";
});
