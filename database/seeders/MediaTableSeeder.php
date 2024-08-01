<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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
        $users = \App\Models\User::all();
        $elemets = [$posts, $users];
        if ($users->count() === 0) {
            $this->command->info('There are no users, so no media will be added');
            return;
        }
        if ($posts->count() === 0) {
            $this->command->info('There are no posts, so no media will be added');
            return;
        }
        $images_Thumbnails = Storage::disk('public')->files('Sample_Thumbnails');;
        foreach ($posts as $post) {
            $randomImages = array_rand($images_Thumbnails);
            $randomImage = $images_Thumbnails[$randomImages];
            $post->media()->save(
                Media::make(['path' => $randomImage])
            );
        };
        $images_User_Thumbnails = Storage::disk('public')->files('Sample_Profile_Pictures');

        foreach ($users as $user) {
            $randomImages = array_rand($images_User_Thumbnails);
            $randomImage = $images_User_Thumbnails[$randomImages];
            $user->media()->save(
                Media::make(['path' => $randomImage])
            );
        }
    }
}
