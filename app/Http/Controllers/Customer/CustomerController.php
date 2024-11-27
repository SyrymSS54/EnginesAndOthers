<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer\CustomerModel;
use App\Models\User;

class CustomerController extends Controller
{
    public function index(User $user)
    {
        return view('customer.personal',["user" => Auth::user(),"customer" => Auth::user()->customer]);
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect(route('customer.auth.get.signin'));
    }
}
