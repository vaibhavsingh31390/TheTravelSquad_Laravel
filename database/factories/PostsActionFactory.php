<?php

namespace Database\Factories;

use App\Models\Action;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Action>
 */
class ActionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $action = Action::all();
        return [
            'posts_id' => rand(1,50),
            'users_id' => random_int(1,20),
            'action_id' => random_int(1,2)
        ];
    }
}
