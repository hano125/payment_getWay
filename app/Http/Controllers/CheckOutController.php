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
        return Auth::user()->checkout($price);
    }
}
