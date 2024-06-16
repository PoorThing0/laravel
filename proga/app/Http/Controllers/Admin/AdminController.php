<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
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

        // Всегда устанавливаем is_active в false (0)
        $validated['is_active'] = 0;

        PromoCode::create($validated);

        return redirect()->route('admin.index')->with('success', 'Промокод успешно создан');
    }
}
