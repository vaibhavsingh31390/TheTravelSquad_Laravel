<?php

namespace Database\Seeders;

use App\Models\Posts;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    private const TAG_POOL = [
        'City Guides', 'Backpacking', 'Budget Travel', 'Food Tourism', 'Adventure',
        'Photography', 'Solo Travel', 'Family Travel', 'Europe', 'Asia',
        'Road Trips', 'Beaches', 'Hiking', 'Culture', 'Weekend Getaways',
        'Wildlife', 'Luxury', 'Eco Travel', 'Nightlife', 'History',
    ];

    public function run(): void
    {
        $posts = Posts::all();

        if ($posts->isEmpty()) {
            $this->command->info('No posts found — skipping tag seeding.');

            return;
        }

        foreach (self::TAG_POOL as $name) {
            Tag::findOrCreateFromName($name);
        }

        $allTags = Tag::all();

        foreach ($posts as $post) {
            $picked = $allTags->random(random_int(2, 4))->pluck('id')->all();
            $post->tags()->syncWithoutDetaching($picked);
        }

        $this->command->info('Tags assigned to '.$posts->count().' posts.');
    }
}
