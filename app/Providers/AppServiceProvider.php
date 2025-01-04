<?php

namespace App\Providers;

use App\Http\Controllers\EmailService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->when(EmailService::class)
            ->needs('$email')
            ->give(rand() . '@app.com');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
