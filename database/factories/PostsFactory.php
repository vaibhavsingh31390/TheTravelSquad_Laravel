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
            'image_url' => 'https://placeimg.com/1024/576/any?' . rand(1, 100),
            'created_at'=> $this->faker->dateTimeBetween('-3 months'),
            'title' => $this->faker->text(),
            'content' => $this->faker->paragraph(10),
            'users_id' => random_int(1,20)
        ];
    }
}
