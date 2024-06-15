<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PromoCode;

class PromoCodesTableSeeder extends Seeder
{
    public function run()
    {
        PromoCode::truncate(); // Очистка таблицы перед заполнением

        PromoCode::create([
            'code' => 'SKIDKA10',
            'discount_percentage' => 10,
            'is_active' => true,
        ]);

        PromoCode::create([
            'code' => 'PYATERKA',
            'discount_percentage' => 5,
            'is_active' => true,
        ]);
    }
}
