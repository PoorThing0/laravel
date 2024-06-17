<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $orders = Order::where('email', $user->email)->orderByDesc('created_at')->get();

        return view('profile', compact('user', 'orders'));
    }
}
