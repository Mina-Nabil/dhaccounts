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

Route::get('/','HomeController@index');

//Auth::routes(['register' => false]);

//Users routes
Route::get('users/show', 'UsersController@show');
Route::get('users/add', 'UsersController@add');
Route::get('users/edit/{id}', 'UsersController@profile');
Route::post('users/insert', 'UsersController@insert');
Route::post('users/modify/{id}', 'UsersController@update');

//Login & home routes
Route::get('logout', 'HomeController@logout')->name('logout');
Route::post('login', 'HomeController@login')->name('login');
Route::get('login', 'HomeController@login')->name('loginHome');
Route::get('/home', 'HomeController@index')->name('home');
