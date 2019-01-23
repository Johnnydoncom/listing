<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Listing;
use App\CarModel;
use App\Category;
use App\Make;
use App\News;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * Application locale defaults for various components
         *
         * These will be overridden by LocaleMiddleware if the session local is set
         */

        /*
         * setLocale for php. Enables ->formatLocalized() with localized values for dates
         */
        setlocale(LC_TIME, config('app.locale_php'));

        /*
         * setLocale to use Carbon source locales. Enables diffForHumans() localized
         */
        Carbon::setLocale(config('app.locale'));

        /*
         * Set the session variable for whether or not the app is using RTL support
         * For use in the blade directive in BladeServiceProvider
         */
        if (! app()->runningInConsole()) {
            if (config('locale.languages')[config('app.locale')][2]) {
                session(['lang-rtl' => true]);
            } else {
                session()->forget('lang-rtl');
            }
        }

        // Force SSL in production
        if ($this->app->environment() == 'production') {
            //URL::forceScheme('https');
        }

        // Set the default string length for Laravel5.4
        // https://laravel-news.com/laravel-5-4-key-too-long-error
        Schema::defaultStringLength(191);


        \View::composer('*', function($view){
            $categories = \Cache::rememberForever('categories', function(){
                return Category::all();
            });
            $makes = \Cache::rememberForever('makes', function(){
                return Make::all();
            });
            $models = \Cache::rememberForever('models', function(){
                return CarModel::all();
            });
            $cachedlistings = \Cache::rememberForever('cachedlistings', function(){
                return Listing::with('make','model')->approved()->get();
            });
            $recentnews = \Cache::remember('recentnews', now()->addMinutes(1), function(){
                return News::approved()->latest()->take(6)->get();
            });
            $view->with(['makes' => $makes, 'models' => $models, 'categories'=>$categories, 'cachedlistings'=>$cachedlistings, 'recentnews'=>$recentnews ]);
        });



        // Set the default template for Pagination to use the included Bootstrap 4 template
        \Illuminate\Pagination\AbstractPaginator::defaultView('pagination::bootstrap-4');
        \Illuminate\Pagination\AbstractPaginator::defaultSimpleView('pagination::simple-bootstrap-4');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*
         * Sets third party service providers that are only needed on local/testing environments
         */
        if ($this->app->environment() != 'production') {
            /**
             * Loader for registering facades.
             */
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();

            /*
             * Load third party local aliases
             */
            $loader->alias('Debugbar', \Barryvdh\Debugbar\Facade::class);
        }
    }
}



