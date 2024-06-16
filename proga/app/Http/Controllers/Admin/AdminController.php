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
}

