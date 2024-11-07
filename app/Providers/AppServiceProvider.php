<?php

namespace App\Providers;

use App\Http\Controllers\SidebarController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        // Gunakan View Composer untuk memuat sidebar di semua view
        // View::composer('*', function ($view) {
        //     $sidebarController = new SidebarController();
        //     $menus = $sidebarController->index();
        //     $view->with('menus', $menus);
        // });

        Paginator::useBootstrap();
    }
}
