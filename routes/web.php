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
    Route::get('scheduled/list', 'ScheduledExpenseController@list')->name('listScheduled');

    Route::resource('expense', 'ExpenseController');
    Route::resource('vendor', 'VendorController');
    Route::resource('scheduled', 'ScheduledExpenseController');
    Route::resource('category', 'CategoryController');
});
Route::get('period', 'PeriodController@index')->name('period');
Route::post('period/custom', 'PeriodController@customise')->name('periodCustomise');
Route::post('period', 'PeriodController@preset')->name('periodPreset');

Auth::routes();


Route::group(['prefix' => 'backoffice'], function () {
    Voyager::routes();
});
