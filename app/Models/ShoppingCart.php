<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;


    protected $fillable = [
        'final_payment',
        'payment',
        'user_id',
        'discount_code_id'

    ];

    /**
     * Get the user that owns the shopping cart.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get the orders for the shopping cart.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

     /**
     * Get the discount code that owns the shopping cart.
     */
    public function discount_code()
    {
        return $this->belongsTo(DiscountCode::class);
    }
}
