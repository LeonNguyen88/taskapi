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

use App\Project;
use App\Role;

Route::get('/', function () {
    return view('welcome');
});
Route::get('role/create', function(){
    $role = new Role([
        'name' => 'User'
    ]);
    $role->save();
});
Route::group(['prefix' => 'admin'], function(){
    Route::get('/', function(){
        return view('layouts.admin');
    })->name('admin');
    Route::resource('/user', 'AdminUserController');
});
