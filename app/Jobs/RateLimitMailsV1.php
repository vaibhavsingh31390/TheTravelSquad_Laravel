<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class RateLimitMailsV1 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $mailable;

    public $user;

    /**
     * Create a new job instance.
     */
    public function __construct(Mailable $mailable, User $user)
    {
        $this->mailable = $mailable;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $executed = RateLimiter::attempt(
            'mailtrap_Travel_Squad',
            2,
            function () {
                Mail::to($this->user)->send($this->mailable);
            },
            12
        );

        if (! $executed) {
            $this->release(5);
        }
    }
}
