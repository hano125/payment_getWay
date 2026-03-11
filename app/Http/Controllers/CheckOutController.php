<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    public function index()
    {
        $cart = Cart::Session()->first();
        $price = $cart->courses->pluck("stripe_price_id")->toArray();
        $session_options = [
            "success_url" => route("home", ["message" => "Payment successful", "status" => "success"]),
            "cancel_url" => route("home", ["message" => "Payment cancelled", "status" => "error"]),
            //"billing_address_collection" => "required", //add billing address information into stripe checkout page
            //"phone_number_collection" => ["enabled" => true], //add phone number information into stripe checkout page
        ];
        return Auth::user()->checkout($price, $session_options);
    }
}
