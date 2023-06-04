<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Database\Seeder;
use Database\Seeders\AnimeSeeder;
use Database\Seeders\GenreSeeder;
use Database\Seeders\MovieSeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\EpisodeSeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\UserContactSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'John',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
        ]);

        User::create([
            'name' => 'David',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'password' => Hash::make('user123'),
        ]);

        for ($i = 0; $i < 50; $i++) {
            User::create([
                'name' => 'user' .  $i,
                'email' => 'user' . $i . '@gmail.com',
                'role' => 'user',
                'password' => Hash::make('user123'),
            ]);
        }

        $this->call([
            AnimeSeeder::class,
            GenreSeeder::class,
            MovieSeeder::class,
            CommentSeeder::class,
            UserContactSeeder::class,
            UserRequestSeeder::class,
        ]);

        for ($j = 1; $j <= 50; $j++) {
            $epNumber = rand(5, 12);
            for ($k = 1; $k <= $epNumber; $k++) {
                Episode::create([
                    'anime_id' => $j,
                    'episode_number' => $k,
                ]);
            }
            $data['available_episode'] = $epNumber;
            Anime::where('id', $j)->update($data);
        }
    }
}
