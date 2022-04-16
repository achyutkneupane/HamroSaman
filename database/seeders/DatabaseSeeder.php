<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(20)->create();
        User::create([
            'full_name' => 'Achyut Neupane',
            'email' => 'achyutkneupane@gmail.com',
            'password' => Hash::make('Ghost0vperditi0n'),
        ]);
        Category::factory(5)->create()->each(function ($category) {
            $category->products()->saveMany(Product::factory(10)->make());
        });
    }
}
