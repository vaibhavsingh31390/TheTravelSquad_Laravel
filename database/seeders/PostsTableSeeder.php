<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = ['Travel','Technology','Sports','Food','Food','Others'];
        $postsCount = (int)$this->command->ask('How Many Blog Post Would You Like To Create', 50);
        $users = \App\Models\User::all();

        \App\Models\Posts::factory()->count($postsCount)->make()->each(function($posts) use ($users, $category){
            $posts->users_id = $users->random()->id;
            $posts->media = 
            $posts->save();
        });
    }
}
