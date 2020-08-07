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

Route::group(['middleware' => 'xss'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('about', 'HomeController@about')->name('about');
    Route::get('service', 'HomeController@service')->name('service');
    Route::post('brand-phone-list', 'HomeController@brandWisePhone')->name('brand.phone.list');
    Route::post('phone-services', 'HomeController@phoneWiseService')->name('phone.services');
    Route::get('contact', 'ContactController@index')->name('contact');
    Route::post('send-contact-message', 'ContactController@store')->name('send.contact.message');
    
    Route::get('faqs', 'SupportController@faqs')->name('faqs');
    Route::get('feedback', 'SupportController@feedback')->name('feedback');
    Route::post('store-feedback', 'SupportController@store')->name('store.feedback');

    Route::get('product/{category}', 'ProductController@index')->name('product');
    Route::post('product/list', 'ProductController@product_list')->name('product.list');
});


