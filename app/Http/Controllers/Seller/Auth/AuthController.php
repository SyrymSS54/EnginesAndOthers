<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Seller\Auth\SignIn;
use App\Http\Requests\Seller\Auth\Signup;
use App\Models\Seller\SellerModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index_signin()
    {
        return view('seller.auth.signin',['name' => 'Sign In']);
    }

    public function index_signup()
    {
        return view('seller.auth.signup',['name' => 'Sign Up']);

    }

    public function signin(SignIn $signin)
    {
        $validated = $signin->safe()->only(['email','password']);
        $validated['role'] = 'seller';

        if (Auth::attempt($validated)) {
            $signin->session()->regenerate();

            return redirect(route('seller.personal'));
        }

        return back()->withErrors(['status' => 'password or email']);
    }

    public function signup(Signup $signup,User $user,SellerModel $sellerModel)
    {
        $validated = $signup->safe()->only(['company_name','email','password']);
        $validated['role'] = 'seller';

        $user->role = $validated['role'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->save();
        $sellerModel->company_name = $validated['company_name'];
        $user->seller()->save($sellerModel);

        return redirect(route('seller.personal'));
    }
}
