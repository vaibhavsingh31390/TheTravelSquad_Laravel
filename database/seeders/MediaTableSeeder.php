<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class MediaTableSeeder extends Seeder
{
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

        $thumbnails = $this->ensureSampleImages('Sample_Thumbnails', 1200, 675, 12);
        foreach ($posts as $post) {
            $post->media()->save(
                Media::make(['path' => $thumbnails[array_rand($thumbnails)]])
            );
        }

        $avatars = $this->ensureSampleImages('Sample_Profile_Pictures', 400, 400, 10, true);
        foreach ($users as $user) {
            $user->media()->save(
                Media::make(['path' => $avatars[array_rand($avatars)]])
            );
        }

        $this->ensureSampleImages('Sample_Content_Images', 1200, 675, 15);

        $this->command->info('Sample thumbnails, avatars, and inline content images are ready.');
    }

    /**
     * @return array<int, string>
     */
    private function ensureSampleImages(string $directory, int $width, int $height, int $count = 5, bool $roundAvatar = false): array
    {
        $disk = 'public';

        if (! Storage::disk($disk)->exists($directory)) {
            Storage::disk($disk)->makeDirectory($directory);
        }

        $files = Storage::disk($disk)->files($directory);
        $expected = [];
        for ($i = 1; $i <= $count; $i++) {
            $expected[] = "{$directory}/sample-{$i}.jpg";
        }

        $hasAll = collect($expected)->every(fn ($path) => in_array($path, $files, true));
        if ($hasAll) {
            return $expected;
        }

        if (! extension_loaded('gd')) {
            $this->command->warn("GD extension is not available. Skipping media generation for {$directory}.");

            return ["{$directory}/placeholder.png"];
        }

        $palettes = [
            ['sky' => [126, 184, 218], 'hill' => [74, 107, 80], 'accent' => [245, 215, 110]],
            ['sky' => [147, 197, 253], 'hill' => [55, 90, 70], 'accent' => [251, 191, 36]],
            ['sky' => [186, 230, 253], 'hill' => [45, 80, 72], 'accent' => [252, 211, 77]],
            ['sky' => [103, 163, 199], 'hill' => [60, 75, 65], 'accent' => [240, 200, 140]],
            ['sky' => [160, 196, 220], 'hill' => [80, 100, 85], 'accent' => [255, 220, 160]],
        ];

        $generated = [];
        for ($i = 1; $i <= $count; $i++) {
            $path = "{$directory}/sample-{$i}.jpg";
            $palette = $palettes[($i - 1) % count($palettes)];
            $contents = $this->renderTravelImage($width, $height, $palette, $roundAvatar, $i);
            Storage::disk($disk)->put($path, $contents);
            $generated[] = $path;
        }

        return $generated;
    }

    /**
     * @param  array{sky: array{0:int,1:int,2:int}, hill: array{0:int,1:int,2:int}, accent: array{0:int,1:int,2:int}}  $palette
     */
    private function renderTravelImage(int $width, int $height, array $palette, bool $roundAvatar, int $seed): string
    {
        $image = imagecreatetruecolor($width, $height);
        $sky = imagecolorallocate($image, ...$palette['sky']);
        $hill = imagecolorallocate($image, ...$palette['hill']);
        $accent = imagecolorallocate($image, ...$palette['accent']);
        $light = imagecolorallocatealpha($image, 255, 255, 255, 80);

        if ($roundAvatar) {
            imagefill($image, 0, 0, imagecolorallocate($image, 45, 55, 72));
            $cx = (int) ($width / 2);
            $cy = (int) ($height / 2);
            imagefilledellipse($image, $cx, $cy, $width - 8, $height - 8, $sky);
            imagefilledellipse($image, $cx, (int) ($cy * 0.72), (int) ($width * 0.28), (int) ($height * 0.28), $light);
            imagefilledarc($image, $cx, (int) ($cy * 1.35), (int) ($width * 0.62), (int) ($height * 0.45), 0, 180, $light, IMG_ARC_PIE);
        } else {
            imagefill($image, 0, 0, $sky);
            imagefilledellipse($image, (int) ($width * 0.82), (int) ($height * 0.18), (int) ($width * 0.09), (int) ($width * 0.09), $accent);
            imagefilledellipse($image, (int) ($width / 2), (int) ($height * 0.82), $width, (int) ($height * 0.55), $hill);
            imagefilledellipse($image, (int) ($width / 2), (int) ($height * 0.9), (int) ($width * 1.1), (int) ($height * 0.45), imagecolorallocate($image, max($palette['hill'][0] - 15, 0), max($palette['hill'][1] - 15, 0), max($palette['hill'][2] - 15, 0)));

            for ($c = 0; $c < 3; $c++) {
                $x = (int) (($seed * 97 + $c * 211) % max($width - 200, 1)) + 80;
                $y = 40 + $c * 25;
                imagefilledellipse($image, $x, $y, 140, 36, $light);
            }
        }

        ob_start();
        imagejpeg($image, null, 88);
        $contents = ob_get_clean() ?: '';
        imagedestroy($image);

        return $contents;
    }
}
