<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function index()
    {
        $cart = Cart::Session()->first();
        $price = $cart->courses->pluck("stripe_price_id")->toArray();
        $sessionOptions = [
            'success_url' => route('checkout-success') . '?session_id={CHECKOUT_SESSION_ID}',
            "cancel_url" => route('checkout-cancel') . '?session_id={CHECKOUT_SESSION_ID}',
            //"billing_address_collection" => "required", //add billing address information into stripe checkout page
            //"phone_number_collection" => ["enabled" =>    t  , //add phone number information into stripe checkout page
            "metadata" => [
                "user_id" => Auth::id(),
                "cart_id" => $cart->id,
            ],
        ];
        $customerOptions = [
            "email" => Auth::user()->email,
        ];
        return Auth::user()->checkout($price, $sessionOptions, $customerOptions);
    }

    public function index1()
    {
        $cart = Cart::Session()->first();
        $price = $cart->courses->pluck("stripe_price_id")->toArray();
        $sessionOptions = [
            'success_url' => route('home', ["message" => "Payment successful! Your courses have been added to your account.", "status" => "success"]),
            "cancel_url" => route('home', ["message" => "Payment was cancelled.", "status" => "error"]),
            // "allow_promotion_codes" => true, //enable stripe promotion code
            "metadata" => [
                "user_id" => Auth::id(),
                "cart_id" => $cart->id,
            ],
        ];

        $customerOptions = [
            "email" => Auth::user()->email,
        ];
        return Auth::user()->allowPromotionCodes()->checkout($price, $sessionOptions, $customerOptions);
    }

    public function success(Request $request)
    {
        $session = $request->user()->stripe()->checkout->sessions->retrieve($request->get('session_id'));
        if ($session->payment_status !== 'paid') {
            return to_route('home', [
                'message' => 'Payment failed! Please try again.',
                'status' => 'error',
            ]);
        }
        $cart = Cart::find($session->metadata->cart_id);
        if (!$cart) {
            return to_route('home', [
                'message' => 'Cart not found. Please try again.',
                'status' => 'error',
            ]);
        }
        $order = Order::create([
            "user_id" => $session->metadata->user_id,
        ]);

        $order->course()->attach($cart->courses->pluck('id')->toArray());
        $cart->delete();
        return to_route('home', [
            'message' => 'Payment successful! Your courses have been added to your account.',
            'status' => 'success',
        ]);
    }

    public function cancel()
    {
        return to_route('home', [
            'message' => 'Payment was cancelled.',
            'status' => 'error',
        ]);
    }
}
