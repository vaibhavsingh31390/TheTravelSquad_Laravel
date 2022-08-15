<?php

namespace App\Jobs;

use App\Models\Posts;
use Illuminate\Bus\Queueable;
use App\Mail\TriggerLikeActionMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class PostLikedMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $action, $post, $userAction;

    public function __construct(Posts $post,$userAction)
    {
        $this->post = $post;
        $this->userAction = $userAction;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->post->user)->later(
            now()->addSeconds(5),
            new TriggerLikeActionMail($this->post, $this->userAction)
        );
    }
}
