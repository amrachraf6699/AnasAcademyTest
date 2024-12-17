<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Seed some users for autentication
        User::factory()->count(10)->create();
        User::factory()->seller()->create();

        
        //Call seeders
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
    }
}
