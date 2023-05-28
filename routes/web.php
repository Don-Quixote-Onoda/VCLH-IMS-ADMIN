<?php

use Illuminate\Support\Facades\Route;
 
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
    return view('viewers');
});



Route::resource('/inns','ViewersController');
Route::get('search','ViewersController@search')->name('search-inn');
Route::resource('reservations', 'ReservationGuestController');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin','auth']], function() {
    Route::get('dashboard', 'InnController@index')->name('admin.dashboard');
    Route::get('profile', 'AdminController@profile')->name('admin.dashboard.profile');
    Route::get('settings', 'AdminController@settings')->name('admin.dashboard.settings');
    Route::resource('inns-admin', 'InnController');
    Route::resource('users-admin', 'UserController');
    Route::resource('freebies-admin', 'FreebiesController');
    Route::resource('rooms-admin', 'RoomControllers');
    Route::resource('reservations-admin', 'ReservationController');
    Route::resource('room_rates-admin', 'RoomRatesController');
    Route::get('add-room-admin/{id}', 'RoomControllers@addRoom');
    Route::resource('transactions-admin', 'TransactionController');
    Route::get('inn/dashboard/{id}', 'AdminInnControllers@dashboard');
    Route::get('inn/rooms/{id}', 'AdminInnControllers@rooms');
    Route::get('inn/transactions/{id}', 'AdminInnControllers@transactions');
    Route::get('inn/reservations/{id}', 'AdminInnControllers@reservations');
    Route::get('inn/products/{id}', 'AdminInnControllers@products');
    Route::post('inn/products', 'AdminInnControllers@store_products')->name('store_products');
    Route::get('inn/products/edit/{inn}{id}', 'AdminInnControllers@edit_products')->name('edit_products');
    Route::put('inn/products/update/{id}', 'AdminInnControllers@update_products')->name('update_products');
    Route::delete('inn/products/destroy/{inn}{id}', 'AdminInnControllers@destroy_products')->name('destroy_products');
    Route::get('inn/order_summaries/{id}', 'AdminInnControllers@order_summaries');

    Route::get('inn/product_categories/{id}', 'AdminInnControllers@product_categories');
    Route::post('inn/product_categories/{id}', 'AdminInnControllers@store_product_categories')->name('store_product_categories');
    Route::get('inn/product_categories/edit/{inn}{id}', 'AdminInnControllers@edit_product_categories')->name('edit_product_categories');
    Route::put('inn/product_categories/update/{id}', 'AdminInnControllers@update_product_categories')->name('update_product_categories');
    Route::delete('inn/product_categories/destroy/{inn}{id}', 'AdminInnControllers@destroy_product_categories')->name('destroy_product_categories');
    Route::get('inn/inventory_managements/{id}', 'AdminInnControllers@inventory_managements');
    Route::post('inn/inventory_managements', 'AdminInnControllers@store_inventory_managements')->name('store_inventory_managements');
    Route::get('inn/inventory_managements/edit/{inn}{id}', 'AdminInnControllers@edit_inventory_managements')->name('edit_inventory_managements');
    Route::put('inn/inventory_managements/update/{id}', 'AdminInnControllers@update_inventory_managements')->name('update_inventory_managements');
    Route::delete('inn/inventory_managements/destroy/{inn}{id}', 'AdminInnControllers@destroy_inventory_managements')->name('destroy_inventory_managements');
    Route::get('inn/order_details/{id}', 'AdminInnControllers@order_details');
    Route::get('inn/pay_order_summary/{id}', 'AdminInnControllers@pay_order_summary');
    Route::post('inn/store_order_summary/', 'AdminInnControllers@store_order_summary')->name('store_order_summary');
    Route::post('inn/order_details/', 'AdminInnControllers@store_order_details')->name('store_order_details');
    
});

Route::group(['prefix' => 'user', 'middleware' => ['isUser','auth']], function() {
    Route::post('/transactions-manager/{id}/checkout', 'TransactionManagerController@processCheckout')->name('transactions.processCheckout');
    Route::get('/summary-reports', function() {
        return view('user.dashboard');
    });
    Route::post('/transactions-manager/{id}/add-product', 'TransactionManagerController@addToTransaction')->name('transactions.addProduct');
    Route::get('/transactions-manager/{id}/pos', 'TransactionManagerController@showPosView')->name('transactions.pos');
    Route::post('/transactions-manager/{id}/add-product', 'TransactionManagerController@addToTransaction')->name('transactions.addProduct');
    Route::post('/transactions-manager/{id}/checkout', 'TransactionManagerController@checkout')->name('transactions.checkout');
    Route::post('/transactions-manager/{id}/checkout', 'TransactionManagerController@processCheckout')->name('checkout.process');
    Route::get('dashboard', 'RoomManagerController@index')->name('user.dashboard');
    Route::get('profile', 'UserController@profile')->name('user.dashboard.profile');
    Route::get('settings', 'UserController@settings')->name('user.dashboard.settings');
    Route::resource('rooms-manager', 'RoomManagerController');
    Route::resource('inns-manager', 'InnManagerController');
    Route::resource('room-rates-manager', 'RoomRatesManagerController');
    Route::resource('freebies-manager', 'FreebiesManagerController');
    Route::resource('transactions-manager', 'TransactionManagerController');
    Route::resource('reservations-manager', 'ReservationManagerController');
    Route::get('/reservations/create', 'ReservationController@create')->name('reservations.create');
    Route::post('/user/reservations-manager/{reservation}/update-status', 'ReservationController@updateStatus')->name('updateStatus');
    Route::get('/user/reservations-manager', 'ReservationController@index')->name('reservations-manager.index');
    Route::get('/transactions-manager/{id}/print', 'TransactionManagerController@printInvoice')->name('transactions-manager.printInvoice');
    Route::put('/user/reservations-manager/{id}', 'App\Http\Controllers\ReservationManagerController@updateStatus')->name('reservations-manager.updateStatus');
    Route::get('/admin/transactions-admin/{id}', 'TransactionController@printInvoice')->name('transactions-admin.printInvoice');
    Route::get('/admin/transactions-admin/{id}/print', 'TransactionController@printInvoice')->name('transactions-admin.print');
    Route::get('/user/transactions-manager/{id}', 'TransactionManagerController@printInvoice')->name('transactions-manager.printInvoice');
    Route::resource('products', 'InnProductsController');
    Route::resource('products-category', 'InnProductsCategoryController');
    Route::resource('order-details', 'InnOrderDetailsController');
    Route::resource('order-summary', 'InnOrderSummaryController');
    Route::resource('inventory-management', 'InnInventoryManagementController');
    Route::resource('transaction-history', 'TransactionHistoryController');
    Route::get('pay_order_summary/{id}', 'InnOrderSummaryController@pay_order_summary');

    




}); 
