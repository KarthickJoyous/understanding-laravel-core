<?php

namespace App\PaymentGatewayServices;

use App\Interfaces\PaymentGatewayInterface;

class StripeService implements PaymentGatewayInterface
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
