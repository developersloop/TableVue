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
    return view('app.welcome');
});


Route::group(['prefix' => 'profile'], function () {
    Route::get('/', ['as'=>'profile','uses'=>'profileController@index'])->name('profile');    
    Route::post('/store', ['as'=>'profile.store','uses'=>'profileController@store'])->name('profile_store');
    Route::get('/{id}',['as'=>'profile.edit','uses'=>'profileController@edit'])->name('profile.edit');
    Route::put('/{id}',['as'=>'profile.editar','uses'=>'profileController@editar'])->name('profile.editar');
    Route::get('/search/{params}',['as'=>'profile.search','uses'=>'profileController@Search'])->name('profile.search');
    Route::get('/delete/{id}',['as'=>'profile.delete','uses'=>'profileController@delete'])->name('profile.delete'); 
    Route::get('/inicial',['as'=>'profile.init','uses'=>'profileController@init'])->name('profile.init'); 

});
