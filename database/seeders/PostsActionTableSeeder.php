<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\Posts;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostsActionTableSeeder extends Seeder
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

        $count = $posts->count();
        \App\Models\Posts::factory()->count($count)->make()->each(function ($action) use ($posts) {
            $getPost = $posts->random();
            $actions = Action::all();
            $action = $actions->random();
            $getPost->actionPosts()->attach($action,['posts_id'=>$getPost->id, 'users_id'=>$getPost->users_id]);  
        });
    }
}
