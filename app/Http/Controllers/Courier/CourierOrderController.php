<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CourierOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', 'доставляется')->get();

        return view('courier.orders', ['orders' => $orders]);
    }

    public function markAsDelivered($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'завершен';
        $order->save();

        return redirect()->route('courier.orders')->with('success', 'Статус заказа обновлен на "завершен"');
    }
}
