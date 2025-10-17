<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{

    public function run(): void
    {

        DB::table('genres')->insert([
            ['code' => 'ACT', 'name' => 'Action'],
            ['code' => 'CMD', 'name' => 'Comedy'],
            ['code' => 'DRM', 'name' => 'Drama'],
            ['code' => 'SCF', 'name' => 'Sci-Fi'],
            ['code' => 'HRR', 'name' => 'Horror'],
        ]);
    }
}
