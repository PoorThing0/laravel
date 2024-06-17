<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order; // Убедитесь, что этот use-инструкция правильно указывает на модель Order

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        return view('admin.orders.index', ['orders' => $orders]);
    }

}
