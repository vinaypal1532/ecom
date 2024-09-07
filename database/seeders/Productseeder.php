<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'subcategory_id' => 1,
                'name' => 'Apple',
                'description' => 'Fresh and juicy apples.',
                'price' => 3.50,
                'stock' => 100,
                'image' => 'apple.jpg', // Example image filename
                'type' => 'fruit',
            ],
            [
                'subcategory_id' => 2,
                'name' => 'Orange',
                'description' => 'Sweet and tangy oranges.',
                'price' => 2.75,
                'stock' => 200,
                'image' => 'orange.jpg',
                'type' => 'fruit',
            ],
            [
                'subcategory_id' => 3,
                'name' => 'Banana',
                'description' => 'Ripe and delicious bananas.',
                'price' => 1.50,
                'stock' => 150,
                'image' => 'banana.jpg',
                'type' => 'fruit',
            ],
            [
                'subcategory_id' => 4,
                'name' => 'Strawberry',
                'description' => 'Fresh strawberries.',
                'price' => 4.00,
                'stock' => 50,
                'image' => 'strawberry.jpg',
                'type' => 'fruit',
            ],
            [
                'subcategory_id' => 5,
                'name' => 'Pumpkin',
                'description' => 'Large and ripe pumpkins.',
                'price' => 5.25,
                'stock' => 30,
                'image' => 'pumpkin.jpg',
                'type' => 'vegetable',
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'subcategory_id' => $product['subcategory_id'],
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'image' => $product['image'],
                'type' => $product['type'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
