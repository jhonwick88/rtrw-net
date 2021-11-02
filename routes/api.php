<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');

Route::group(['middleware'=>['auth:sanctum'],'namespace' => 'Api'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('index','UserController@index')->name('api.user.index');
        Route::post('store','AuthController@register')->name('api.user.store');
        Route::put('update/{id}','UserController@update')->name('api.user.update');
        Route::put('update-data/{id}','UserController@updateData')->name('api.user.update.data');
        Route::delete('destroy/{id}','UserController@destroy')->name('api.user.destroy');
    });
    Route::post('/logout', 'AuthController@logout')->name('api.auth.logout');
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('index','DashboardController@index')->name('api.dashboard.index');
    });
    //Customer
    Route::group(['prefix' => 'customer'], function () {
        Route::get('index','CustomerController@index')->name('api.customer.index');//->withoutMiddleware('auth:sanctum');
        Route::post('store','CustomerController@store')->name('api.customer.store');
       // Route::post('vote','CustomerController@addVotes')->name('api.customer.vote');
        Route::put('update/{id}','CustomerController@update')->name('api.customer.update');
        Route::delete('destroy/{id}','CustomerController@destroy')->name('api.customer.destroy');
    });
    //CustomerMember
    Route::group(['prefix' => 'customer-member'], function () {
        Route::get('index','CustomerMemberController@index')->name('api.customer.member.index');
        Route::post('store','CustomerMemberController@store')->name('api.customer.member.store');
        Route::put('update/{id}','CustomerMemberController@update')->name('api.customer.member.update');
        Route::delete('destroy/{id}','CustomerMemberController@destroy')->name('api.customer.member.destroy');
    });
    //Server
    Route::group(['prefix' => 'server'], function () {
        Route::get('index','ServerController@index')->name('api.server.index');
        Route::post('store','ServerController@store')->name('api.server.store');
        Route::put('update/{id}','ServerController@update')->name('api.server.update');
       Route::delete('destroy/{id}','ServerController@destroy')->name('api.server.destroy');
    });
    //Network
    Route::group(['prefix' => 'network'], function () {
        Route::get('index','NetworkController@index')->name('api.network.index');
        Route::post('store','NetworkController@store')->name('api.network.store')->withoutMiddleware('auth:sanctum');
        Route::put('update/{id}','NetworkController@update')->name('api.network.update');
        Route::delete('destroy/{id}','NetworkController@destroy')->name('api.network.destroy');
    });
    //Payment
    Route::group(['prefix' => 'payment'], function () {
        Route::get('index','PaymentController@index')->name('api.payment.index');
        Route::post('store','PaymentController@store')->name('api.payment.store');
        Route::put('update/{id}','PaymentController@update')->name('api.payment.update');
        //Route::put('update-active/{id}','PaymentController@updateActive')->name('api.payment.updateactive');
        Route::delete('destroy/{id}','PaymentController@destroy')->name('api.payment.destroy');
    });
    //PaymentMethod
    Route::group(['prefix' => 'payment-method'], function () {
        Route::get('index','PaymentMethodController@index')->name('api.payment.method.index');
        Route::post('store','PaymentMethodController@store')->name('api.payment.method.store');
        Route::put('update/{id}','PaymentMethodController@update')->name('api.payment.method.update');
        //Route::put('update-active/{id}','PaymentMethodController@updateActive')->name('api.payment.method.updateactive');
        Route::delete('destroy/{id}','PaymentMethodController@destroy')->name('api.payment.method.destroy');
    });
    //Setting
    Route::group(['prefix' => 'setting'], function () {
        Route::get('index','SettingController@index')->name('api.setting.index');
        Route::get('data','SettingController@getSettings')->name('api.setting.get');
        Route::put('update/{setting}','SettingController@update')->name('api.setting.update');
       // Route::delete('destroy/{id}','SettingController@destroy')->name('api.v1.setting.destroy');
    });
});

