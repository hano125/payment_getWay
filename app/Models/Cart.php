<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Laravel\Cashier\Cashier;

class Cart extends Model
{
    protected $guarded = [];



    public function courses(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'cart_create');
    }

    public function cartEmpty(): bool
    {
        return $this->courses()->count() === 0;
    }

    public function scopeSession(Builder $query): Builder
    {
        return  $query->where("session_id", session()->getId());
    }

    #[Scope]
    protected function total()
    {
        return  Cashier::formatAmount($this->courses->sum("price"), "USD");
    }




}
