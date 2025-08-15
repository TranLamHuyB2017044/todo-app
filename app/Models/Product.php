<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'price',
    ];



    protected $appends = ['total_price'];

    public function getTotalPriceAttribute()
    {
        return $this->price * $this->quantity;
    }
}
