<?php

// database/seeders/SubcategorySeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategorySeeder extends Seeder
{
    public function run()
    {
        $subcategories = [
            ['name' => 'Fruits'],
            ['name' => 'Vegetables'],
            ['name' => 'Beverages'],
            ['name' => 'Snacks'],
            ['name' => 'Dairy'],
        ];

        foreach ($subcategories as $subcategory) {
            DB::table('subcategories')->insert([
                'name' => $subcategory['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

