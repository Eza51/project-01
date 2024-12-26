<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * php artisan make:provider SEttiingServiceProvider
     * 
     * laravel machanism config.aap.php te giye check korbe...directly kaj korbe
     * cnfig e app.php te settingSERVICEPROVIDER ADD korsi
******COREHELPER r CONTROLLER jawar age ekhane kaj hosse
     * Register services.
     */
   
    // Get setting method CoreHelper
    public function register(): void
    {
        //register() function correctly registers the 'settings' binding in Laravel.
        // database theke settings nie key array te pass korlam
        $settings =  app('db')//path define..go to app and database
            ->table('settings')
            ->pluck('value', 'setting_name')//collumnname
            ->toArray();

        // Register a singleton binding named 'settings'..closure function()
        //eta bind kore $setting controller e pathassi
        $this->app->singleton('settings', function () use ($settings) {
            return $settings;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
