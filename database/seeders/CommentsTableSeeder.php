<?php

namespace Database\Seeders;

use App\Models\Posts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Posts::all();
        if($posts->count() === 0){
            $this->command->info('There are no posts, so no comments will be added');
            return;
        }
        $commentsCount = (int)$this->command->ask('How Many comments would you like ?', 50);
        \App\Models\Comments::factory()->count($commentsCount)->make()->each(function($comment) use ($posts){
            $comment->posts_id = $posts->random()->id;
            $comment->save();
        });
    }
}
