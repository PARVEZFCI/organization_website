<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share cached layout data with all frontend views to avoid repeated queries
        View::composer('frontend.layouts.app', function ($view) {
            $settings = Cache::remember('site_settings', 3600, function () {
                return DB::table('settings')->orderBy('id', 'DESC')->first();
            });

            $footerServices = Cache::remember('footer_services', 3600, function () {
                return \App\Models\OurService::latest()
                    ->select('id', 'title')
                    ->limit(6)
                    ->get();
            });

            $view->with('settings', $settings);
            $view->with('ourServices', $footerServices);
        });
    }
}
