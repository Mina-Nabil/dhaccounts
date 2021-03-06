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

Route::get('/','LedgerController@home');

//Auth::routes(['register' => false]);

//Invoices
Route::get('invoice/show', 'InvoicesController@home');
Route::get('invoice/show/{id}', 'InvoicesController@show');
Route::get('invoice/confirm/{id}', 'InvoicesController@confirmInvoice');
Route::get('invoice/confirmrevert/{id}', 'InvoicesController@confirmRevert');
Route::get('invoice/cancel/{id}', 'InvoicesController@cancelInvoice');
Route::get('invoice/revert/{id}', 'InvoicesController@revertInvoice');
Route::get('invoice/add', 'InvoicesController@addPage');
Route::get('invoice/addrevert', 'InvoicesController@addRevert');
Route::post('invoice/insert', 'InvoicesController@insert');
Route::post('invoice/insertrevert', 'InvoicesController@insertRevert');
Route::get('invoice/modify/{id}', 'InvoicesController@edit');
Route::post('invoice/edit/{id}', 'InvoicesController@updateData');


//Ledger
Route::get('ledger/show', 'LedgerController@home');
Route::get('ledger/show/{id}', 'LedgerController@home');
Route::get('ledger/pw', 'LedgerController@pw');
Route::post('ledger/total', 'LedgerController@totals');
Route::get('ledger/add', 'LedgerController@addPage');
Route::post('ledger/insert', 'LedgerController@insert');
Route::get('ledger/delete', 'LedgerController@delete');

//Transactions
Route::get('transactions/show', 'TransactionsController@show');
Route::get('transactions/show/{workshopID}', 'TransactionsController@showWorkshop');
Route::post('transactions/records', 'TransactionsController@showWorkshopRecords');
Route::get('transactions/add', 'TransactionsController@addPage');
Route::post('transactions/insert', 'TransactionsController@insert');

//Clients
Route::get('clients/show', 'ClientsController@home');
Route::get('clients/show/{type}', 'ClientsController@home');
Route::get('clients/add', 'ClientsController@add');
Route::post('clients/records', 'ClientsController@records');
Route::post('clients/insert', 'ClientsController@insert');
Route::get('clients/edit/{id}', 'ClientsController@edit');
Route::post('clients/modify/{id}', 'ClientsController@modify');

//Users routes
Route::get('users/show', 'UsersController@show');
Route::get('users/add', 'UsersController@add');
Route::get('users/edit/{id}', 'UsersController@profile');
Route::post('users/insert', 'UsersController@insert');
Route::post('users/modify/{id}', 'UsersController@update');

//Models routes
Route::get('models/home', 'ModelsController@home');
Route::get('models/add', 'ModelsController@add');
Route::get('models/edit/{id}', 'ModelsController@edit');
Route::post('models/insert', 'ModelsController@insert');
Route::post('models/update/{id}', 'ModelsController@update');

//Inventory routes
Route::get('inventory/home', 'InventoryController@home');
Route::get('inventory/add', 'InventoryController@add');
Route::get('inventory/edit/{id}', 'InventoryController@edit');
Route::post('inventory/insert', 'InventoryController@insert');
Route::post('inventory/update/{id}', 'InventoryController@update');

//Inventory routes
Route::get('workshops/show', 'WorkshopsController@home');
Route::get('workshops/add', 'WorkshopsController@add');
Route::post('workshops/insert', 'WorkshopsController@insert');
Route::get('workshops/modify/{id}', 'WorkshopsController@modify');
Route::post('workshops/update/{id}', 'WorkshopsController@update');

//Login & home routes
Route::get('logout', 'HomeController@logout')->name('logout');
Route::post('login', 'HomeController@login')->name('login');
Route::get('login', 'HomeController@login')->name('loginHome');
Route::get('/home', 'LedgerController@home')->name('home');
