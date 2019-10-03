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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::prefix('manage')->middleware('role:superadministrator|administrator|editor|author|contributor|supporter|subscriber')->group(function () {
    Route::get('/', 'ManageController@index');
    Route::get('/dashboard', 'ManageController@dashboard')->name('manage.dashboard');
    Route::resource('/users','UserController');
    Route::resource('/permissions', 'PermissionController', ['except' => 'destroy']);
    Route::resource('/roles', 'RoleController', ['except' => 'destroy']);
    Route::get('/profile','ProfileController@profile')->name('manage.profile');
    Route::put('/profile','ProfileController@updateProfile')->name('profile.update');
    
    Route::get('add-to-log', 'LogActivityController@addToLog')->name('manage.addlog');
    Route::get('logActivity', 'LogActivityController@logActivity')->name('manage.showlog');
    
    Route::get('chat', 'ContactsController@showChatForm')->name('manage.chat');
  });


