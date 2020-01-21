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

Route::get('/home', 'HomeController@index')->name('home');

Route::group([
    'prefix' => 'users',
], function () {
    Route::get('/', 'UsersController@index')
         ->name('users.user.index');
    Route::get('/create','UsersController@create')
         ->name('users.user.create');
    Route::get('/show/{user}','UsersController@show')
         ->name('users.user.show');
    Route::get('/{user}/edit','UsersController@edit')
         ->name('users.user.edit');
    Route::post('/', 'UsersController@store')
         ->name('users.user.store');
    Route::put('user/{user}', 'UsersController@update')
         ->name('users.user.update');
    Route::delete('/user/{user}','UsersController@destroy')
         ->name('users.user.destroy');
});

Route::group([
    'prefix' => 'clients',
], function () {
    Route::get('/', 'clientsController@index')
         ->name('clients.client.index');
    Route::get('/create','clientsController@create')
         ->name('clients.client.create');
    Route::get('/show/{client}','clientsController@show')
         ->name('clients.client.show')->where('id', '[0-9]+');
    Route::get('/{client}/edit','clientsController@edit')
         ->name('clients.client.edit')->where('id', '[0-9]+');
    Route::post('/', 'clientsController@store')
         ->name('clients.client.store');
    Route::put('client/{client}', 'clientsController@update')
         ->name('clients.client.update')->where('id', '[0-9]+');
    Route::delete('/client/{client}','clientsController@destroy')
         ->name('clients.client.destroy')->where('id', '[0-9]+');
});
