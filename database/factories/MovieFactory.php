<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Movie;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MovieFactory extends Factory
{

    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'genre' => $this->faker->randomElement([
                'action',
                'horror',
                'suspense',
                'aventure'
            ]),
            'year' => $this->faker->randomElement(['2019-09-09', '2020-06-06', '2021-01-01', '2022-04-03', '2023-04-12']),
            'lang' => $this->faker->randomElement(['es', 'en']),
            'duration' => $this->faker->randomElement(['4', '2', '1']),
            'description' => $this->faker->paragraph(),
            'picture' => $this->faker->imageUrl(),
        ];
    }
}
