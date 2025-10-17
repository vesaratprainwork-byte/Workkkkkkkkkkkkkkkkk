<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            GenreSeeder::class,
            ProviderSeeder::class,
            MovieSeeder::class,
        ]);


        $users = User::factory(10)->create();


        $movieIds = Movie::pluck('id');


        foreach ($users as $user) {

            $moviesToReview = $movieIds->random(rand(1, 3));

            foreach ($moviesToReview as $movieId) {

                \App\Models\Review::factory()->create([
                    'user_id' => $user->id,
                    'movie_id' => $movieId,
                ]);
            }
        }
    }
}
