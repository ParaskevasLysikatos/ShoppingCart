<?php

namespace App\Http\Controllers;

use App\Models\DiscountCode;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }


    public function welcome()
    {

        $products = Product::all();
        $final_payment = 0.00;

        return view('welcome-shopping', [
            'products' => $products,
            'final_payment' => $final_payment
        ]);
    }


    public function detailProductAmount(Request $request)
    {
        $mobile_amount = $request->input('mobile_phone');
        $laptop_amount = $request->input('laptop');
        $tablet_amount = $request->input('tablet');

        $html = "The shopping cart contains: <br>";
        if ($mobile_amount > 0) {
            $html .= "mobile_phone with amount of " . $mobile_amount . "<br>";
        }

        if ($laptop_amount > 0) {
            $html .= "laptop with amount of " . $laptop_amount . "<br>";
        }

        if ($tablet_amount > 0) {
            $html .= "tablet with amount of " . $tablet_amount . "<br>";
        }

        return $html;
    }


    public function finalPayment(Request $request)
    {
        $mobile_amount = $request->input('mobile_phone');
        $laptop_amount = $request->input('laptop');
        $tablet_amount = $request->input('tablet');
        $final_payment = 0;

        if ($mobile_amount > 0) {
            $price = Product::where('name', 'mobile_phone')->first()->price;
            $final_payment += $price * $mobile_amount;
        }

        if ($laptop_amount > 0) {
            $price = Product::where('name', 'laptop')->first()->price;
            $final_payment += $price * $laptop_amount;
        }

        if ($tablet_amount > 0) {
            $price = Product::where('name', 'tablet')->first()->price;
            $final_payment += $price * $tablet_amount;
        }

        return $final_payment;
    }

    public function checkout(Request $request)
    {
        $success = '';
        $errors = '';

        if ($request->input('user_exists')) {
            //  user exists
            $validated = $request->validate([
                'email' => 'required|exists:users,email',
                'f_payment' => 'required|numeric|gt:0',
                'discount_code' => 'nullable|exists:discount_codes,discount_code'
            ]);
            $user=User::where('email', $request->input('email'))->first();
            session(['user' =>  $user->name]);

        } else {
            $validated = $request->validate([
                'name' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'phone' => 'required',
                'address' => 'required',
                'f_payment' => 'required|numeric|gt:0',
                'discount_code' => 'nullable|exists:discount_codes,discount_code'
            ]);

            //  create a user
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
            ]);

            $success .= ' User with name: ' . $user->name . ' created successfully.@@';
            session(['user' =>  $user->name]);
        }

        // check stock

        $all_products_names = Product::all();
        $for_orders_array = [];
        foreach ($all_products_names as $pr) {
            $stock_amount = Product::where('name', $pr->name)->first()->stock_amount;
            foreach ($request->except('_token') as $key => $value) {
                if ($value > 0) {
                    if ($pr->name == $key) {
                        if ($stock_amount >= $value) {
                            Product::where('name', $pr->name)->first()->update([
                                'stock_amount' => $stock_amount - $value
                            ]);
                            $success .= ' Product ' . $pr->name . ' updated its stock successfully.@@';
                            array_push($for_orders_array, ['product_id' => $pr->id, 'amount' => $value ,'total_cost' => $value * $pr->price]);
                        } else {
                            $errors .= ' Product ' . $pr->name . ' not enough in stock.';
                        }
                    }
                }
            }
        }

        // has discount code
        $discount = 0;
        if ($request->input('discount_code')) {
            $dis=DiscountCode::where('discount_code',$request->input('discount_code'))->first();
            $discount_code_id = $dis->id;
            $discount = $dis->amount;
            $dis->update([ 'used' => true]);
            $success .= ' You have used a discount code ' . $dis->discount_code . ' €.@@';
        } else {
            $discount_code_id = null;
        }


        // create the Shopping cart
        $shopping_cart = ShoppingCart::create([
            'user_id' => $user->id,
            'discount_code_id' => $discount_code_id,
            'payment' => $request->input('f_payment'),
            'final_payment' => $request->input('f_payment') - $discount,
        ]);

        $success .= ' You have paid ' . $shopping_cart->final_payment . ' €.@@';

        // create orders
       //dd($shopping_cart->id);
        foreach ($for_orders_array as  $for) {
            Order::Create([
                'shopping_cart_id' => $shopping_cart->id,
                'product_id' => $for['product_id'],
                'amount' => $for['amount'],
                'total_cost' => $for['total_cost']
            ]);
        }

        // create a discount code

        return redirect('/')->with('success', $success)->withErrors($errors);
    }

    function logout(Request $request)
    {
        Session::flush();
        $success = "You have been logged out successfully.";
        return redirect('/')->with('success', $success);
    }

  
}
