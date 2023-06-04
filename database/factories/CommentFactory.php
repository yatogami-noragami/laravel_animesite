<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $epNumber = rand(0, 5);
        if ($epNumber == 0) {
            $animeId = rand(1, 30);
        } else {
            $animeId = rand(1, 50);
        }
        return [
            'user_id' => rand(5, 50),
            'description' => $this->faker->realText(),
            'anime_id' => $animeId,
            'episode_number' => $epNumber,
        ];
    }
}
