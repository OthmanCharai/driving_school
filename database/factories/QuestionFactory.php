<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Question;
use App\Models\SubExam;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence(4),
            'voice' => $this->faker->sentence(4),
            'sub_exam_id' => SubExam::factory(),
            'image'=>$this->faker->imageUrl('500','500'),

        ];
    }
}
