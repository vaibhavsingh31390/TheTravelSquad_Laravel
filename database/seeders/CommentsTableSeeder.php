<?php

namespace Database\Seeders;

use App\Models\Posts;
use App\Models\User;
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
        $user = User::all();
        if($posts->count() === 0 || $user->count() === 0){
            $this->command->info('There are no posts, so no comments will be added');
            return;
        }
        $commentsCount = (int)$this->command->ask('How Many comments would you like ?', 50);
        \App\Models\Comments::factory()->count($commentsCount)->make()->each(function($comment) use ($posts, $user){
            $comment->commentsable_id = $posts->random()->id;
            $comment->commentsable_type = 'App\Models\Posts';
            $comment->users_id = $user->random()->id;
            $comment->save();
        });
    }
}
