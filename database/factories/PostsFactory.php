<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class PostsFactory extends Factory
{
    private static array $travelTitles = [
        'A Weekend Guide to Exploring Hidden Coastal Towns',
        'How to Plan a Budget-Friendly City Break in Europe',
        'The Best Street Food Markets You Should Not Miss',
        'Slow Travel: Why Taking the Long Route Changes Everything',
        'Packing Light for Two Weeks Without Sacrificing Comfort',
        'Sunrise Hikes Worth the Early Alarm',
        'Local Cafés and Culture: A Neighbourhood Walking Guide',
        'Family-Friendly Destinations That Feel Grown-Up Too',
        'Rainy-Day Itineraries for Urban Explorers',
        'Sustainable Travel Habits You Can Start Today',
    ];

    public function definition(): array
    {
        return [
            'created_at' => $this->faker->dateTimeBetween('-6 months'),
            'title' => $this->faker->randomElement(self::$travelTitles).' — '.$this->faker->city(),
            'content' => '<p>'.$this->faker->paragraphs(3, true).'</p>',
            'users_id' => random_int(1, 20),
        ];
    }
}
