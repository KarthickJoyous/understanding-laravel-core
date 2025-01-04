<?php

namespace App\Http\Controllers;

use App\Interfaces\PaymentGatewayInterface;
use App\PaymentGatewayServices\PaypalService;

class StripeController extends Controller
{
    /**
     * The default checkout method is invoked when the controller is initialized.
     * It uses dependency injection to receive a PaymentGatewayInterface implementation 
     * and an order ID. The bound service (StripeService) will be used here.
     * 
     * PaymentGatewayInterface resolved from PaymentGatewayProvider.
     * Explictly defined to use StripeService when StripeController instanciated.
     */
    public function __construct(private PaymentGatewayInterface $paymentGateway, private $orderId) {}

    /**
     * Performs a checkout using the injected PaymentGatewayInterface and the order ID.
     * This method is called without any additional arguments and uses the service
     * bound in the service container (StripeService).
     */
    public function checkout()
    {
        return $this->paymentGateway->checkout($this->orderId);
    }

    /**
     * Performs a custom checkout using dependency injection in the method argument.
     * The PaymentGatewayInterface implementation is passed explicitly at runtime, 
     * overriding the default service injected in the constructor.
     * 
     * PaymentGatewayInterface resolved from PaymentGatewayProvider.
     * Explictly defined to use PaypalService when PaymentGatewayInterface is injected.
     *
     * @param PaymentGatewayInterface $paymentGateway The specific payment gateway to use.
     */
    public function customCheckoutWithDI(PaymentGatewayInterface $paymentGateway)
    {
        return $paymentGateway->checkout($this->orderId);
    }

    /**
     * Performs a custom checkout without dependency injection.
     * This method manually creates a new instance of PaypalService, ignoring the default service container binding.
     * 
     * @return mixed The result of the checkout process using PaypalService.
     */
    public function customCheckoutWithoutDI()
    {
        $paymentGateway = new PaypalService();

        return $paymentGateway->checkout($this->orderId);
    }
}
