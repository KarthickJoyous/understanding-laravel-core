<?php

namespace App\PaymentGatewayServices;

use App\Helpers\Logger;
use App\Interfaces\PaymentGatewayInterface;

class PaypalService implements PaymentGatewayInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(private $class = __CLASS__)
    {
        //
    }

    public function checkout($orderId)
    {
        app(Logger::class)->push([
            'status' => 'Processing Paypal Checkout'
        ]);

        return [
            'class' => $this->class,
            'orderId' => $orderId
        ];
    }

    public function orders()
    {
        return "Orders : {$this->class}";
    }
}
