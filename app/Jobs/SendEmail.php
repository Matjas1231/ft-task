<?php

namespace App\Jobs;

use App\Mail\ForgotPasswordLinkMail;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private string $type = 'registration',
        private User|array $data,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->type === 'registration') {
            Mail::to($this->data['email'])->send(new WelcomeMail($this->data));
        } elseif ($this->type === 'resetPassword') {
            Mail::to($this->data['email'])->send(new ForgotPasswordLinkMail($this->data));
        }
    }
}
