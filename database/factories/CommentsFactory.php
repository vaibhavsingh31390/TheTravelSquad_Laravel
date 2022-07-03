<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comments>
 */
class CommentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'comment' => $this->faker->text(150),
            'created_at'=> $this->faker->dateTimeBetween('-3 months'),
            'posts_id' => rand(1,50),
            'users_id' => random_int(1,20)
        ];
    }
}
