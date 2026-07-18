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
     */
    public function run(): void
    {
        $posts = Posts::all();
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->info('There are no users, so no media will be added');

            return;
        }

        if ($posts->isEmpty()) {
            $this->command->info('There are no posts, so no media will be added');

            return;
        }

        $imagesThumbnails = $this->ensureSampleImages('Sample_Thumbnails');
        foreach ($posts as $post) {
            $randomImage = $imagesThumbnails[array_rand($imagesThumbnails)];
            $post->media()->save(
                Media::make(['path' => $randomImage])
            );
        }

        $imagesUserThumbnails = $this->ensureSampleImages('Sample_Profile_Pictures');
        foreach ($users as $user) {
            $randomImage = $imagesUserThumbnails[array_rand($imagesUserThumbnails)];
            $user->media()->save(
                Media::make(['path' => $randomImage])
            );
        }
    }

    /**
     * Ensure sample image files exist for seeding.
     *
     * @return array<int, string>
     */
    private function ensureSampleImages(string $directory, int $count = 5): array
    {
        if (! Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }

        $files = Storage::files($directory);

        if ($files !== []) {
            return $files;
        }

        if (! extension_loaded('gd')) {
            $this->command->warn("GD extension is not available. Skipping media generation for {$directory}.");

            return ["{$directory}/placeholder.png"];
        }

        for ($i = 1; $i <= $count; $i++) {
            $path = "{$directory}/placeholder-{$i}.png";
            $image = imagecreatetruecolor(200, 200);
            $color = imagecolorallocate($image, random_int(50, 200), random_int(50, 200), random_int(50, 200));
            imagefill($image, 0, 0, $color);
            ob_start();
            imagepng($image);
            $contents = ob_get_clean();
            imagedestroy($image);
            Storage::put($path, $contents);
        }

        return Storage::files($directory);
    }
}
