<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name' => "polo1",
            'description' => "polo 1 mache longue",
            'price' => "5000",
            'category_id' => 2,
            'brand_id' => 1,
        ]);

    }
}
