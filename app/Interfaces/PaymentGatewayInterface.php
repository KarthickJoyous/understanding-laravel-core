<?php

namespace App\Interfaces;

interface PaymentGatewayInterface
{
    public function checkout($orderId);

    public function orders();
}
