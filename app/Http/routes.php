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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('shopify/shop', 'shopifyController@shop');

Route::get('shopify/product', 'shopifyController@product');

Route::get('settings/inventory', 'InventorySettingsController@show');

Route::post('settings/inventory', 'InventorySettingsController@store');

Route::post('settings/inventory/search', 'InventorySettingsController@search');

Route::post('settings/inventory/limit', 'InventorySettingsController@individualLimit');

Route::get('settings/check', 'InventorySettingsController@check');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

