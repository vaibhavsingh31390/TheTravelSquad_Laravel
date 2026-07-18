<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Posts;
use App\Services\RichPostContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class RichPostContentSeeder extends Seeder
{
    public function run(): void
    {
        $posts = Posts::with('category')->get();

        if ($posts->isEmpty()) {
            $this->command->info('No posts found — skipping rich content seeding.');

            return;
        }

        $contentImages = Storage::disk('public')->files('Sample_Content_Images');

        if ($contentImages === []) {
            $contentImages = Storage::disk('public')->files('Sample_Thumbnails');
        }

        $imageUrls = collect($contentImages)
            ->map(fn (string $path) => asset('storage/'.$path))
            ->values()
            ->all();

        if ($imageUrls === []) {
            $imageUrls = [\App\Models\Media::placeholderPostUrl()];
        }

        foreach ($posts as $post) {
            $category = $post->category()->first()->category_Menu ?? 'Travel';
            $picked = collect($imageUrls)->random(min(2, count($imageUrls)))->values()->all();

            $post->update([
                'content' => RichPostContent::generate($post->title, $category, $picked),
            ]);
        }

        $this->command->info('Rich HTML content applied to '.$posts->count().' posts.');
    }
}
