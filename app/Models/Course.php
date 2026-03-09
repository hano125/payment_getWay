<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Cashier;

class Course extends Model
{
    protected $guarded = [];

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_create');
    }


    #[Scope]
    protected function Price()
    {
        return  Cashier::formatAmount($this->price, "USD");
    }
}
