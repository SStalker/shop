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

/*
,
	'/' => 'StartController'
*/
Route::get('/','StartController@getIndex');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'admin' => 'AdminController',
	'settings' => 'SettingController'
]);

Route::resource('products', 'ProductController');
Route::resource('permissions', 'PermissionController');
Route::resource('roles', 'RoleController');
Route::controller('settings', 'SettingController');
Route::resource('addresses', 'AddressController');
Route::ressource('categories', 'CategoryController');