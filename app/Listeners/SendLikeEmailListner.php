<?php

namespace App\Listeners;

use App\Events\LikedPost;
use App\Jobs\PostLikedMailJob;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendLikeEmailListner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(LikedPost $event)
    {
        PostLikedMailJob::dispatch($event->post, $event->userAction);
    }
}
