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
        DB::table('Categories')->insert([
            'name' => "POLO",
            'description' => "polo",
        ]);
        DB::table('Categories')->insert([
            'name' => "MANCHE LONGUE",
            'description' => "manche longue",
            'parent_id' => 1,
        ]);
        DB::table('Categories')->insert([
            'name' => "DEMI MANCHE",
            'description' => "demi manche",
            'parent_id' => 1,
        ]);
        DB::table('Categories')->insert([
            'name' => "BAGAGERIE",
        ]);
        DB::table('Categories')->insert([
            'name' => "SACS",
            'description' => "sacs",
            'parent_id' => 4,
        ]);
    }
}
