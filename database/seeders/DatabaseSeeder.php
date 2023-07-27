<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Clothes;
use App\Models\sizeClothes;
use App\Models\User;
use App\Models\Home;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // admin seeder
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345'),
            'is_admin' => 1
        ]);

        // User::factory(3)->create();

        // Clothes::factory(25)->create();


        // Category::create([
        //     "name" => "Shirt",
        //     "slug" => "shirt"
        // ]);

        // Category::create([
        //     "name" => "Sweater",
        //     "slug" => "sweater"
        // ]);
        // Category::create([
        //     "name" => "Hoodie",
        //     "slug" => "hoodie"
        // ]);
    }
}
