<?php

namespace App\Observers;

use App\Models\Posts;
use Illuminate\Support\Facades\Cache;

class PostsObserver
{
    /**
     * Handle the Posts "created" event.
     *
     * @param  \App\Models\Posts  $posts
     * @return void
     */
    public function created(Posts $posts)
    {
        //
    }

    /**
     * Handle the Posts "updated" event.
     *
     * @param  \App\Models\Posts  $posts
     * @return void
     */
    public function updated(Posts $posts)
    {
        //
    }

    /**
     * Handle the Posts "deleted" event.
     *
     * @param  \App\Models\Posts  $posts
     * @return void
     */
    public function deleting(Posts $posts)
    {
        $posts->comments()->delete();
        $posts->actionPosts()->delete();
        $posts->media()->delete();
        Cache::forget('index-postsData');
    }


    public function deleted(Posts $posts)
    {
        //
    }

    /**
     * Handle the Posts "restored" event.
     *
     * @param  \App\Models\Posts  $posts
     * @return void
     */
    public function restored(Posts $posts)
    {
        //
    }

    /**
     * Handle the Posts "force deleted" event.
     *
     * @param  \App\Models\Posts  $posts
     * @return void
     */
    public function forceDeleted(Posts $posts)
    {
        //
    }
}
