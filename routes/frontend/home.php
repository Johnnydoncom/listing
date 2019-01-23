<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\ListingController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\MessageController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::get('terms', [HomeController::class, 'terms'])->name('terms');
Route::get('privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::post('contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::post('contact/seller', [ContactController::class, 'seller'])->name('contact.seller');


// Dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Listing
Route::get('cars-for-sale', [ListingController::class, 'index'])->name('cars-for-sale');
Route::get('search/', [ListingController::class, 'index'])->name('general.search');
Route::get('cars-for-sale/search/{query}', [ListingController::class, 'filter'])->name('cars.query');

Route::get('cars-for-sale/{slug}', [ListingController::class, 'show'])->name('listing.show');

Route::get('category', [ListingController::class, 'category_index'])->name('category');
Route::get('category/{category}', [ListingController::class, 'listing_by_category'])->name('category.listings');

Route::get('make', [ListingController::class, 'make_index'])->name('make');
Route::get('make/{make}/models', [ListingController::class, 'listing_make_models'])->name('make.listings');

Route::get('make/{make}', [ListingController::class, 'listing_by_make'])->name('make.listings');


// News Post
Route::get('news', [NewsController::class, 'index'])->name('news');

Route::group(['middleware' => ['auth', 'password_expires']], function () {
    Route::get('news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('news/create', [NewsController::class, 'store'])->name('news.store');

    // Comment
    Route::post('news/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::post('news/comment/reply', [CommentController::class, 'replyStore'])->name('comment.reply.store');
    
});

Route::get('news/{slug}', [NewsController::class, 'show'])->name('news.show');


// Route::post('contact/send', [ListingController::class, 'send'])->name('contact.send');
/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the password is expired
 */
Route::group(['middleware' => ['auth', 'password_expires']], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('profile/', [DashboardController::class, 'profile'])->name('dashboard');
        Route::get('profile/{username}', [DashboardController::class, 'profile'])->name('profile');

        /*
         * User Account Specific
         */
        Route::get('account', [AccountController::class, 'index'])->name('account');

        /*
         * User Listing Specific
         */
        Route::get('account/listing', [AccountController::class, 'listing_index'])->name('account.listing.index');
        Route::post('account/listing', [AccountController::class, 'listing_store'])->name('account.listing.store');
        Route::get('account/listing/suggest', [AccountController::class, 'listing_create'])->name('account.listing.create');
        Route::get('account/listing/{listing}', [AccountController::class, 'listing_show'])->name('account.listing.show');
        Route::patch('account/listing/{listing}', [AccountController::class, 'listing_update'])->name('account.listing.update');

        /*
         * User Message 
         */
        Route::post('account/message', [MessageController::class, 'store'])->name('message.store');
        Route::get('account/message', [MessageController::class, 'index'])->name('message.index');
        Route::get('account/message/{message}', [MessageController::class, 'show'])->name('message.show');
        Route::post('account/message/{message}', [MessageController::class, 'reply'])->name('message.reply');

        // Route::post('account/listing', [AccountController::class, 'listing_store'])->name('account.listing.store');

        /*
         * User News Specific
         */
        Route::get('account/news', [AccountController::class, 'news_index'])->name('account.news.index');
        Route::post('account/news', [AccountController::class, 'news_store'])->name('account.news.store');
        Route::get('account/news/suggest', [AccountController::class, 'news_create'])->name('account.news.create');
        Route::get('account/news/{news}', [AccountController::class, 'news_show'])->name('account.news.show');
        Route::put('account/news/{news}', [AccountController::class, 'news_update'])->name('account.news.update');
        Route::delete('account/news/{news}', [AccountController::class, 'news_destroy'])->name('account.news.destroy');


        /*
         * User Profile Specific
         */
        Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');


    });
});
