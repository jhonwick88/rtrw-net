<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;

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
Route::post('/loginstore','Frontend\LoginController@store')->name('login.auth.post');

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/','LandingpageController@snipper')->name('home.index');
    // Route::get('/contact','LandingpageController@contact')->name('home.contact');
    // Route::get('/about','LandingpageController@about')->name('home.about');
    // Route::group(['prefix' => 'coin'], function () {
    //     Route::get('/','CoinController@filter')->name('fe.coin.filter');
    //     Route::get('/search','CoinController@search')->name('fe.coin.search');
    //     Route::get('/watchlist/{public_id}','WatchlistController@most')->name('fe.watchlist.most');
    //     Route::get('/filter/{filter?}','CoinController@filter')->name('fe.coin.filter');
    //     Route::get('/{slug?}','CoinController@detail')->name('fe.coin.detail');
        //Route::post('store','WatchlistController@store')->name('api.watchlist.store');
       // Route::put('update/{id}','CoinController@update')->name('api.coin.update');
        //Route::delete('destroy/{watchlist}','WatchlistController@destroy')->name('api.watchlist.destroy');
    //});
    Route::post('/loginlogout','LoginController@logout')->name('login.auth.logout');
    Route::group(['middleware'=>['auth:sanctum']], function () {
        //Route::get('/dashboard', 'LandingpageController@restorant');
        Route::group(['prefix' => 'submit'], function () {
            Route::get('/coin','CoinController@submit')->name('fe.submit.coin');
            Route::get('/update-form','CoinController@updateForm')->name('fe.submit.update.form');
        });
        Route::get('/watchlist','WatchlistController@index')->name('fe.watchlist.index');
       // Route::get('/portfolio','PortfolioController@index')->name('fe.portfolio.index');
    });

});
Route::group(['namespace' => 'Backend'], function () {
    Route::get('/template', 'LoginController@template')->name('be.admin.template');
    Route::get('/wp-admin', 'LoginController@login')->name('be.admin.login');
    Route::group(['middleware' => 'auth','prefix' => 'admin'], function () {
        Route::get('/', 'DashboardController@index')->name('be.admin');
        Route::get('/dashboard', 'DashboardController@index')->name('be.admin.dashboard');
        Route::get('/customers-list', 'CustomerController@index')->name('be.admin.customers-list');
        Route::get('/settings', 'SettingController@index')->name('be.admin.setting');
        Route::get('/about', 'DashboardController@about')->name('be.admin.about');
        Route::get('/users', 'UserController@index')->name('be.admin.user');
        // trash
        Route::get('/coins', 'CoinController@index')->name('be.admin.coin');
        Route::get('/watchlist', 'WatchlistController@index')->name('be.admin.watchlist');
        Route::get('/ads', 'AdsController@index')->name('be.admin.ads');

    });
});


