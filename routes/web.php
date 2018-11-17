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

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/category/{category}', 'CategoryController@show');
    Route::get('/category', 'CategoryController@create');
    Route::resource('/vendor', 'VendorController');
    // Expenses
    Route::resource('expense', 'ExpenseController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
