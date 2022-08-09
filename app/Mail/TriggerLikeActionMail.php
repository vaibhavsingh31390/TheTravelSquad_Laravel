<?php

namespace App\Mail;

use App\Models\Action;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TriggerLikeActionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $action, $post, $userAction;

    public function __construct(Posts $post,$userAction)
    {
        $this->post = $post;
        $this->userAction = $userAction;
    }
    // User::find($post->actionPosts->pluck('pivot')->pluck('users_id')->first())
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Like On Your Post')->markdown('emailer.like-action-notification');
    }
}
