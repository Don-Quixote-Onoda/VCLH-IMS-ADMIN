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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin','auth']], function() {
    Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('profile', 'AdminController@profile')->name('admin.dashboard.profile');
    Route::get('settings', 'AdminController@settings')->name('admin.dashboard.settings');
    Route::resource('inns-admin', 'InnController');
    Route::resource('users-admin', 'UserController');
    Route::resource('freebies-admin', 'FreebiesController');
    Route::resource('rooms-admin', 'RoomControllers');
    Route::resource('room_rates-admin', 'RoomRatesController');
    Route::get('add-room-admin/{id}', 'RoomControllers@addRoom');
    Route::resource('transactions-admin', 'TransactionController');
});

Route::group(['prefix' => 'user', 'middleware' => ['isUser','auth']], function() {
    Route::get('dashboard', 'UserManagerController@index')->name('user.dashboard');
    Route::get('profile', 'UserController@profile')->name('user.dashboard.profile');
    Route::get('settings', 'UserController@settings')->name('user.dashboard.settings');
    Route::resource('rooms-manager', 'RoomManagerController');
    Route::resource('inns-manager', 'InnManagerController');
    Route::resource('room-rates-manager', 'RoomRatesManagerController');
    Route::resource('freebies-manager', 'FreebiesManagerController');
    Route::resource('transactions-manager', 'TransactionManagerController');
}); 