<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gateway;

class PaymentController extends Controller
{
    public function user()
    {

    }

    public function userCallback(Request $request)
    {

    }

    public function payment(Request $request)
    {
        $gateway = Gateway::find($request->gateway_id);
        if($gateway) {
            $hash = password_hash($gateway->gateway_id . $gateway->payment_password . $request->gateway_order_id . $request->amount, PASSWORD_BCRYPT);
            $payment_hash = $request->hash;
            if($hash == $payment_hash) {
                
            } else {
                //CallBack with error with hashing
            }
        } else {
            //No Gateway By This ID.
        }
    }

    public function callback(Request $request)
    {

    }
}
