<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        if ($request->has('category')) {
            $products = Product::whereHas('category', function ($query) use ($request) {
                $query->where('name', $request->category);
            })->get();
        } else {
            $products = Product::all();
        }

        return view('catalog', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}