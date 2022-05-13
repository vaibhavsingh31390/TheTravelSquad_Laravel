<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'image_url' => $this->faker->text(),
            'title' => $this->faker->text(),
            'content' => $this->faker->paragraph(5),
            'like' => $this->faker->randomDigit(),
            'dislike' => $this->faker->randomDigit(),
            'users_id' => 1
        ];
    }
}
