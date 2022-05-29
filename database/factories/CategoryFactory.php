<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category = ['Travel','Technology','Sports','Food','Food','Others'];
        return [
            'category_Menu' => $category[array_rand($category)],
            'posts_id' => rand(1,20),
        ];
    }
}
