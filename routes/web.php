<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

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

Route::get('user/login','App\Http\Controllers\UsersController@LoginView');
Route::post('user/doLogin','App\Http\Controllers\UsersController@Login');
Route::get('user/logout','App\Http\Controllers\UsersController@LogOut');

Route::resource('user', 'App\Http\Controllers\UsersController');

Route::resource('task','App\Http\Controllers\taskController');

