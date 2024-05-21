<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{

    public function index()
    {
        $paymentMethod = PaymentMethod::get();
        if ($paymentMethod) {
            return response()->json(['payment_method' => $paymentMethod], 200);
        }
        else{
            return response()->json(['error' => 'Error in Query'], 400);
        }

    }



}

