<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
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
        $gcategories = Category::where('status', 0)->orderBy('created_at', 'DESC')->get();
        View::share('gcategories', $gcategories);

        $gsetting = Setting::first();
        View::share('appSetting', $gsetting);
    }
}
