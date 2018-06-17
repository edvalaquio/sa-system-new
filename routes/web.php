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

// Main Routes
Route::get('/', "MainController@index");
Route::get('home', "HomeController@index");
Route::get('sent', "SendController@index");
Route::get('received', "ReceiveController@index");
Route::get('accounts', "AccountController@index");
Route::get('transaction/{transaction_id}', "TransactionController@index");
Route::get('test', "MainController@testFunction");

Route::post('testPut', "AdminController@addStaff");
Route::post('home', "HomeController@index");

// Samples
Route::post('/receive/create', "ReceiveController@createReceive")->name('create.receive');
Route::post('/send/create', "SendController@createSend")->name('create.send');

Route::post('/send/createSample', "SendController@createSendSample")->name('create.sendSample');

// Create Originals
// Route::post('/receive/createReceive', "ReceiveController@createReceive")->name('create.receive');
// Route::post('/send/createSend', "SendController@createSend")->name('create.send');
Route::post('/account/createAccount', "AccountController@addAccount")->name('create.account');

// first run add user
Route::get('/addAdmin', "MainController@addFirstUser");

// admin routes
Route::get('admin', "AdminController@index")->middleware('auth');
// staff routes


// utility routes
Route::get('logout', "MainController@logout");
Auth::routes();
