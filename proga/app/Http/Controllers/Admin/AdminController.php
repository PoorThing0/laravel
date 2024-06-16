<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\PromoCode;
use App\Models\Category; // Добавлен импорт модели Category
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $promoCodes = PromoCode::all();
        return view('admin.index', compact('promoCodes'));
    }

    public function destroy($id)
    {
        $promoCode = PromoCode::findOrFail($id);
        $promoCode->delete();

        return redirect()->route('admin.index')->with('success', 'Промокод успешно удалён');
    }

    public function toggleActivation($id)
    {
        $promoCode = PromoCode::findOrFail($id);
        $promoCode->is_active = !$promoCode->is_active;
        $promoCode->save();

        return redirect()->route('admin.index')->with('success', 'Активация промокода успешно изменена');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255|unique:promo_codes,code',
            'discount_percentage' => 'required|numeric|between:0,100',
        ]);

        $validated['is_active'] = 0;

        PromoCode::create($validated);

        return redirect()->route('admin.index')->with('success', 'Промокод успешно создан');
    }
    
    public function products()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Товар успешно удалён');
    }

    public function createProduct()
    {
        $categories = Category::all();
        return view('admin.create-product', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $imageName = $request->file('image')->getClientOriginalName();

        $imagePath = $request->file('image')->storeAs('public/images', $imageName);

        $product = new Product([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'price' => $request->input('price'),
            'image' => $imageName,
        ]);

        $product->save();

        return redirect()->route('admin.products')->with('success', 'Товар успешно создан');
    }
}
