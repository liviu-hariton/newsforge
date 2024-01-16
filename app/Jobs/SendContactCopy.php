<?php

namespace App\Jobs;

use App\Mail\ContactCopy;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendContactCopy implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly Contact $contact_entry)
    {
        $this->queue = 'emails';
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Send a copy of the contact form to the sender
        Mail::to($this->contact_entry->from_email)->send(
            new ContactCopy(
                from_address: _tnrs('from_address'),
                from_name: _tnrs('from_name'),
                the_subject: $this->contact_entry->subject,
                the_message: $this->contact_entry->message,
                recipient_name: $this->contact_entry->from_name,
                the_attachments: $this->contact_entry->attachments,
                the_headers: $this->contact_entry->headers
            )
        );

        $this->updateSentStatus();
    }

    /**
     * Update the contact entry record with the sent status and time.
     *
     * @return void
     */
    protected function updateSentStatus(): void
    {
        $this->contact_entry->copy_sent = 1;
        $this->contact_entry->sent_at = now();

        $this->contact_entry->save();
    }
}
