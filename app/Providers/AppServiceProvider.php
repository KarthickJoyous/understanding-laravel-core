<?php

namespace App\Providers;

use App\Helpers\Helper;
use App\Facades\HelperFacade;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\EmailService;
use Illuminate\Foundation\AliasLoader;
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

        $this->app->bind(Helper::class, function () {
            return new Helper(rand());
        });

        $this->app->alias(Helper::class, 'helper');

        /*
            Set-up alias for Facades
        */

        AliasLoader::getInstance([
            'Help' => HelperFacade::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DB::listen(function ($query) {
            // info($query->sql, $query->bindings, $query->time);
        });
    }
}
