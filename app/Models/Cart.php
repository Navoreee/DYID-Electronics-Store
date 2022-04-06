<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cart_detail()
    {
        return $this->hasMany(CartDetail::class, 'cart_id');
    }

    public function cart_history_detail()
    {
        return $this->hasMany(CartHistoryDetail::class, 'cart_id');
    }
}
