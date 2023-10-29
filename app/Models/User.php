<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
       // 'password',
        'phone',
        'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];



   /**
     * Get the shopping carts for the user.
     */
    public function shopping_carts()
    {
        return $this->hasMany(ShoppingCart::class);
    }


   /**
     * Get the discount codes for the user.
     */
    public function discount_codes()
    {
        return $this->hasMany(DiscountCode::class);
    }

}
