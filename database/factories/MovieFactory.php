<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $movies = ["Spirited Away",  "Your Name",  "Grave of the Fireflies",  "Princess Mononoke",  "Akira",  "Perfect Blue",  "Ghost in the Shell",  "The Girl Who Leapt Through Time",  "Paprika",  "Howl's Moving Castle",  "My Neighbor Totoro",  "Kiki's Delivery Service",  "Porco Rosso",  "The Tale of Princess Kaguya",  "Redline",  "Wolf Children",  "The Wind Rises",  "A Silent Voice",  "In This Corner of the World",  "The Garden of Words",  "5 Centimeters per Second",  "Patema Inverted",  "Nausicaa of the Valley of the Wind",  "The Cat Returns",  "Only Yesterday",  "From Up on Poppy Hill",  "The Place Promised in Our Early Days",  "Millennium Actress",  "Metropolis", "Your Lie in April"];
        $genres = ["Action",  "Adventure",  "Comedy",  "Drama",  "Ecchi",  "Fantasy",  "Harem",  "Historical",  "Horror",  "Isekai",  "Josei",  "Magic",  "Martial Arts",  "Mecha",  "Military",  "Music",  "Mystery",  "Psychological",  "Romance",  "School",  "Sci-Fi",  "Seinen",  "Shoujo",  "Shoujo Ai",  "Shounen",  "Shounen Ai",  "Slice of Life",  "Sports",  "Super Power",  "Supernatural"];
        try {
            $title = $this->faker->unique()->randomElement($movies);
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
            'year' => rand(2000, 2023),
            'rating' => rand(1, 9),
        ];
    }
}
