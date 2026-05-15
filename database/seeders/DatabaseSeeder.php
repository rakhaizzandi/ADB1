<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Variant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        $product = Product::create([
            'name' => 'Laptop Slim',
            'price' => 15000000,
        ]);

        Variant::create([
            'name' => 'Slim i7',
            'description' => 'Laptop ringkas dengan performa tinggi.',
            'processor' => 'Intel Core i7',
            'memory' => '16 GB',
            'storage' => '512 GB SSD',
            'product_id' => $product->id,
        ]);
    }
}
