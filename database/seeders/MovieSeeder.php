<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    
    public function run(): void
    {
        
        DB::table('movies')->insert([
            [
                'id' => 1, 
                'title' => 'Inception',
                'synopsis' => 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.',
                'release_year' => 2010,
                'poster_url' => 'https://image.tmdb.org/t/p/w500/oYuLEt3zVCKq27gApcjBWW9A9Mc.jpg',
                'genre_code' => 'SCF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'title' => 'The Dark Knight',
                'synopsis' => 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.',
                'release_year' => 2008,
                'poster_url' => 'https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg',
                'genre_code' => 'ACT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'title' => 'Forrest Gump',
                'synopsis' => 'The presidencies of Kennedy and Johnson, the Vietnam War, the Watergate scandal and other historical events unfold from the perspective of an Alabama man with an IQ of 75, whose only desire is to be reunited with his childhood sweetheart.',
                'release_year' => 1994,
                'poster_url' => 'https://image.tmdb.org/t/p/w500/arw2vcBveWOVZr6pxd9XTd1TdQa.jpg',
                'genre_code' => 'DRM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'title' => 'The Hangover',
                'synopsis' => 'A Las Vegas-set comedy centered on three groomsmen who lose their best friend, the groom, during their drunken misadventures, then must retrace their steps in order to find him.',
                'release_year' => 2009,
                'poster_url' => 'https://image.tmdb.org/t/p/w500/bptfVGEQuv6vDTIMVCHjJ9Dz8o2.jpg',
                'genre_code' => 'CMD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        
        DB::table('movie_provider')->insert([
            
            ['movie_id' => 1, 'provider_id' => 1],
            ['movie_id' => 1, 'provider_id' => 3],

            
            ['movie_id' => 2, 'provider_id' => 3],

            
            ['movie_id' => 3, 'provider_id' => 1],

            
            ['movie_id' => 4, 'provider_id' => 4],
        ]);
        
    }
}