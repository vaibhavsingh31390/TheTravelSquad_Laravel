<?php

namespace Database\Seeders;

use App\Models\Posts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = ['Travel','Technology','Sports','Food','Food','Others'];
        $posts = Posts::all();
        if($posts->count() === 0){
            $this->command->info('There are no posts, so no comments will be added');
            return;
        }
        $count = $posts->count();
        \App\Models\Category::factory()->count($count)->make()->each(function ($comment) use ($posts) {
            $comment->posts_id = $posts->random()->id;
            $comment->save();
        });
    }
}
