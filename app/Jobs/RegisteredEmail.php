<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\SendEmailWelcomeNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RegisteredEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected User $user)
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->notify(new SendEmailWelcomeNotification($this->user->name));
    }
}
