<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('providers')->insert([
            ['name' => 'Netflix', 'url' => 'https://www.netflix.com', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Disney+', 'url' => 'https://www.disneyplus.com', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'HBO GO', 'url' => 'https://www.hbogo.co.th', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Amazon Prime Video', 'url' => 'https://www.primevideo.com', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
