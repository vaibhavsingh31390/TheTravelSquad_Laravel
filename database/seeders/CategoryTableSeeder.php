<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $posts = Posts::all();
        if($posts->count() === 0){
            $this->command->info('There are no posts, so no comments will be added');
            return;
        }
        $category = ['Travel','Technology','Sports','Food','Food','Others'];
        foreach($posts as $post){
            $category_Menu = array_rand($category);
            $categoryCreate = Category::create(['posts_id'=>$post->id, 'category_Menu'=>$category[$category_Menu]]);
        }
    }
}
