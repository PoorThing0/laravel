<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Напитки']);
        Category::create(['name' => 'Роллы']);
        Category::create(['name' => 'Сеты']);
        Category::create(['name' => 'Пицца']);
        Category::create(['name' => 'Суши']);
        Category::create(['name' => 'Дополнительно']);
    }
}
