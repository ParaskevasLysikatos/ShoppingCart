<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;


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

        return view('welcome-shopping',[
            'products' => $products
        ]);
    }


    public function detailProductAmount(Request $request)
    {
        $mobile_amount = $request->input('mobile_phone');
        $laptop_amount = $request->input('laptop');
        $tablet_amount = $request->input('tablet');

        $html= "The shopping cart contains: <br>";
        if($mobile_amount>0){
            $html.= "mobile_phone with amount of ".$mobile_amount. "<br>";
        }

        if($laptop_amount>0){
            $html.= "laptop with amount of ".$laptop_amount. "<br>";
        }

        if($tablet_amount>0){
            $html.= "tablet with amount of ".$tablet_amount. "<br>";
        }

        return $html;

    }

}