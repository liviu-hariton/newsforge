<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Headers;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ContactCopy extends Mailable
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
        public array $the_attachments,
        public string $the_headers,
    )
    {
        //
    }

    /**
     * Get the message headers.
     */
    public function headers(): Headers
    {
        if($this->the_headers) {
            // Splitting headers by new line, handling both \n and \r\n
            $headers_lines = preg_split('/\r?\n/', $this->the_headers);

            // Extract key-value pairs from each header line
            $custom_headers = [];

            foreach($headers_lines as $headers_line) {
                list($key, $value) = array_map('trim', explode(':', $headers_line, 2));

                // If key and value are not empty, add them to the custom headers array
                if($key !== '' && $value !== '') {
                    // If the header is not a Reply-To header, add it to the custom headers array
                    if(!preg_match("/Reply/isum", $key)) {
                        $custom_headers[$key] = $value;
                    }
                }
            }

            // If there are any custom headers, return them
            if(count($custom_headers) > 0) {
                return new Headers(
                    text: $custom_headers,
                );
            }
        }

        return new Headers();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->from_address, $this->from_name),
            // user should reply to the site's email address
            replyTo: [new Address(_tnrs('from_address'), _tnrs('from_name'))],
            subject: '[COPY] '.$this->the_subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.frontend.contact-copy',
            with:[
                'the_subject' => $this->the_subject,
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

        foreach($this->the_attachments as $attachment) {
            $attachments[] = Attachment::fromPath(
                Storage::disk('public')->path($attachment)
            );
        }

        return $attachments;
    }
}
