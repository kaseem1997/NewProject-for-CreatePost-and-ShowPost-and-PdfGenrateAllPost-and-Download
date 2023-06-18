<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('mobile', 'otp');
        // Perform the authentication logic here, for example:
        if ($credentials['mobile'] === '1234567890' && $credentials['otp'] === '123456') {
            Auth::loginUsingId(1); // Assuming user with ID 1 is authenticated
            return redirect()->route('profile');
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid mobile number or OTP']);
        }
    }
    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }
}
