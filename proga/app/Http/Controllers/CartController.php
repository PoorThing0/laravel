<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::find($request->input('product_id'));

        // Найти элемент в корзине
        $cartItem = CartItem::where('user_id', Auth::id())
                            ->where('product_id', $product->id)
                            ->first();

        if ($cartItem) {
            // Увеличить количество
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Создать новый элемент в корзине
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Товар добавлен в корзину.');
    }
}
