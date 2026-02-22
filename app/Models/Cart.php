<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'cart_create');
    }

    public function cartEmpty()
    {
        return $this->courses()->count() === 0;
    }
}
