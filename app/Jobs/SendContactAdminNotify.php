<?php

namespace App\Jobs;

use App\Mail\ContactAdminNotify;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendContactAdminNotify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly User $user,
        private readonly Contact $contact
    )
    {
        $this->queue = 'emails';
    }

    /**
     * Execute the job.
     *
     * Notify, via email, admin users that a new contact form was submitted by someone
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(
            new ContactAdminNotify(
                from_address: _tnrs('from_address'),
                from_name: _tnrs('from_name'),
                the_subject: $this->contact->subject,
                the_message: $this->contact->message,
                recipient_name: $this->contact->from_name,
                recipient_email: $this->contact->from_email,
                ip_address: $this->contact->ipv4,
                date_created: $this->contact->created_at,
                the_attachments: $this->contact->attachments,
            )
        );
    }
}
