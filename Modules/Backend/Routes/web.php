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


Route::group(['middleware' => ['auth']], function () {
    Route::get('admin', 'DashboardController@index');

    Route::group(['prefix' => 'admin','as'=>'admin.'], function () {

        //Brand Routes
        Route::get('brand', 'BrandController@index')->name('brand');
        Route::group(['prefix' => 'brand', 'as'=>'brand.'], function () {
            Route::post('list', 'BrandController@getList')->name('list');
            Route::post('store', 'BrandController@store')->name('store');
            Route::post('edit', 'BrandController@edit')->name('edit');
            Route::post('delete', 'BrandController@destroy')->name('delete');
            Route::post('bulk-action-delete', 'BrandController@bulk_action_delete')->name('bulkaction');
        });

        //Phone Routes
        Route::get('phone', 'PhoneController@index')->name('phone');
        Route::group(['prefix' => 'phone', 'as'=>'phone.'], function () {
            Route::post('list', 'PhoneController@getList')->name('list');
            Route::post('store', 'PhoneController@store')->name('store');
            Route::post('edit', 'PhoneController@edit')->name('edit');
            Route::post('update', 'PhoneController@update')->name('update');
            Route::post('delete', 'PhoneController@destroy')->name('delete');
            Route::post('bulk-action-delete', 'PhoneController@bulk_action_delete')->name('bulkaction');
        });

        //Phone Service Routes
        Route::get('phone-service', 'PhoneServiceController@index')->name('phone.service');
        Route::group(['prefix' => 'phone-service', 'as'=>'phone.service.'], function () {
            Route::post('list', 'PhoneServiceController@getList')->name('list');
            Route::post('store', 'PhoneServiceController@store')->name('store');
            Route::post('edit', 'PhoneServiceController@edit')->name('edit');
            Route::post('update', 'PhoneServiceController@update')->name('update');
            Route::post('delete', 'PhoneServiceController@destroy')->name('delete');
            Route::post('bulk-action-delete', 'PhoneServiceController@bulk_action_delete')->name('bulkaction');
        });

        //Product Routes
        Route::get('product', 'ProductController@index')->name('product');
        Route::group(['prefix' => 'product', 'as'=>'product.'], function () {
            Route::post('list', 'ProductController@getList')->name('list');
            Route::post('store', 'ProductController@store')->name('store');
            Route::post('edit', 'ProductController@edit')->name('edit');
            Route::post('update', 'ProductController@update')->name('update');
            Route::post('delete', 'ProductController@destroy')->name('delete');
            Route::post('bulk-action-delete', 'ProductController@bulk_action_delete')->name('bulkaction');
        });

        //Product Category Routes
        Route::get('category', 'CategoryController@index')->name('category');
        Route::group(['prefix' => 'category','as'=>'category.'], function () {
            Route::post('list', 'CategoryController@getList')->name('list');
            Route::post('store', 'CategoryController@store')->name('store');
            Route::post('edit', 'CategoryController@edit')->name('edit');
            Route::post('delete', 'CategoryController@destroy')->name('delete');
            Route::post('bulk-action-delete', 'CategoryController@bulk_action_delete')->name('bulkaction');
        });


    });
});