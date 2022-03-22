<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        if (\Cookie::get('language')) {
          \App::setLocale(\Crypt::decrypt(\Cookie::get('language'), false));
          // \App::setLocale('te', false);
        }
        //\App::setLocale('te', false);
        //echo \App::getLocale();
        //die();
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
