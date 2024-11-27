<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function index(User $user)
    {
        return view('seller.personal',["user" => Auth::user(),"seller" => Auth::user()->seller]);
    }
}
