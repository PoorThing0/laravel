<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\PromoCode;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cartItems = $user->cartItems()->with('product')->get();
        $totalPrice = $this->calculateTotalPrice($cartItems);

        return view('cart.index', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'discount' => null,
            'finalPrice' => $totalPrice
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::find($request->input('product_id'));

        $cartItem = CartItem::where('user_id', Auth::id())
                            ->where('product_id', $product->id)
                            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Товар добавлен в корзину.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $cartItem = CartItem::findOrFail($id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Количество товара в корзине обновлено.');
    }

    public function delete($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Товар успешно удален из корзины.');
    }

    public function applyPromoCode(Request $request)
{
    $request->validate([
        'promo_code' => 'required|string',
    ]);

    $promoCode = PromoCode::where('code', $request->input('promo_code'))
                          ->where('is_active', true)
                          ->first();

    if (!$promoCode) {
        return redirect()->route('cart.index')->withErrors(['promo_code' => 'Неверный или неактивный промокод.']);
    }

    $discount = $promoCode->discount_percentage;
    $cartItems = auth()->user()->cartItems;
    $totalPrice = $this->calculateTotalPrice($cartItems);

    $discountAmount = ($totalPrice * $discount) / 100;
    $finalPrice = $totalPrice - $discountAmount;

    return view('cart.index', compact('cartItems', 'totalPrice', 'discount', 'discountAmount', 'finalPrice'))->with('promo_applied', true);
}

private function calculateTotalPrice($cartItems)
{
    $totalPrice = 0;

    foreach ($cartItems as $cartItem) {
        $totalPrice += $cartItem->product->price * $cartItem->quantity;
    }

    return $totalPrice;
}

}
