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
        DB::table('sizes')->insert([
            'size' => "XS",
        ]);
        DB::table('sizes')->insert([
            'size' => "S",
        ]);
        DB::table('sizes')->insert([
            'size' => "M",
        ]);
        DB::table('sizes')->insert([
            'size' => "L",
        ]);
        DB::table('sizes')->insert([
            'size' => "XL",
        ]);
        DB::table('sizes')->insert([
            'size' => "2XL",
        ]);
        DB::table('sizes')->insert([
            'size' => "3XL",
        ]);
        DB::table('sizes')->insert([
            'size' => "4XL",
        ]);
        DB::table('sizes')->insert([
            'size' => "5Xl",
        ]);
        DB::table('sizes')->insert([
            'size' => "6XL",
        ]);
        DB::table('sizes')->insert([
            'size' => "TU",
        ]);
        DB::table('sizes')->insert([
            'size' => "150",
        ]);
        DB::table('sizes')->insert([
            'size' => "145",
        ]);
        DB::table('sizes')->insert([
            'size' => "140",
        ]);
        DB::table('sizes')->insert([
            'size' => "135",
        ]);
        DB::table('sizes')->insert([
            'size' => "130",
        ]);
        DB::table('sizes')->insert([
            'size' => "125",
        ]);
        DB::table('sizes')->insert([
            'size' => "120",
        ]);
        DB::table('sizes')->insert([
            'size' => "115",
        ]);
        DB::table('sizes')->insert([
            'size' => "110",
        ]);
        DB::table('sizes')->insert([
            'size' => "105",
        ]);
        DB::table('sizes')->insert([
            'size' => "64",
        ]);
        DB::table('sizes')->insert([
            'size' => "62",
        ]);
        DB::table('sizes')->insert([
            'size' => "60",
        ]);
        DB::table('sizes')->insert([
            'size' => "38",
        ]);
        DB::table('sizes')->insert([
            'size' => "44",
        ]);
    }
}
