<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Episode;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EpisodeFactory extends Factory
{

    protected $model = Episode::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'picture' => $this->faker->imageUrl(),
            'duration' => $this->faker->randomElement(['4hs', '2:30hs', '1hs', '1:30hs']),
            'scoring' => $this->faker->randomElement(['4', '2', '1', '0', '5']),
            'season_id' => $this->faker->randomElement(['1', '2', '3', '4', '5']),
        ];
    }
}
