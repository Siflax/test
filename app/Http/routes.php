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


Route::group(array('prefix' => 'inventory-rules'), function()
{
	Route::get('', [
			'as' =>'showInventoryRules',
			'uses' => 'InventorySettingsController@show'
	]);

	Route::post('global-limit/save', [
			'as'=>'saveGlobalLimit',
			'uses'=> 'InventorySettingsController@store'
	]);

	Route::post('',[
			'as'=>'searchInventoryRules',
			'uses'=> 'InventorySettingsController@search'
	]);

	Route::get('products', [
		'as'=>'products.index',
		'uses'=> 'ProductRulesController@index'
	]);

	Route::get('variants', [
		'as'=>'variants.index',
		'uses'=> 'VariantRulesController@index'
	]);

	Route::post('variant/save', [
		'as'=>'saveVariantRule',
		'uses'=> 'InventorySettingsController@saveVariantRule'
	]);

	Route::get('variant/delete/{id}', [
		'as'=>'deleteVariantRule',
		'uses'=> 'InventorySettingsController@deleteVariantRule'
	]);

	Route::post('product/save', [
		'as'=>'saveProductRule',
		'uses'=> 'InventorySettingsController@saveProductRule'
	]);

	Route::get('product/delete/{id}', [
		'as'=>'deleteProductRule',
		'uses'=> 'InventorySettingsController@deleteProductRule'
	]);

});


Route::get('settings/check', 'InventorySettingsController@check');


Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('shopify/shop', 'shopifyController@shop');

Route::get('shopify/product', 'shopifyController@product');



Route::get('notifications', 'NotificationsController@show');

Route::post('notifications/email', 'NotificationsController@addEmail');

Route::delete('notifications/email/delete/{id}', [
	'as'=>'deleteEmail',
	'uses'=> 'NotificationsController@removeEmail'
]);

Route::post('notifications/webhook', [
	'as'=>'addWebhook',
	'uses'=> 'NotificationsController@addWebhook'
]);

Route::post('notifications/frequency/save', [
	'as'=>'saveFrequency',
	'uses'=> 'NotificationsController@saveFrequency'
]);



Route::delete('notifications/webhook/delete/{id}', [
	'as'=>'deleteWebhook',
	'uses'=> 'NotificationsController@removeWebhook'
]);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

