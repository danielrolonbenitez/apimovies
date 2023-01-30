<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tvshow;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TvshowFactory extends Factory
{
    protected $model = Tvshow::class;

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
                'comic',
                'news',
                'entretaint',
            ]),
            'hours' => $this->faker->randomElement(['09am', '20pm', '10am', '11p,', '13am', '22:30 pm', '18:35 pm']),
            'lang' => $this->faker->randomElement(['es', 'en']),
            'days' => $this->faker->randomElement(['friday', 'sunday', 'saturday', 'monday', 'winesday'])

        ];
    }
}
