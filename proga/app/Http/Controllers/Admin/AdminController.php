<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;

class AdminController extends Controller
{
    public function index()
    {
        $promoCodes = PromoCode::all();
        return view('admin.index', compact('promoCodes'));
    }
}

