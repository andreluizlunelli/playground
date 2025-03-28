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
            'aired_year' => $this->faker->randomElement([2000, 2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023]),
            'synopsis' => $this->faker->sentence(),
        ];
    }
}
