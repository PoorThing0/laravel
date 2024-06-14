<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
                                                                        //!пидсказ0чка!
                                                                        //1 => 'Напитки'
                                                                        //2 => 'Роллы'
                                                                        //3 => 'Сеты'
                                                                        //4 => 'Пицца'
                                                                        //5 => 'Суши'
                                                                        //6 => 'Дополнительно'
    public function run()
    {
        Product::create([
            'name' => 'Феникс',
            'description' => 'Тунец, стружка тунца, сыр сливочный, сырный соус, соус унаги, кунжут белый',
            'price' => 339,
            'image' => 'roll1.png',
            'category_id' => 2
        ]);
    }
}

