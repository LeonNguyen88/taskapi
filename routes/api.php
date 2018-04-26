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
Route::group(['prefix' => 'v1'], function(){
    Route::post('user/register', 'UserController@store');
    Route::post('user/login', 'UserController@login')->name('login');
    Route::get('user/{id}', 'UserController@show')->name('showuserinfo');
    Route::get('user', 'UserController@index')->name('listuser');
    Route::delete('user/{id}', 'UserController@destroy')->name('removeuser');
    Route::get('project', 'ProjectController@index')->name('listproject');
    Route::post('project/create', 'ProjectController@store')->name('createproject');
    Route::get('project/{id}', 'ProjectController@show')->name('showprojectinfo');
    Route::get('task', 'TaskController@index')->name('listtask');
    Route::post('task/create', 'TaskController@store')->name('createtask');
    Route::get('task/{id}', 'TaskController@show')->name('showtaskinfo');
    Route::delete('task/{id}', 'TaskController@destroy')->name('removetask');
});
Route::get('/test', function(){
   return "Hello";
});
