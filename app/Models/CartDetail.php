<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}