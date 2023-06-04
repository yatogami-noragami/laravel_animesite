<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Genre>
 */
class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $genres =
            ["Action",  "Adventure",  "Comedy",  "Drama",  "Ecchi",  "Fantasy",  "Harem",  "Historical",  "Horror",  "Isekai",  "Josei",  "Magic",  "Martial Arts",  "Mecha",  "Military",  "Music",  "Mystery",  "Psychological",  "Romance",  "School",  "Sci-Fi",  "Seinen",  "Shoujo",  "Shoujo Ai",  "Shounen",  "Shounen Ai",  "Slice of Life",  "Sports",  "Super Power",  "Supernatural"];
        return [
            'name' => $this->faker->unique()->randomElement($genres),
        ];
    }
}
