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
    Route::get('admin/unauthorized', 'DashboardController@unauthorized');

    Route::group(['prefix' => 'admin','as'=>'admin.'], function () {

        //Module Routes
        Route::get('module', 'ModuleController@index')->name('module');
        Route::group(['prefix' => 'module', 'as'=>'module.'], function () {
            Route::post('list', 'ModuleController@getList')->name('list');
            Route::post('store', 'ModuleController@store')->name('store');
            Route::post('edit', 'ModuleController@edit')->name('edit');
            Route::post('delete', 'ModuleController@destroy')->name('delete');
            Route::post('bulk-action-delete', 'ModuleController@bulk_action_delete')->name('bulkaction');
            Route::post('parent-module-list', 'ModuleController@parent_module_list')->name('parent');
        });

        //Method Routes
        Route::get('method', 'MethodController@index')->name('method');
        Route::group(['prefix' => 'method', 'as'=>'method.'], function () {
            Route::post('list', 'MethodController@getList')->name('list');
            Route::post('store', 'MethodController@store')->name('store');
            Route::post('edit', 'MethodController@edit')->name('edit');
            Route::post('delete', 'MethodController@destroy')->name('delete');
            Route::post('bulk-action-delete', 'MethodController@bulk_action_delete')->name('bulkaction');
        });

        //Role Routes
        Route::get('role', 'RoleController@index')->name('role');
        Route::group(['prefix' => 'role', 'as'=>'role.'], function () {
            Route::post('list', 'RoleController@getList')->name('list');
            Route::get('create', 'RoleController@create')->name('create');
            Route::post('store', 'RoleController@store')->name('store');
            Route::get('edit/{role}', 'RoleController@edit')->name('edit');
            Route::post('delete', 'RoleController@destroy')->name('delete');
            Route::post('bulk-action-delete', 'RoleController@bulk_action_delete')->name('bulkaction');
        });

        //User Routes
        Route::get('user', 'UserController@index')->name('user');
        Route::group(['prefix' => 'user', 'as'=>'user.'], function () {
            Route::post('list', 'UserController@getList')->name('list');
            Route::post('store', 'UserController@store')->name('store');
            Route::post('show', 'UserController@show')->name('show');
            Route::post('edit', 'UserController@edit')->name('edit');
            Route::post('delete', 'UserController@destroy')->name('delete');
            Route::post('bulk-action-delete', 'UserController@bulk_action_delete')->name('bulkaction');
            Route::post('change-password', 'UserController@change_password')->name('change.password');
        });

        //Profile Routes
        Route::get('profile', 'ProfileController@index')->name('profile');
        Route::group(['prefix' => 'profile', 'as'=>'profile.'], function () {
            Route::post('update', 'ProfileController@update')->name('update');
            Route::post('change-password', 'ProfileController@change_password')->name('change.password');
        });

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
            Route::post('show', 'PhoneController@show')->name('show');
            Route::post('delete', 'PhoneController@destroy')->name('delete');
            Route::post('bulk-action-delete', 'PhoneController@bulk_action_delete')->name('bulkaction');
        });

        //Phone Service Routes
        Route::get('phone-service', 'PhoneServiceController@index')->name('phone.service');
        Route::group(['prefix' => 'phone-service', 'as'=>'phone.service.'], function () {
            Route::post('list', 'PhoneServiceController@getList')->name('list');
            Route::post('store', 'PhoneServiceController@store')->name('store');
            Route::post('edit', 'PhoneServiceController@edit')->name('edit');
            Route::post('delete', 'PhoneServiceController@destroy')->name('delete');
            Route::post('bulk-action-delete', 'PhoneServiceController@bulk_action_delete')->name('bulkaction');
        });

        //Product Routes
        Route::get('product', 'ProductController@index')->name('product');
        Route::group(['prefix' => 'product', 'as'=>'product.'], function () {
            Route::post('list', 'ProductController@getList')->name('list');
            Route::post('store', 'ProductController@store')->name('store');
            Route::post('show', 'ProductController@show')->name('show');
            Route::post('edit', 'ProductController@edit')->name('edit');
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

        //Faqs Routes
        Route::get('faqs', 'FaqsController@index')->name('faqs');
        Route::group(['prefix' => 'faqs', 'as'=>'faqs.'], function () {
            Route::post('list', 'FaqsController@getList')->name('list');
            Route::post('store', 'FaqsController@store')->name('store');
            Route::post('edit', 'FaqsController@edit')->name('edit');
            Route::post('delete', 'FaqsController@destroy')->name('delete');
            Route::post('bulk-action-delete', 'FaqsController@bulk_action_delete')->name('bulkaction');
        });

        //Slider Routes
        Route::get('slider', 'SliderController@index')->name('slider');
        Route::group(['prefix' => 'slider', 'as'=>'slider.'], function () {
            Route::post('list', 'SliderController@getList')->name('list');
            Route::post('store', 'SliderController@store')->name('store');
            Route::post('edit', 'SliderController@edit')->name('edit');
            Route::post('delete', 'SliderController@destroy')->name('delete');
            Route::post('bulk-action-delete', 'SliderController@bulk_action_delete')->name('bulkaction');
        });

        //Slider Routes
        Route::get('highlighted-service', 'HighlightedServiceController@index')->name('highlighted.service');
        Route::group(['prefix' => 'highlighted-service', 'as'=>'highlighted.service.'], function () {
            Route::post('list', 'HighlightedServiceController@getList')->name('list');
            Route::post('store', 'HighlightedServiceController@store')->name('store');
            Route::post('edit', 'HighlightedServiceController@edit')->name('edit');
            Route::post('delete', 'HighlightedServiceController@destroy')->name('delete');
            Route::post('bulk-action-delete', 'HighlightedServiceController@bulk_action_delete')->name('bulkaction');
        });

        //Review Routes
        Route::get('customer-feedback', 'ReviewController@index')->name('customer.feedback');
        Route::group(['prefix' => 'customer-feedback', 'as'=>'customer.feedback.'], function () {
            Route::post('list', 'ReviewController@getList')->name('list');
            Route::post('show', 'ReviewController@show')->name('show');
            Route::post('delete', 'ReviewController@destroy')->name('delete');
            Route::post('bulk-action-delete', 'ReviewController@bulk_action_delete')->name('bulkaction');
        });

        Route::resource('setting', 'SettingController')->only(['index','store']);
        Route::post('page', 'SettingController@storePageData')->name('page');

        Route::get('mark-all-read', function () {
            auth()->user()->unreadNotifications->markAsRead();
            return back();
        })->name('mark.all.read');

        Route::get('delete-all-notification', function () {
            auth()->user()->notifications()->delete();
            return back()->with(['status'=>'success','message'=>'Notifications Deleted Successfully']);
        })->name('delete.all.notification');

        Route::get('read-notification/{id}', function (string $id) {
            
            $feedback = \DB::table('notifications')->where('id',$id)->first();
            \DB::table('notifications')->where('id',$id)->update(['read_at' => now()]);
            return view('backend::read-notification',compact('feedback'));
        })->name('read.notification');

        Route::get('delete-notification/{id}', function (string $id) {
            $deleted = \DB::table('notifications')->where('id',$id)->delete();
            if($deleted){
                return redirect('admin')->with(['status'=>'success','message'=>'Notification Deleted Successfully']);
            }else{
                return redirect()->back()->with(['status'=>'error','message'=>'Notification Cannot Delete']);
            }
            
        })->name('delete.notification');
    });
});
