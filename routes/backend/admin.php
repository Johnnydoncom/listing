<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;


/*
 * All route names are prefixed with 'admin.'.
 */
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('category', 'CategoryController');
Route::resource('make', 'MakeController');

Route::post('listing/approval', 'ListingController@approval')->name('approve.listing');
Route::resource('listing', 'ListingController');

Route::post('make/model', 'MakeController@storeModel')->name('store.model');
// Route::get('make/{make}', 'MakeController@getModel')->name('list.model');
Route::delete('make/model/{model}', 'MakeController@delModel')->name('destroy.model');

// News
Route::post('news/approve', 'NewsController@approve')->name('news.approve');
Route::resource('news', 'NewsController');