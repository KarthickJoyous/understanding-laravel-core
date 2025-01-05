<?php

namespace App\Http\Controllers;

use App\Models\Wallet;

class WalletController extends Controller
{
    public function show(Wallet $wallet)
    {
        return $wallet;
    }
}
