<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->group(function () {    
    Route::get('articles', 'ArticleController@index');
    Route::get('article/{id}', 'ArticleController@show');
    Route::post('article', 'ArticleController@store');
    Route::put('article', 'ArticleController@store');
    Route::delete('article/{id}', 'ArticleController@destroy');

    Route::delete('deleteLog/{id}','LogActivityController@destroyLog');

    //chat app
    Route::get('contacts', 'ContactsController@get');
    Route::get('conversation/{id}', 'ContactsController@getMessagesFor');
    Route::post('conversation/send', 'ContactsController@send');
    Route::get('messagecount', 'ContactsController@messageCount');
}); 




