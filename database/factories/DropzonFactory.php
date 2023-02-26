<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dropzon>
 */
class DropzonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'x_position'=>$this->faker->randomFloat(2,30,80),
            'y_position'=>$this->faker->randomFloat(2,30,80),
        ];
    }
}
