<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProviderSeeder extends Seeder
{
    
    public function run(): void
    {
        DB::table('providers')->insert([
            ['name' => 'Netflix', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Disney+', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'HBO GO', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Amazon Prime Video', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
