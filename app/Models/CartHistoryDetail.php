<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartHistoryDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }
}
