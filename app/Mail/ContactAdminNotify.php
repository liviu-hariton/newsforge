<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ContactAdminNotify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public string $from_address,
        public string $from_name,
        public string $the_subject,
        public string $the_message,
        public string $recipient_name,
        public string $recipient_email,
        public string $ip_address,
        public string $date_created,
        public ?array $the_attachments = [],
    )
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->from_address, $this->from_name),
            // admin user should reply to the person that submitted the contact form
            replyTo: [new Address($this->recipient_email, $this->recipient_name)],
            subject: '[New contact] '.$this->the_subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.backend.new-contact',
            with:[
                'the_subject' => $this->the_subject,
                'recipient_name' => $this->recipient_name,
                'recipient_email' => $this->recipient_email,
                'ip_address' => $this->ip_address,
                'date_created' => $this->date_created,
                'the_message' => nl2br($this->the_message),
                'the_logo' => public_path('frontend/images/logos/logo.png'),
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        if(is_array($this->the_attachments)) {
            foreach($this->the_attachments as $attachment) {
                $attachments[] = Attachment::fromPath(
                    Storage::disk('public')->path($attachment)
                );
            }
        }

        return $attachments;
    }
}
