<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\HotelSetting;

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
    public function boot()
    {
        // Bagikan pengaturan hotel ke semua view
        View::composer('*', function ($view) {
            $hotelSetting = HotelSetting::with('photos')->first();
            $view->with('hotelSetting', $hotelSetting);
        });
    }
}
