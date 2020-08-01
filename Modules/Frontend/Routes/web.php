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


Route::get('/', 'HomeController@index');
Route::get('about', 'HomeController@about')->name('about');
Route::get('service', 'HomeController@service')->name('service');
Route::get('contact', 'ContactController@index')->name('contact');
Route::get('support', 'SupportController@index')->name('support');
Route::post('store-client-review', 'SupportController@store')->name('store.client.review');

