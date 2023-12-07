<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::group(['prefix' => '/blogs'], function () {
    Route::get('', 'BlogController@index')->name('blogs.index');
    Route::get('/{id}', 'BlogController@show')->name('blogs.show');
    Route::get('/blog/create', 'BlogController@create')->name('blogs.create');
    Route::post('/store', 'BlogController@store')->name('blogs.store');
});
Route::group(['prefix' => '/comments'], function () {
    Route::get('/create', 'CommentsController@create')->name('comments.create');
    Route::get('/edit/{id}', 'CommentsController@edit')->name('comments.edit');

    Route::post('/store', 'CommentsController@store')->name('comments.store');
    Route::post('/update/{id}', 'CommentsController@update')->name('comments.update');

    Route::post('/delete/{id}', 'CommentsController@delete')->name('comments.delete');

});

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    Route::get('/',function(){});
   
});



Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', 'HomeController@index')->name('home');
