<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Posts;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MediaTableSeeder extends Seeder
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
            $this->command->info('There are no posts, so no media will be added');
            return;
        }
        $images = Storage::files('Sample_Thumbnails');
        foreach($posts as $post){
            $randomImages = array_rand($images);
            $randomImage = $images[$randomImages];
            Media::create(['path'=>$randomImage, 'posts_id'=>$post->id]);
        }
    }
}
