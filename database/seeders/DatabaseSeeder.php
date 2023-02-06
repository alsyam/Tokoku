<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Clothes;
use App\Models\sizeClothes;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Muhammad Al Syam',
            'username' => 'muhammadalsyam',
            'email' => 'malsyam69@gmail.com',
            'password' => bcrypt('12345')
        ]);

        User::factory(3)->create();

        Clothes::factory(25)->create();


        Category::create([
            "name" => "Shirt",
            "slug" => "shirt"
        ]);

        Category::create([
            "name" => "Sweater",
            "slug" => "sweater"
        ]);
        Category::create([
            "name" => "Hoodie",
            "slug" => "hoodie"
        ]);
    }
}
