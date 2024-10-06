<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

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
        Paginator::useBootstrap();
        $settingApp = Setting::first();
        $setting = [
            'app_name' => $settingApp ? $settingApp->app_name : 'Agung Dwi Nugroho',
            'app_description' => $settingApp ? $settingApp->app_description : 'Programmer & Web Developer',
            'app_profile' => $settingApp ? $settingApp->app_profile : 'https://via.placeholder.com/150',
            'app_favicon' => $settingApp ? $settingApp->app_favicon : 'https://via.placeholder.com/150',
            'app_telp' => $settingApp ? $settingApp->app_telp : '081234567890',
            'app_email' => $settingApp ? $settingApp->app_email : 'admin@gmail.com',
            'app_ig' => $settingApp ? $settingApp->app_ig : 'https://instagram.com',
            'app_linkedin' => $settingApp ? $settingApp->app_linkedin : 'https://linkedin.com',
        ];
        View::share('global_setting', $setting);
    }
}
