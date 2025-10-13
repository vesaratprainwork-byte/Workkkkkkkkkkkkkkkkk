<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    
    public function run(): void
    {
        
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@moviehub.com',
            'password' => Hash::make('1234'), 
            'role' => 'ADMIN',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        
        DB::table('users')->insert([
            'name' => 'Regular User',
            'email' => 'user@moviehub.com',
            'password' => Hash::make('1234'), 
            'role' => 'USER',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}