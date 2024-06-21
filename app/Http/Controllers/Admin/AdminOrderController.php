<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders', ['orders' => $orders]);
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate([
            'status' => 'required|string|in:оформлен,принят,доставляется,завершен'
        ]);
        $order->status = $request->input('status');
        $order->save();
        
        return redirect()->route('admin.orders')->with('success', 'Статус заказа обновлен');
    }
}
