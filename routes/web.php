<?php

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



Auth::routes();
Route::get('/authors/{author}', 'AuthorController@single');
Route::get('/', 'AuthorController@all');
Route::get('/search', 'AuthorController@search')->name('search');
Route::get('/authors/foo', 'AuthorController@search');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/{any}', 'AdminController@index')->where('any','.*');
