<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(5),
            'text' => $this->faker->text(255),
            'price' => $this->faker->numberBetween(100,500),
            'url' => $this->faker->slug(),
            'is_public' => $this->faker->numberBetween(0,1),
        ];
    }
}
