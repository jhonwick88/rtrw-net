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
        Route::put('update/{id}','UserController@update')->name('api.user.update');
        Route::delete('destroy/{id}','UserController@destroy')->name('api.user.destroy');
    });
    Route::post('/logout', 'AuthController@logout')->name('api.auth.logout');
    //Coin
    Route::group(['prefix' => 'coin'], function () {
        Route::get('index','CoinController@index')->name('api.coin.index')->withoutMiddleware('auth:sanctum');
        Route::post('store','CoinController@store')->name('api.coin.store');
        Route::post('vote','CoinController@addVotes')->name('api.coin.vote');
        Route::put('update/{id}','CoinController@update')->name('api.coin.update');
        Route::delete('destroy/{id}','CoinController@destroy')->name('api.coin.destroy');
    });
    //Watchlist
    Route::group(['prefix' => 'watchlist'], function () {
        Route::get('index','WatchlistController@index')->name('api.watchlist.index');
        Route::post('store','WatchlistController@store')->name('api.watchlist.store');
       // Route::put('update/{id}','CoinController@update')->name('api.coin.update');
       Route::delete('destroy/{watchlist}','WatchlistController@destroy')->name('api.watchlist.destroy');
       Route::delete('delete/{id}','WatchlistController@delete')->name('api.watchlist.delete');
    });
    //Network
    Route::group(['prefix' => 'network'], function () {
        Route::get('index','NetworkController@index')->name('api.network.index');
        Route::post('store','NetworkController@store')->name('api.network.store');
        Route::put('update/{id}','NetworkController@update')->name('api.network.update');
        Route::delete('destroy/{id}','NetworkController@destroy')->name('api.network.destroy');
    });
    //Ads
    Route::group(['prefix' => 'ads'], function () {
        Route::get('index','AdsController@index')->name('api.ads.index');
        Route::post('store','AdsController@store')->name('api.ads.store');
        Route::put('update/{id}','AdsController@update')->name('api.ads.update');
        Route::put('update-active/{id}','AdsController@updateActive')->name('api.ads.updateactive');
        Route::delete('destroy/{id}','AdsController@destroy')->name('api.ads.destroy');
    });
    //Setting
    Route::group(['prefix' => 'setting'], function () {
        Route::get('index','SettingController@index')->name('api.setting.index');
        Route::get('data','SettingController@getSettings')->name('api.setting.get');
        Route::put('update/{setting}','SettingController@update')->name('api.setting.update');
       // Route::delete('destroy/{id}','SettingController@destroy')->name('api.v1.setting.destroy');
    });
});
Route::get('/data', function (){
    return User::all();
});
