<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount'
    ];


    /**
     * Get the product that owns the order.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

      /**
     * Get the shopping cart that owns the order.
     */
    public function shopping_cart()
    {
        return $this->belongsTo(ShoppingCart::class);
    }
}
