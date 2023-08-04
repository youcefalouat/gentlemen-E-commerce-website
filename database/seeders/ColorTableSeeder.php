<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('colors')->insert([
            'name' => "BLANC",
        ]);
        DB::table('colors')->insert([
            'name' => "NOIR",
            'code' =>
        ]);
        DB::table('colors')->insert([
            'name' => "GRIS",
        ]);
        DB::table('colors')->insert([
            'name' => "GRIS SOURIS",
        ]);
        DB::table('colors')->insert([
            'name' => "BLEU",
        ]);
        DB::table('colors')->insert([
            'name' => "BLEU CIEL",
        ]);
        DB::table('colors')->insert([
            'name' => "BLEU NUIT",
        ]);
        DB::table('colors')->insert([
            'name' => "BORDO",
        ]);
    }
}
