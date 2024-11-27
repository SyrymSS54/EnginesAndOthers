<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\Auth\signin;
use App\Http\Requests\Customer\Auth\signup;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Customer\CustomerModel;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index_signin()
    {
        return view('customer.auth.signin',['name'=>'Sign In']);
    }

    public function index_signup()
    {
        return view('customer.auth.signup',['name'=>'Sign Up']);
    }

    public function signin(signin $signin)
    {
        $validated = $signin->safe()->only(['email','password']);
        $validated['role'] = 'customer';

        if (Auth::attempt($validated)) {
            $signin->session()->regenerate();

            return redirect(route('customer.personal'));
        }

        return back()->withErrors(['status' => 'password or email']);

    }

    public function signup(signup $signup,User $user,CustomerModel $customerModel)
    {
        $validated = $signup->safe()->only(['last_name','first_name','tel','birth','email','password']);
        $validated['role'] = 'customer';

        $user->role = $validated['role'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->save();
        $customerModel->last_name = $validated['last_name'];
        $customerModel->first_name = $validated['first_name'];
        $customerModel->tel = $validated['tel'];
        $customerModel->birth = $validated['birth'];
        $user->customer()->save($customerModel);

        return redirect(route('customer.personal'));
    }
}
