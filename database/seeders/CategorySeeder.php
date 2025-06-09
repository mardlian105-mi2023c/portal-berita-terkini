<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Olahraga']);
        Category::create(['name' => 'Ekonomi']);
        Category::create(['name' => 'Hiburan']);
        Category::create(['name' => 'Internasional']);
        Category::create(['name' => 'Pendidikan']);
        Category::create(['name' => 'Sosial']);
        Category::create(['name' => 'Pembangunan']);
        Category::create(['name' => 'Wisata']);
        Category::create(['name' => 'Budaya']);
        Category::create(['name' => 'Kuliner']);
    }
}