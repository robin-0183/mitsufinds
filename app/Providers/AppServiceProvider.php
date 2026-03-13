<?php

namespace App\Providers;

use App\Models\AdminCredential;
use Illuminate\Support\Facades\Schema;
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
        if (Schema::hasTable('admin_credentials')) {
            $admin = AdminCredential::get();
            if ($admin) {
                config(['admin.email' => $admin->email]);
            }
        }
    }
}
