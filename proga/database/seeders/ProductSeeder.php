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
                                                                        //php artisan db:seed --class=ProductSeeder 
    public function run()
    {
        Product::create([
            'name' => 'Сет Исключительный',
            'description' => 'Филе лосося, пикантные нотки унаги и свежий зеленый лук. Царственное удовольствие!',
            'price' => 959,
            'image' => 'set1.png',
            'category_id' => 3
        ]);
    }
}

