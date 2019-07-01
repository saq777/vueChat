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

Auth::routes();


Route::middleware('auth')->group(function(){

    Route::prefix('/home')->group(function(){
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/messenger/{guestId}', 'MessengerController@index');
        Route::get('/guest/{id}', 'GuestController@guestPage');
        Route::post('/searchUser', 'GuestController@index');
        Route::post('/addMessages', 'MessengerController@create');
        Route::post('/getLastMessages', 'MessengerController@getLastMessages');
    });
});
