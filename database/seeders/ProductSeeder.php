<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Product::create([
                    'name' => 'Product ' . $i,
                    'price' => rand(100, 1000),
                    'quantity' => rand(1, 100),
                    'category_id' => Category::inRandomOrder()->first()->id,
                ]);
        }
    }
}
