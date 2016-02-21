<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['namespace' => 'Auth'], function()
{
    Route::get('login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');
    Route::get('logout', 'AuthController@getLogout');
});

Route::get('/', 'HomeController@index');
Route::get('registration', 'UserController@create');
Route::post('register', 'UserController@store');

//Route::get('messages', 'MessageController@index');
Route::get('messages/{role_name}', 'MessageController@index');
Route::get('messages/new/{username}', 'MessageController@create');
Route::post('messages/new', 'MessageController@store');
Route::get('messages/view/{message_id}', 'MessageController@viewMessageDetail');
Route::post('messages/reply', 'MessageController@sendReplyMessage');

Route::get('seller/{flag}', 'SellerController@sellerList');

Route::get('notifications', 'NotificationController@index');
Route::get('notifications/read/{id}/{flag}', 'NotificationController@flagNotification');

Route::get('shop/open', 'ShopController@create');
Route::post('shop/open', 'ShopController@store');

