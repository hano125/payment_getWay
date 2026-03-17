<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    $courses = Course::paginate(9);
    $cart = \App\Models\Cart::where('session_id', session()->getId())->first();
    return view('welcome', get_defined_vars());
})->name('home');

Route::controller(CourseController::class)->group(function () {
    Route::get('courses/{course:slug}', 'show')->name('courses.show');
});

Route::controller(CartController::class)->group(function () {
    Route::get('cart', 'index')->name('cart.index');
    Route::get("add-to-cart/{course:slug}", "addToCart")->name("addToCart");
    Route::get("remove-from-cart/{course:slug}", "removeFromCart")->name("removeFromCart");
});

Route::controller(CheckOutController::class)->middleware('auth')->group(function () {
    Route::get('checkout', 'index')->name('checkout.index');
    Route::get('checkoutCupon', 'index1')->name('checkoutCupon.index');

    Route::get('checkout/success', 'success')->name('checkout-success');
    Route::get('checkout/cancel', 'cancel')->name('checkout-cancel');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
