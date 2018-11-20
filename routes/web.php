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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/articles','ArticleController@index');

Route::group(['namespace'=>'Admin', 'prefix'=>'admin'], function(){
    Route::get('login', 'LoginController@index')->name('login.admin');
    Route::post('login','LoginController@login');
    Route::post('logout','LoginController@logout')->name('logout.admin');

    Route::group(['middleware' => 'auth.admin'], function () {
        Route::get('/', 'HomeController@index')->name('home.admin');
        Route::get('userlist', 'AppManageController@userlist');
        Route::get('orderlist', 'AppManageController@orderlist');
        Route::get('userinfo', 'AppManageController@userinfo');
        Route::get('orderinfo', 'AppManageController@orderinfo');

        Route::get('giftbag', 'GiftBagController@index');

        Route::post('saveuserinfo', 'AppManageController@saveuserinfo');
        Route::post('saveorderinfo', 'AppManageController@saveorderinfo');
        Route::get('saveuserinfo', 'AppManageController@saveuserinfo');

        Route::get('sysconfig', 'HomeController@sysconfig');
        Route::get('sysuser', 'HomeController@sysuser');
        Route::get('general', 'HomeController@general');
        Route::get('buttons', 'HomeController@buttons');
        Route::get('panels', 'HomeController@panels');

    });
});
