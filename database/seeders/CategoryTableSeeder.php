<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'name' => "POLO",
            'description' => "polo",
        ]);
        DB::table('categories')->insert([
            'name' => "MANCHE LONGUE",
            'description' => "manche longue",
            'parent_id' => 1,
        ]);
        DB::table('categories')->insert([
            'name' => "DEMI MANCHE",
            'description' => "demi manche",
            'parent_id' => 1,
        ]);
        DB::table('categories')->insert([
            'name' => "BAGAGERIE",
        ]);
        DB::table('categories')->insert([
            'name' => "SACS",
            'description' => "sacs",
            'parent_id' => 4,
        ]);
    }
}
