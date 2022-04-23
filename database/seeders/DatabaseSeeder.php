<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'full_name' => 'HamroSaman Admin',
            'email' => 'admin@hamrosaman.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);
        User::factory(20)->create();
        collect(['Electronics','Furniture','Others'])->each(function($category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category)
            ]);
            // ])->each(function ($category) {
            //     $category->products()->saveMany(Product::factory(100)->make());
            // });
        });
    }
}
