<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function history()
    {
        $user=User::where('name',session('user'))->first();
        return view('history',['user' => $user]);
    }
}
