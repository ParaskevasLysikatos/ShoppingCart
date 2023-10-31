<?php

namespace App\Http\Controllers;

use App\Models\DiscountCode;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function history()
    {
        $user=User::where('name',session('user'))->first();

        $shopping_carts=ShoppingCart::with('discount_code')->with('orders')->where('user_id',$user->id)->get()->map(
            function($shopping_cart){
                return [
                    'id' => $shopping_cart->id,
                    'discount_code' => $shopping_cart->discount_code->discount_code ?? '' ,
                    'user'=>$shopping_cart->user->name,
                    'payment'=>$shopping_cart->payment,
                    'final_payment' => $shopping_cart->final_payment,
                    'orders'=>$shopping_cart->orders->map(function($order){
                        return[
                            'id' => $order->id,
                            'shopping_cart_id' => $order->shopping_cart_id,
                            'product' => $order->product->name .'('.$order->product->price.'€)',
                            'amount'=>$order->amount,
                            'total_cost'=>$order->total_cost
                        ];
                    })
                ];
            });
       // dd($shopping_carts);

        return view('history',['user' => $user, 'shopping_carts' => $shopping_carts]);
    }


    public function discount_codes()
    {
        $user=User::where('name',session('user'))->first();

        $discount_codes=DiscountCode::with('user')->with('shopping_cart')->where('user_id',$user->id)->get()->map(
            function($d){
                return [
                    'id' => $d->id,
                    'discount_code' => $d->discount_code ,
                    'user'=>$d->user->name,
                    'amount'=>$d->amount,
                    'used' => $d->used,

                    'shopping_cart_id' => $d->shopping_cart->id ?? '',
                    'shopping_cart_payment' => $d->shopping_cart->payment ?? '',
                    'shopping_cart_final_payment' => $d->shopping_cart->final_payment ?? ''
                ];
            });
       // dd($discount_codes);

        return view('discount_codes',['discount_codes' => $discount_codes]);
    }
}
