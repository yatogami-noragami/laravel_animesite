<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anime>
 */
class AnimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $animes = ["Sword Art Online", "One Piece",  "Naruto",  "Naruto Shippuden",  "Bleach",  "Fairy Tail",  "Dragon Ball",  "Dragon Ball Z",  "Dragon Ball Super",  "Attack on Titan",  "Fullmetal Alchemist",  "Fullmetal Alchemist: Brotherhood",  "Death Note",  "Code Geass: Lelouch of the Rebellion",  "Cowboy Bebop",  "Trigun",  "Samurai Champloo",  "Neon Genesis Evangelion",  "Sailor Moon",  "Cardcaptor Sakura",  "Rurouni Kenshin",  "Gintama",  "Hunter x Hunter",  "Soul Eater",  "Yu Yu Hakusho",  "Inuyasha",  "JoJo's Bizarre Adventure",  "My Hero Academia",  "Black Clover",  "One Punch Man",  "Mob Psycho 100",  "Haikyuu!!",  "Kuroko's Basketball",  "Free!",  "Assassination Classroom",  "Psycho-Pass",  "Steins;Gate",  "Durarara!!",  "The Promised Neverland",  "Demon Slayer: Kimetsu no Yaiba",  "Re:Zero − Starting Life in Another World",  "Tokyo Ghoul",  "Fate/Zero",  "Fate/stay night: Unlimited Blade Works",  "Attack on Titan: The Final Season",  "Jujutsu Kaisen",  "Dr. Stone",  "The Seven Deadly Sins",  "That Time I Got Reincarnated as a Slime",  "The Rising of the Shield Hero"];
        $genres = ["Action",  "Adventure",  "Comedy",  "Drama",  "Ecchi",  "Fantasy",  "Harem",  "Historical",  "Horror",  "Isekai",  "Josei",  "Magic",  "Martial Arts",  "Mecha",  "Military",  "Music",  "Mystery",  "Psychological",  "Romance",  "School",  "Sci-Fi",  "Seinen",  "Shoujo",  "Shoujo Ai",  "Shounen",  "Shounen Ai",  "Slice of Life",  "Sports",  "Super Power",  "Supernatural"];

        try {
            $title = $this->faker->unique()->randomElement($animes);
        } catch (\OverflowException $e) {
            // Handle the exception here, such as generating a new title or returning a default value.
            $title = 'Default Title';
        }

        $genre1 = $genres[array_rand($genres)];
        $genre2 = '';
        $genre3 = '';
        do {
            $genre2 = $genres[array_rand($genres)];
        } while ($genre2 == $genre1);

        do {
            $genre3 = $genres[array_rand($genres)];
        } while ($genre3 == $genre1 || $genre3 == $genre1);

        $genre = $genre1 . ',' . $genre2 . ',' . $genre3 . ',';

        return [
            'title' => $title,
            'description' => $this->faker->paragraph(5),
            'genre' => $genre,
            'year' => rand(2010, 2023),
            'rating' => rand(1, 9),
            'episode_count' => rand(12, 50),
            'view_count' => rand(0, 20),
        ];
    }
}
