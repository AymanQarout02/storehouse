<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'ayman@example.com'],
            [
                'name' => 'Ayman Admin',
                'password' => Hash::make('a12345678'),
                'role' => 'admin',
            ]
        );

        User::factory()->manager()->count(10)->create();

        User::factory()->count(20)->create();

        $categories = Category::factory(20)->create();

        Product::factory(60)->create()->each(function ($product) use ($categories) {
            $product->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
