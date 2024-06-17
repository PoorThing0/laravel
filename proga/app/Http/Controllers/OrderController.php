<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showCheckoutPage()
    {
        return view('checkout');
    }

    public function create()
    {
        return view('order.create');
    }

    public function store(Request $request)
    {
        // Проверка на наличие товаров в корзине перед оформлением заказа
        $cartItems = CartItem::all();
        if ($cartItems->isEmpty()) {
            return redirect()->route('order.create')->withErrors(['cart' => 'Ваша корзина пуста.']);
        }

        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'delivery_type' => 'required|in:pickup,delivery',
            'delivery_address' => 'nullable|string|max:255',
        ]);

        if ($request->delivery_type === 'delivery' && empty($request->delivery_address)) {
            return redirect()->route('order.create')
                ->withErrors(['delivery_address' => 'Адрес доставки обязателен при выборе доставки.']);
        }

        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $order = Order::create([
            'user_name' => $validated['user_name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'delivery_type' => $validated['delivery_type'],
            'delivery_address' => $validated['delivery_address'],
            'total_price' => $totalPrice,
        ]);

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_name' => $cartItem->product->name,
                'price' => $cartItem->product->price,
                'quantity' => $cartItem->quantity,
                'total' => $cartItem->product->price * $cartItem->quantity,
            ]);
        }

        CartItem::truncate();

        return redirect()->route('order.create')->with('success', 'Заказ успешно оформлен.');
    }
}
