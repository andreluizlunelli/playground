<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anime>
 */
class AnimeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'mal_id' => $this->faker->randomNumber(),
            'url' => $this->faker->url(),
            'title' => $this->faker->sentence(),
            'type' => $this->faker->word(),
            'source' => $this->faker->word(),
            'status' => $this->faker->word(),
            'episodes' => $this->faker->randomNumber(),
            'duration' => $this->faker->randomNumber(),
            'rating' => $this->faker->word(),
            'score' => $this->faker->randomFloat(),
            'popularity' => $this->faker->randomNumber(),
            'aired_from' => $this->faker->date(),
            'aired_to' => $this->faker->date(),
            'synopsis' => $this->faker->sentence(),
        ];
    }
}
