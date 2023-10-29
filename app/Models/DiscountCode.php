<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount_code',
        'amount',
        'used'
    ];


        /**
     * Get the user that owns the discount_code.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the shopping cart associated with the discount code.
     */
    public function shopping_cart()
    {
        return $this->hasOne(ShoppingCart::class);
    }
}
