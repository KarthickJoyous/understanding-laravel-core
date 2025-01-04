<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Interfaces\PaymentGatewayInterface;
use Illuminate\Http\Request;

class LoggerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, PaymentGatewayInterface $paymentGateway)
    {
        $orderId = rand();

        app(Logger::class)->push([
            'orderId' => $orderId,
            'status' => 'Initiating'
        ]);

        $paymentGateway->checkout($orderId);

        app(Logger::class)->push([
            'status' => 'Success'
        ]);

        return 'Logger';
    }
}
