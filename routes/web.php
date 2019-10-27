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
    return view('auth.login');
});

Auth::routes();


Route::middleware('auth')->group(function(){

    Route::prefix('/home')->group(function(){
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/guest/{id}', 'GuestController@index')->name('home');
        Route::get('/messenger', 'MessengerController@index');
        Route::get('/upload-images/{id}', 'ImagesController@index');
        Route::get('/files/{id}', 'GuestController@getGuestImages');
        Route::get('/files-group', 'FilesController@index');
        Route::post('/addMessages', 'MessengerController@create');
        Route::post('/getLastMessages', 'MessengerController@getLastMessages');
        Route::post('/getNewPartners', 'MessengerController@getNewPartners');
        Route::post('update/profile/picture', 'HomeController@updateProfile');
    });

    Route::post('/uploadImage', 'ImagesController@uploadImage');
    Route::delete('/deleteImage/{id}', 'ImagesController@deletedImage');
    Route::post('/addRepository', 'FilesController@create');
    Route::post('/deleteRepository', 'FilesController@delete');
    Route::post('/getUsers', 'HomeController@select');
    Route::post('/get/messages', 'MessengerController@getMessages');
    Route::post('/user/unFollow/{follow_id}', 'GuestController@unFollow');
    Route::post('/user/follow/{guest_id}', 'GuestController@follow');

});
