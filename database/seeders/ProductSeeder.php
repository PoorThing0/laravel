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
                                                                        //Product::where('name', '')->delete();
    public function run()
    {
        Product::create([
            'name' => 'Комбо 4 пиццы: 30см',
            'description' => 'Для тех, кто любит сытно!',
            'price' => 1785,
            'image' => 'piz7.png',
            'category_id' => 4
        ]);
    }
}

