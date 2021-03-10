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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::get('photo/create', 'Admin\PhotoController@add');
    Route::post('photo/create','Admin\PhotoController@create');
    Route::get('photo', 'Admin\PhotoController@index');
    Route::get('photo/edit','Admin\PhotoController@edit');
    Route::post('photo/edit', 'Admin\PhotoController@update');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

