<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
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
        $validated = $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'address' => 'required',
            'f_payment' => 'required|numeric|min:0'
        ]);

        $success = '';
        $errors = '';

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);

        $success .= ' User with name: ' . $user->name . ' created successfully.';
        session(['user' =>  $user->name]);

        // check stock

        $all_products_names = Product::all()->pluck('name');
        $i = 0;
        foreach ($all_products_names as $pr_name) {
            $stock_amount = Product::where('name', $pr_name)->first()->stock_amount;
            foreach ($request->except('_token') as $key => $value) {
                if ($value > 0) {
                    if ($pr_name == $key) {
                        if ($stock_amount >= $value) {
                            Product::where('name', $pr_name)->first()->update([
                                'stock_amount' => $stock_amount - $value
                            ]);
                            $success .= ' Product ' . $pr_name . ' updated its stock successfully.';
                        } else {
                            $errors .= ' Product ' . $pr_name . ' not enough in stock.';
                        }
                    }
                }
            }
        }

        return redirect('/')->with('success', $success)->withErrors($errors);
    }

    function logout(Request $request){
        Session::flush();
        $success="You have been logged out successfully.";
        return redirect('/')->with('success', $success);
    }
}
