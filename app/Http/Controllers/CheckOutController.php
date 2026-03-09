<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    public function index()
    {
        $cart =Cart::Session()->first();
        $price = $cart->courses->pluck("stripe_product_id")->toArray();
        return Auth::user()->newSubscription('default', $price)->checkout();

    }
}
