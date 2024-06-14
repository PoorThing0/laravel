<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Кола',
            'description' => 'Лимонад Добрый Кола',
            'price' => 149,
            'image' => '//public/images/water1.png',
            'category_id' => 1
        ]);
        
    }
}

