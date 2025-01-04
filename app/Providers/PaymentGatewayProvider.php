<?php

namespace App\Providers;

use App\Http\Controllers\StripeController;
use App\Interfaces\PaymentGatewayInterface;
use App\PaymentGatewayServices\{PaypalService, StripeService};
use Illuminate\Support\ServiceProvider;

class PaymentGatewayProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->when(StripeController::class)
            ->needs(PaymentGatewayInterface::class)
            ->give(StripeService::class);

        $this->app->bind(PaymentGatewayInterface::class, function ($app) {
            return $app->make(PaypalService::class);
        });

        $this->app->when(StripeController::class)
            ->needs('$orderId')
            ->give(rand());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
