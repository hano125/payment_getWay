<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where("session_id", session()->getId())->first();
        return view('carts.index', get_defined_vars());
    }

    public function addToCart(Course $course):redirectResponse
    {
        $cart = Cart::firstOrCreate([
            "session_id" => session()->getId(),
        ]);
        $cart->courses()->syncWithoutDetaching($course);
        return back();
    }

    public function removeFromCart(Course $course):redirectResponse
    {
        $cart = Cart::Session()->first();
        abort_unless($cart, 404);
        $cart?->courses()->detach($course);
        return back();
    }

}
