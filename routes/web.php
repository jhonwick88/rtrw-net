<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;

Route::post('/loginstore','Frontend\LoginController@store')->name('login.auth.post');
Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/','LandingpageController@snipper')->name('home.index');

    Route::post('/loginlogout','LoginController@logout')->name('login.auth.logout');
    Route::group(['middleware'=>['auth:sanctum']], function () {
    });

});
Route::group(['namespace' => 'Backend'], function () {
    // Route::get('/template', 'LoginController@template')->name('be.admin.template');
    Route::get('/wp-admin', 'LoginController@login')->name('be.admin.login');
    Route::group(['middleware' => 'auth','prefix' => 'admin'], function () {
        Route::get('/', 'DashboardController@index')->name('be.admin');
        Route::get('/dashboard', 'DashboardController@index')->name('be.admin.dashboard');
        Route::group(['prefix' => 'users'], function(){
            Route::get('/', 'UserController@index')->name('be.admin.user');
            Route::get('/create', 'UserController@create')->name('be.admin.user.create');
        });
        Route::group(['prefix' => 'customers'], function(){
            Route::get('/', 'CustomerController@index')->name('be.admin.customers');
            Route::get('/create', 'CustomerController@create')->name('be.admin.customers.create');
            Route::get('/member/{id}', 'CustomerController@member')->name('be.admin.customers.member');
            Route::get('/member/create/{id}', 'CustomerController@createMember')->name('be.admin.customers.member.create');
        });
        // Route::group(['prefix' => 'customer-members'], function(){
        //     Route::get('/', 'CustomerMemberController@index')->name('be.admin.customer-members');
        //     Route::get('/create', 'CustomerMemberController@create')->name('be.admin.customer-members.create');
        // });
        Route::group(['prefix' => 'payments'], function(){
            Route::get('/', 'PaymentController@index')->name('be.admin.payments');
            Route::get('/create', 'PaymentController@create')->name('be.admin.payments.create');
        });
        Route::group(['prefix' => 'networks'], function(){
            Route::get('/', 'NetworkController@index')->name('be.admin.networks');
            Route::get('/create', 'NetworkController@create')->name('be.admin.networks.create');
        });
        Route::group(['prefix' => 'servers'], function(){
            Route::get('/', 'ServerController@index')->name('be.admin.servers');
            Route::get('/create', 'ServerController@create')->name('be.admin.servers.create');
        });
        Route::group(['prefix' => 'payment-methods'], function(){
            Route::get('/', 'PaymentMethodController@index')->name('be.admin.payment-methods');
            Route::get('/create', 'PaymentMethodController@create')->name('be.admin.payment-methods.create');
        });
        Route::get('/settings', 'SettingController@index')->name('be.admin.setting');
        Route::get('/about', 'DashboardController@about')->name('be.admin.about');


    });
});


