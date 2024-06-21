<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CourierAuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('courier.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:couriers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $courier = Courier::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('courier')->login($courier);

        return redirect()->route('courier.orders')->with('success', 'Регистрация успешна');
    }

    public function showLoginForm()
    {
        return view('courier.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('courier')->attempt($credentials)) {
            return redirect()->route('courier.orders');
        }

        return back()->withErrors(['email' => 'Неправильный email или пароль']);
    }

    public function logout(Request $request)
    {
        Auth::guard('courier')->logout();

        return redirect()->route('courier.login');
    }
    
}
