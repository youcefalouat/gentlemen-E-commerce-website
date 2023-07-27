<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Size')->insert([
            'size' => "S",
        ]);
        DB::table('Size')->insert([
            'size' => "M",
        ]);
        DB::table('Size')->insert([
            'size' => "TU",
        ]);
        DB::table('Size')->insert([
            'size' => "60",
        ]);
        DB::table('Size')->insert([
            'size' => "38",
        ]);
        DB::table('Size')->insert([
            'size' => "44",
        ]);
    }
}
