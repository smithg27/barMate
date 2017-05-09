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

//Default "static pages" + auth route from built in laravel Auth Build
Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

//Inventory Controller views

//Personal inventory routes
Route::get('inventory/add/{id}', 'InventoryController@addPersonal');

Route::post('inventory/add/{id}', 'InventoryController@savePersonal');

Route::get('inventory/user/{id}', 'InventoryController@viewUser');

Route::delete('inventory/add/{id}', 'InventoryController@deletePersonal');

Route::patch('inventory/add/{id}', 'InventoryController@updatePersonal');

//For adding, deleting, and editing items in Inventory table
Route::get('inventory/add_inventory', 'InventoryController@addInventory');

Route::patch('inventory/add_inventory/{id}', 'InventoryController@updateInventory');

Route::delete('inventory/add_inventory/{id}', 'InventoryController@deleteInventory');

Route::post('inventory/add_inventory', 'InventoryController@saveInventory');
//view all inventory item tables with optional type parameter
Route::get('inventory/view_all/{type?}', 'InventoryController@viewAll');
//View inventory item details
Route::get('inventory/view/{id}', 'InventoryController@getDetails');

//API responses
Route::get('API', 'APIController@index');
